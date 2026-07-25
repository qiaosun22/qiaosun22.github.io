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

function handleNavigationScroll() {
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

  headerLinks.forEach((link) => {
    const isActive = activeSection && link.getAttribute("href") === `#${activeSection.id}`;
    link.classList.toggle("active", Boolean(isActive));
    if (isActive) {
      link.setAttribute("aria-current", "location");
    } else {
      link.removeAttribute("aria-current");
    }
  });
}

// 绑定滚动事件
window.addEventListener("scroll", () => {
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
