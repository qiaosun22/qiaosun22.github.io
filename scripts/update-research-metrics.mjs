import { readFile, writeFile } from "node:fs/promises";

const metricsPath = new URL("../assets/data/research-metrics.json", import.meta.url);
const scholarId = "wEoImc8AAAAJ";
const huggingFaceEndpoint = process.env.HF_ENDPOINT || "https://huggingface.co";
const projects = {
  "xiaomi-robotics-1": {
    scholarTitles: [
      "xiaomi-robotics-1: scaling vision-language-action models with over 100k hours of real-world trajectories",
    ],
    repository: "XiaomiRobotics/Xiaomi-Robotics-1",
    models: [
      "XiaomiRobotics/Xiaomi-Robotics-1-5B",
      "XiaomiRobotics/Xiaomi-Robotics-1-RoboCasa",
      "XiaomiRobotics/Xiaomi-Robotics-1-RoboCasa365",
      "XiaomiRobotics/Xiaomi-Robotics-1-VLABench",
    ],
  },
  "action-images": {
    scholarTitles: ["action images: end-to-end policy learning via multiview video generation"],
    repository: "UMass-Embodied-AGI/ActionImages",
    models: ["anyeZHY/ActionImages"],
  },
  "xiaomi-robotics-0": {
    scholarTitles: [
      "xiaomi-robotics-0: an open-sourced vision-language-action model with real-time execution",
    ],
    repository: "XiaomiRobotics/Xiaomi-Robotics-0",
    models: [
      "XiaomiRobotics/Xiaomi-Robotics-0-LIBERO",
      "XiaomiRobotics/Xiaomi-Robotics-0-Calvin-ABCD_D",
      "XiaomiRobotics/Xiaomi-Robotics-0-Calvin-ABC_D",
      "XiaomiRobotics/Xiaomi-Robotics-0-SimplerEnv-Google-Robot",
      "XiaomiRobotics/Xiaomi-Robotics-0-SimplerEnv-WidowX",
      "XiaomiRobotics/Xiaomi-Robotics-0-Pretrain",
    ],
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
    models: ["anyeZHY/tesseract"],
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

  try {
    const response = await fetch(`https://api.github.com/repos/${repository}`, { headers });
    if (!response.ok) {
      console.warn(`GitHub returned ${response.status} for ${repository}; keeping ${fallback}`);
      return fallback;
    }
    const data = await response.json();
    return data.stargazers_count;
  } catch (error) {
    console.warn(`GitHub request failed for ${repository}; keeping ${fallback}`, error);
    return fallback;
  }
}

async function getHuggingFaceDownloads(repositories, fallback) {
  let total = 0;
  for (const repository of repositories) {
    try {
      const response = await fetch(`${huggingFaceEndpoint}/api/models/${repository}`);
      if (!response.ok) {
        console.warn(
          `Hugging Face returned ${response.status} for ${repository}; keeping ${fallback}`
        );
        return fallback;
      }
      const data = await response.json();
      if (!Number.isFinite(data.downloads)) {
        console.warn(`Hugging Face returned no download count for ${repository}; keeping ${fallback}`);
        return fallback;
      }
      total += data.downloads;
    } catch (error) {
      console.warn(`Hugging Face request failed for ${repository}; keeping ${fallback}`, error);
      return fallback;
    }
  }
  return total;
}

const currentMetrics = JSON.parse(await readFile(metricsPath, "utf8"));
let citationsByTitle = null;
try {
  citationsByTitle = await getScholarCitations();
} catch (error) {
  console.warn("Google Scholar request failed; keeping existing citation counts", error);
}
const updatedProjects = {};

for (const [projectId, config] of Object.entries(projects)) {
  const current = currentMetrics.projects[projectId] || {};
  const citations = citationsByTitle
    ? config.scholarTitles.reduce(
        (total, title) => total + (citationsByTitle.get(title) || 0),
        0
      )
    : current.citations;
  updatedProjects[projectId] = { citations };
  if (config.repository) {
    updatedProjects[projectId].stars = await getGitHubStars(config.repository, current.stars);
  }
  if (config.models) {
    const downloads = await getHuggingFaceDownloads(config.models, current.downloads);
    if (Number.isFinite(downloads)) updatedProjects[projectId].downloads = downloads;
  }
}

const updatedMetrics = {
  updatedAt: new Date().toISOString(),
  sources: {
    ...currentMetrics.sources,
    downloads: "Hugging Face (last 30 days)",
  },
  projects: updatedProjects,
};
await writeFile(metricsPath, `${JSON.stringify(updatedMetrics, null, 2)}\n`);
