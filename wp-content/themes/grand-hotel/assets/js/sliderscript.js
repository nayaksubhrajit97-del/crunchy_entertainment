document.addEventListener('DOMContentLoaded', function () {
    var primarySlider = new Splide('#primary_slider', {
      type: 'fade',
      heightRatio: 0.5,
      pagination: false,
      arrows: false,
      cover: true,
    });

    var thumbnailSlider = new Splide('#thumbnail_slider', {
      rewind: true,
      fixedWidth: 100,
      fixedHeight: 64,
      isNavigation: true,
      gap: 10,
      focus: 'center',
      pagination: false,
      cover: true,
      breakpoints: {
        '600': {
          fixedWidth: 66,
          fixedHeight: 40,
        }
      }
    }).mount();

    primarySlider.sync(thumbnailSlider).mount();
  });