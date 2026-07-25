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

// 绑定滚动事件
window.addEventListener("scroll", () => {
  handleHeaderScroll();
  handleListScroll();
});

// 初始化检查
handleHeaderScroll();
handleListScroll();

// Fade the hero content as it scrolls behind the fixed header.
const hero = document.querySelector(".hero");
const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");
let heroAnimationFrame = null;

function updateHeroScrollEffect() {
  heroAnimationFrame = null;
  if (!hero || reducedMotion.matches) {
    return;
  }

  const heroTop = hero.getBoundingClientRect().top;
  const fadeDistance = Math.max(240, Math.min(hero.offsetHeight * 0.6, 420));
  const progress = Math.min(Math.max((45 - heroTop) / fadeDistance, 0), 1);
  const easedProgress = progress * progress * (3 - 2 * progress);
  hero.style.setProperty("--hero-scroll-progress", easedProgress.toFixed(3));
}

function requestHeroScrollEffect() {
  if (heroAnimationFrame === null) {
    heroAnimationFrame = window.requestAnimationFrame(updateHeroScrollEffect);
  }
}

window.addEventListener("scroll", requestHeroScrollEffect, { passive: true });
window.addEventListener("resize", requestHeroScrollEffect);
updateHeroScrollEffect();

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
