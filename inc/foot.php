<?php
/**
 * PHP Version 7.2.6
 * Foot include for all pages
 *
 * @category Include
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://nolinkyet.com.br
 */ ?>

    <aside class="col-md-4 blog-sidebar">
      <?php $dynamicBlock = app\DynamicBlock::load($mysql, 1); ?>
      <div class="p-4 py-5 my-3 dynamic-block"
          data-id="<?= $dynamicBlock->getId(); ?>"
          data-content="<?= $dynamicBlock->getContent(); ?>"
          style="background: #feb614 url('img/ocentro.png') 95% 5% no-repeat;">
        <h4>O Centro</h4>
        <p class="mb-0"><?= $dynamicBlock->getHTMLContent(); ?></p>
        <a href="ocentro.php">Saiba mais</a>
      </div>

      <?php $dynamicBlock = app\DynamicBlock::load($mysql, 2); ?>
      <div class="p-4 py-5 mb-3 dynamic-block"
          data-id="<?= $dynamicBlock->getId(); ?>"
          data-content="<?= $dynamicBlock->getContent(); ?>"
          style="background: #0065b3 url('img/residencia.png') 95% 5% no-repeat;">
        <h4>Residência</h4>
        <p class="mb-0"><?= $dynamicBlock->getHTMLContent(); ?></p>
        <a href="residencia.php">Saiba mais</a>
      </div>

      <!--
      < ?php $dynamicBlock = app\DynamicBlock::load($mysql, 3); ?>
      <div class="p-4 py-5 mb-3 dynamic-block"
          data-id="< ?= $dynamicBlock->getId(); ?>"
          data-content="< ?= $dynamicBlock->getContent(); ?>"
          style="background: #9e9fa3 url('img/noticias.png') 95% 5% no-repeat;">
        <h4>Notícias</h4>
        <p class="mb-0">< ?= $dynamicBlock->getHTMLContent(); ?></p>
        <a href="noticias.php">Saiba mais</a>
      </div>-->
    </aside><!-- /.blog-sidebar -->
  </div><!-- /.row -->
</main><!-- /.container -->

<footer class="blog-footer container-fluid">
  <div class="container row mx-auto">
    <div class="col-md-4 col-sm-12 my-5 px-4">
      <h4>Localização</h4>
      <p class="dynamic-block">Rua Eng. Cândido Gomide, 557<br>
        Guanabara | Campinas | SP<br>
        CEP 13073-200<br>
        Fone: <a href="tel:+551932432164">+55 19 3243-2164</a></p>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3675.500073907935!2d-47.0708738928183!3d-22.894918932834468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c8c61df9826a1b%3A0x7ffa6b72ff430d05!2sR.+Eng.+C%C3%A2ndido+Gomide%2C+557+-+Jardim+Guanabara%2C+Campinas+-+SP%2C+13073-200!5e0!3m2!1spt-BR!2sbr!4v1526182589349"
        width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    <div class="col-md-4 col-sm-12 my-5 px-4">
      <h4>Facebook</h4>
      <div class="fb-page" data-href="https://www.facebook.com/centrocastelo.org.br/"
        data-tabs="timeline" data-height="310" data-small-header="false"
        data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
      </div>
    </div>
    <div class="col-md-4 col-sm-12 my-5 px-4">
      <h4>Fale Conosco</h4>
      <form method="post" action="">
        <div class="form-group">
          <input type="email" class="form-control" id="email" name="email" placeholder="Seu e-mail">
        </div>
        <div class="form-group">
          <textarea class="form-control" id="msg" name="msg" placeholder="Sua mensagem"></textarea>
        </div>
        <button type="submit" class="btn btn-danger">Enviar</button>
      </form>
    </div>
  </div>
</footer>

<script type="text/javascript" src="node_modules/slick-carousel/slick/slick.min.js"></script>
<script type="text/javascript" src="node_modules/jquery-form/dist/jquery.form.min.js"></script>
<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="node_modules/katex/dist/katex.min.js"></script>
<script type="text/javascript" src="node_modules/highlight.js/lib/highlight.js"></script>
<script type="text/javascript" src="node_modules/quill/dist/quill.min.js"></script>
<script type="text/javascript" src="js/clamp.min.js"></script>
<script type="text/javascript" src="js/init.plugin.js"></script>
</body>
</html>