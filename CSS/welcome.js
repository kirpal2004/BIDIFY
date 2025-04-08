var t1 = gsap.timeline();

t1.from("#loader h1", {
  x: 40,
  opacity: 0,
  duration: 1,
  stagger: 0.1,
});
t1.from(
  ".avade span",
  {
    y: 100,
    opacity: 0,
    stagger: 0.1,
    duration: 0.3,
  },
  "-=0.5"
);

t1.to(
  "#loader",
  {
    opacity: 0,
    duration: 1,
  },
  "+=1"
);

t1.set("#loader", {
  display: "none",
});

var swiper = new Swiper(".swiper-container", {
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});
