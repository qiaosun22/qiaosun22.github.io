import { readFile, writeFile } from "node:fs/promises";

const metricsPath = new URL("../assets/data/research-metrics.json", import.meta.url);
const homepagePath = new URL("../index.html", import.meta.url);
const scholarId = "wEoImc8AAAAJ";
const huggingFaceEndpoint = process.env.HF_ENDPOINT || "https://huggingface.co";
const projects = {
  embodiedsmith: {
    scholarTitles: [
      "embodiedsmith: scaling embodied data through recursive self-improvement flywheel in simulation",
    ],
  },
  geolam: {
    scholarTitles: [
      "geolam: learning geometry-grounded latent actions from unlabeled human videos",
    ],
    repository: "IvanXie416/GeoLAM",
    models: ["Ivan416/GeoLAM"],
  },
  "4d-wam": {
    scholarTitles: [
      "4d-wam: infusing spatiotemporal awareness into world action models through trajectory fields",
    ],
    repository: "lishanyqy/4DWAM",
    models: [
      "lishanyang/4dwam_fastwam_joint_libero",
      "lishanyang/4dwam_fastwam_joint_robotwin_full",
    ],
  },
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
    repository: "qiaosun22/PEWM",
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
  const matchedTitles = config.scholarTitles.filter((title) => citationsByTitle?.has(title));
  const citations = matchedTitles.length
    ? matchedTitles.reduce((total, title) => total + citationsByTitle.get(title), 0)
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

// Keep the initial HTML and the no-JavaScript fallback in sync with the same data.
const homepage = await readFile(homepagePath, "utf8");
const updatedHomepage = homepage.replace(
  /<a\b[^>]*\bdata-project-id="([^"]+)"[^>]*>[\s\S]*?<\/a>/g,
  (link, projectId) => {
    const metricName = link.includes("data-github-repo=")
      ? "stars"
      : link.includes('data-metric="downloads"') ? "downloads" : "citations";
    const count = updatedProjects[projectId]?.[metricName];
    if (!Number.isFinite(count)) return link;
    const formattedCount = count.toLocaleString("en-US");
    const unit = {
      citations: "Google Scholar citations",
      stars: "GitHub stars",
      downloads: "Hugging Face downloads in the last 30 days",
    }[metricName];
    return link
      .replace(/(<span class="resource-metric"[^>]*)(>)/, (_, attributes, end) => {
        const updatedAttributes = attributes
          .replace(/\s+hidden\b/g, "")
          .replace(/aria-label="[^"]*"/, `aria-label="${formattedCount} ${unit}"`);
        return `${updatedAttributes}${count > 0 ? "" : " hidden"}${end}`;
      })
      .replace(/(<span class="metric-value">)[\s\S]*?(<\/span>)/, `$1${formattedCount}$2`);
  }
);
if (updatedHomepage !== homepage) await writeFile(homepagePath, updatedHomepage);
