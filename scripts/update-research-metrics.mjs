import { readFile, writeFile } from "node:fs/promises";

const metricsPath = new URL("../assets/data/research-metrics.json", import.meta.url);
const scholarId = "wEoImc8AAAAJ";
const projects = {
  "xiaomi-robotics-1": {
    scholarTitles: [
      "xiaomi-robotics-1: scaling vision-language-action models with over 100k hours of real-world trajectories",
    ],
  },
  "action-images": {
    scholarTitles: ["action images: end-to-end policy learning via multiview video generation"],
    repository: "UMass-Embodied-AGI/ActionImages",
  },
  "xiaomi-robotics-0": {
    scholarTitles: [
      "xiaomi-robotics-0: an open-sourced vision-language-action model with real-time execution",
    ],
    repository: "XiaomiRobotics/Xiaomi-Robotics-0",
  },
  "primitive-world-models": {
    scholarTitles: [
      "learning primitive embodied world models: towards scalable robot learning",
    ],
  },
  tesseract: {
    scholarTitles: [
      "tesseract: learning 4d embodied world models",
      "learning 4d embodied world models",
    ],
    repository: "UMass-Embodied-AGI/TesserAct",
  },
};

function normalizeText(value) {
  return value
    .replace(/<[^>]+>/g, "")
    .replace(/&amp;/g, "&")
    .replace(/&#39;|&apos;/g, "'")
    .replace(/&quot;/g, '"')
    .replace(/&ndash;|&mdash;/g, "-")
    .replace(/&#(\d+);/g, (_, code) => String.fromCodePoint(Number(code)))
    .replace(/\s+/g, " ")
    .trim()
    .toLowerCase();
}

async function getScholarCitations() {
  const url = `https://scholar.google.com/citations?user=${scholarId}&hl=en&pagesize=100`;
  const response = await fetch(url, {
    headers: {
      "Accept-Language": "en-US,en;q=0.9",
      "User-Agent":
        "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 Chrome/126 Safari/537.36",
    },
  });
  if (!response.ok) throw new Error(`Google Scholar returned ${response.status}`);

  const html = await response.text();
  const citationsByTitle = new Map();
  const rowPattern =
    /class="gsc_a_at"[^>]*>([\s\S]*?)<\/a>[\s\S]*?class="gsc_a_c"[^>]*>[\s\S]*?class="gsc_a_ac[^\"]*"[^>]*>([\s\S]*?)<\/a>/g;
  for (const match of html.matchAll(rowPattern)) {
    const title = normalizeText(match[1]);
    const count = Number(normalizeText(match[2]).replace(/,/g, "")) || 0;
    citationsByTitle.set(title, count);
  }
  if (citationsByTitle.size === 0) throw new Error("No Google Scholar publications found");
  return citationsByTitle;
}

async function getGitHubStars(repository, fallback) {
  const headers = {
    Accept: "application/vnd.github+json",
    "User-Agent": "qiaosun22-homepage-metrics",
  };
  if (process.env.GITHUB_TOKEN) headers.Authorization = `Bearer ${process.env.GITHUB_TOKEN}`;

  const response = await fetch(`https://api.github.com/repos/${repository}`, { headers });
  if (!response.ok) {
    console.warn(`GitHub returned ${response.status} for ${repository}; keeping ${fallback}`);
    return fallback;
  }
  const data = await response.json();
  return data.stargazers_count;
}

const currentMetrics = JSON.parse(await readFile(metricsPath, "utf8"));
const citationsByTitle = await getScholarCitations();
const updatedProjects = {};

for (const [projectId, config] of Object.entries(projects)) {
  const current = currentMetrics.projects[projectId] || {};
  const citations = config.scholarTitles.reduce(
    (total, title) => total + (citationsByTitle.get(title) || 0),
    0
  );
  updatedProjects[projectId] = { citations };
  if (config.repository) {
    updatedProjects[projectId].stars = await getGitHubStars(config.repository, current.stars);
  }
}

const updatedMetrics = {
  updatedAt: new Date().toISOString(),
  sources: currentMetrics.sources,
  projects: updatedProjects,
};
await writeFile(metricsPath, `${JSON.stringify(updatedMetrics, null, 2)}\n`);
