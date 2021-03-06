const initSelect = () => {
  const select = $('.gform_wrapper select');
  if (select.length) {
    $(window).on('resize.select2', function () {
      select.select2({
        minimumResultsForSearch: Infinity,
        width: '100%',
      });
    }).trigger('resize.select2');
  }
};

const customUpload = () => {
  $('.upload-file').append('<span class="upload-file__file-name"></span>');
  $('.upload-file input[type=file]').on('change', function () {
    if ($(this).length > 0 && $(this)[0].files !== undefined && $(this)[0].files.length) {
      const nameFile = $(this)[0].files[0].name;
      $('.upload-file__file-name').text(nameFile);
    }
    else {
      $('.upload-file__file-name').text('');
    }
  });
};

const slider = () => {
  $('.js-icon-slider').slick({
    dots: true,
    infinite: false,
    speed: 500,
    slidesToShow: 4,
    slidesToScroll: 4,
    initialSlide: 0,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          initialSlide: 2,
        },
      },
    ],
  });
};

const scroll = () => {
  $(window).scroll(function () {
    $(window).scrollTop() > 5 ? $('.js-header').addClass('header--scroll') : $('.js-header').removeClass('header--scroll');
  });
};

const menuEvent = function () {
  $('.header .dropdown > a').on('click', function (event) {
    event.preventDefault();
    if ($(this).hasClass('active')) {
      $(this).removeClass('active').next().slideUp();
    } else {
      $('.header .dropdown > a.active').removeClass('active').next().slideUp();
      $(this).addClass('active').next().slideDown();
    }
  });
}

export default {
  init() {
    slider();
    scroll();
    menuEvent();
    initSelect();
    customUpload();
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
