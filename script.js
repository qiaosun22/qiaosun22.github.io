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
