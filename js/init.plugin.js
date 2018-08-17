/* eslint-env browser, jquery */
$(() => {
  $('#banner').slick({
    autoplay: true,
    autoplaySpeed: 3000,
    dots: false,
    arrows: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    adaptiveHeight: true,
  });

  hljs.configure({
    useBR: false
  });

  $('.blog-post-body').each((index, element) => {
    $clamp(element, {clamp: 9});
  });

  $(window).on('resize', (event) => {
    setTimeout(() => {
      $('.blog-post-body').each((index, element) => {
        $clamp(element, {clamp: 9});
      });
    }, 250);
  });
});
