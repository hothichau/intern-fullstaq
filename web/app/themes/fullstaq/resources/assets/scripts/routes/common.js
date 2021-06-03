const slider = () => {
  $('.js-icon-slider').slick({
    slidesToShow: 2,
      slidesToScroll: 2,
      dots: true,
      mobileFirst: true,
      responsive: [
        {
          breakpoint: 540,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 4,
          },
        },
      ],
  });
};

export default {
  init() {
    slider();
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
