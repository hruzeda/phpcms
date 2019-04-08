/* eslint-env browser, jquery */
$(() => {
  // SLICK CARROUSEL
  const slider = $('#slider');
  slider.slick({
    autoplay: true,
    autoplaySpeed: 3000,
    dots: true,
    arrows: false,
    speed: 800,
    slidesToShow: 1,
    adaptiveHeight: true
  });

  $('#slider img').each((index, element) => {
    if($(element).height() > slider.height()) {
      $(element).height(slider.height());
    }
    $(element).animate({opacity: 1});
  });

  // CONTACT FORM
  $('#contactForm').ajaxForm((data) => {
    if (data === 'Mensagem enviada com sucesso!') {
      this.alert('Sucesso', 'success', data);
    } else {
      this.alert('Erro', 'danger', data);
    }
  });

  // HIGHTLIGHT-JS
  hljs.configure({
    useBR: false
  });

  // CLAMP-JS
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
