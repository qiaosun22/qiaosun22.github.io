// 动态控制 Section Header 的动画
const headers = document.querySelectorAll(".section-header");
function handleHeaderScroll() {
  headers.forEach((header) => {
    const rect = header.getBoundingClientRect();
    if (rect.top < window.innerHeight && rect.bottom > 0) {
      header.classList.add("visible");
    } else {
      header.classList.remove("visible");
    }
  });
}

// 动态控制列表项的动画
const listItems = document.querySelectorAll(".list-group li");
function handleListScroll() {
  listItems.forEach((item) => {
    const rect = item.getBoundingClientRect();
    if (rect.top < window.innerHeight && rect.bottom > 0) {
      item.classList.add("visible");
    } else {
      item.classList.remove("visible");
    }
  });
}

const headerLinks = Array.from(document.querySelectorAll(".header-links a[href^='#']"));
const navigationSections = headerLinks
  .map((link) => document.querySelector(link.getAttribute("href")))
  .filter(Boolean);
let lockedNavigationId = null;
let lockedNavigationScrollY = null;
let navigationHasMoved = window.scrollY > 0;
let previousNavigationScrollY = window.scrollY;

function setActiveNavigation(activeId) {
  headerLinks.forEach((link) => {
    const isActive = link.getAttribute("href") === `#${activeId}`;
    link.classList.toggle("active", isActive);
    if (isActive) {
      link.setAttribute("aria-current", "location");
    } else {
      link.removeAttribute("aria-current");
    }
  });
}

headerLinks.forEach((link) => {
  link.addEventListener("click", () => {
    lockedNavigationId = link.getAttribute("href").slice(1);
    lockedNavigationScrollY = null;
    setActiveNavigation(lockedNavigationId);
    window.requestAnimationFrame(() => {
      lockedNavigationScrollY = window.scrollY;
    });
  });
});

function handleNavigationScroll() {
  if (
    lockedNavigationId &&
    (lockedNavigationScrollY === null || Math.abs(window.scrollY - lockedNavigationScrollY) <= 4)
  ) {
    setActiveNavigation(lockedNavigationId);
    return;
  }

  if (!navigationHasMoved) {
    setActiveNavigation(null);
    return;
  }

  lockedNavigationId = null;
  lockedNavigationScrollY = null;
  const marker = window.scrollY + Math.min(window.innerHeight * 0.3, 240);
  let activeSection = null;

  navigationSections.forEach((section) => {
    if (section.offsetTop <= marker) {
      activeSection = section;
    }
  });

  if (window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - 4) {
    activeSection = navigationSections[navigationSections.length - 1] || null;
  }

  setActiveNavigation(activeSection ? activeSection.id : null);
}

// 绑定滚动事件
window.addEventListener("scroll", () => {
  if (window.scrollY !== previousNavigationScrollY) {
    navigationHasMoved = true;
    previousNavigationScrollY = window.scrollY;
  }
  handleHeaderScroll();
  handleListScroll();
  handleNavigationScroll();
});

// 初始化检查
handleHeaderScroll();
handleListScroll();
handleNavigationScroll();

// Load project videos only when they are near the viewport.
const lazyVideos = document.querySelectorAll("video.lazy-video");
if ("IntersectionObserver" in window) {
  const videoObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        const video = entry.target;
        if (entry.isIntersecting) {
          if (!video.src) {
            video.src = video.dataset.src;
            video.load();
          }
          video.play().catch(() => {});
        } else {
          video.pause();
        }
      });
    },
    { rootMargin: "200px 0px", threshold: 0.1 }
  );

  lazyVideos.forEach((video) => videoObserver.observe(video));
} else {
  lazyVideos.forEach((video) => {
    video.src = video.dataset.src;
    video.load();
  });
}

// Refresh GitHub star counts while retaining the inline fallback if the API is unavailable.
const starLinks = document.querySelectorAll("[data-github-repo]");
const starCacheLifetime = 6 * 60 * 60 * 1000;

function updateStarMetric(link, count) {
  const value = link.querySelector(".metric-value");
  const metric = link.querySelector(".resource-metric");
  const formattedCount = Number(count).toLocaleString("en-US");
  if (value) value.textContent = formattedCount;
  if (metric) metric.setAttribute("aria-label", `${formattedCount} GitHub stars`);
}

function updateCitationMetric(link, count) {
  const value = link.querySelector(".metric-value");
  const metric = link.querySelector(".resource-metric");
  const formattedCount = Number(count).toLocaleString("en-US");
  if (value) value.textContent = formattedCount;
  if (metric) metric.setAttribute("aria-label", `${formattedCount} Google Scholar citations`);
}

fetch("assets/data/research-metrics.json")
  .then((response) => (response.ok ? response.json() : null))
  .then((metrics) => {
    if (!metrics || !metrics.projects) return;
    document.querySelectorAll("[data-project-id]").forEach((link) => {
      const project = metrics.projects[link.dataset.projectId];
      if (!project) return;
      if (link.dataset.githubRepo && Number.isFinite(project.stars)) {
        updateStarMetric(link, project.stars);
      } else if (!link.dataset.githubRepo && Number.isFinite(project.citations)) {
        updateCitationMetric(link, project.citations);
      }
    });
  })
  .catch(() => {});

starLinks.forEach(async (link) => {
  const repository = link.dataset.githubRepo;
  const cacheKey = `github-stars:${repository}`;

  try {
    const cached = JSON.parse(localStorage.getItem(cacheKey));
    if (cached && Date.now() - cached.updatedAt < starCacheLifetime) {
      updateStarMetric(link, cached.count);
      return;
    }
  } catch (_) {
    // Ignore unavailable or malformed browser storage.
  }

  try {
    const response = await fetch(`https://api.github.com/repos/${repository}`, {
      headers: { Accept: "application/vnd.github+json" },
    });
    if (!response.ok) return;

    const repositoryData = await response.json();
    updateStarMetric(link, repositoryData.stargazers_count);
    try {
      localStorage.setItem(
        cacheKey,
        JSON.stringify({ count: repositoryData.stargazers_count, updatedAt: Date.now() })
      );
    } catch (_) {
      // The visible count is already updated; persistence is optional.
    }
  } catch (_) {
    // Keep the server-rendered fallback count when the request fails.
  }
});


//// Scroll-triggered animation for section headers
//const headers = document.querySelectorAll(".section-header");
//
//window.addEventListener("scroll", () => {
//headers.forEach((header) => {
//  const rect = header.getBoundingClientRect();
//  if (rect.top < window.innerHeight - 100) {
//    header.classList.add("visible");
//  }
//});
//});
