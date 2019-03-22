/* eslint-env browser, jquery */
$(() => {
  // SLICK CARROUSEL
  $('#banner').slick({
    autoplay: true,
    autoplaySpeed: 3000,
    dots: false,
    arrows: false,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    adaptiveHeight: true,
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
