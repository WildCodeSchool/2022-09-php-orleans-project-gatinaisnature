$(document).ready(function () {
    $(".owl-carousel").owlCarousel();
});

$(".carousel1").owlCarousel({
  loop: true,
  autoplay: true,
  autoplayTimeout: 3000,
  autoplayHoverPause: true,
  margin: 10,
  responsiveClass: true,
  nav: false,
  responsive: {
      0: {
          items: 1,
      },
      576: {
          items: 2,
      },
      768: {
          items: 3,
      },
      992: {
          items: 5,
      },
  },
});

$(".carousel2").owlCarousel({
    loop: true,
    autoplay: true,
    autoplayTimeout: 4000,
    autoplayHoverPause: true,
    margin: 30,
    responsiveClass: true,
    nav: false,
    responsive: {
        0: {
            items: 1,
        },
        576: {
            items: 2,
        },
        768: {
            items: 3,
        },
    },
});
