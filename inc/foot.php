<?php
/**
 * PHP Version 7.3.1
 * Foot include for all pages
 *
 * @category Include
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://phpcms.com.br
 */ ?>

<aside class="col-md-4 blog-sidebar">
    <?php $dynamicBlock = app\DynamicBlock::load($mysql, 1); ?>
  <div class="p-4 py-5 my-3 dynamic-block"
       data-id="<?= $dynamicBlock->getId(); ?>"
       data-page="<?= $dynamicBlock->getPage(); ?>"
       data-content="<?= $dynamicBlock->getContent(); ?>"
       style="background: #feb614 url('img/ocentro.png') 95% 5% no-repeat;">
    <h4>O Centro</h4>
    <p class="mb-0"><?= $dynamicBlock->getHTMLContent(); ?></p>
    <a href="page/<?= $dynamicBlock->getPage(); ?>">Saiba mais</a>
  </div>

    <?php $dynamicBlock = app\DynamicBlock::load($mysql, 2); ?>
  <div class="p-4 py-5 mb-3 dynamic-block"
       data-id="<?= $dynamicBlock->getId(); ?>"
       data-page="<?= $dynamicBlock->getPage(); ?>"
       data-content="<?= $dynamicBlock->getContent(); ?>"
       style="background: #0065b3 url('img/residencia.png') 95% 5% no-repeat;">
    <h4>Residência</h4>
    <p class="mb-0"><?= $dynamicBlock->getHTMLContent(); ?></p>
    <a href="page/<?= $dynamicBlock->getPage(); ?>">Saiba mais</a>
  </div>

    <!--< ?php $dynamicBlock = app\DynamicBlock::load($mysql, 3); ?>
  <div class="p-4 py-5 mb-3 dynamic-block"
       data-id="< ?= $dynamicBlock->getId(); ?>"
       data-page="< ?= $dynamicBlock->getPage(); ?>"
       data-content="< ?= $dynamicBlock->getContent(); ?>"
       style="background: #9e9fa3 url('img/noticias.png') 95% 5% no-repeat;">
    <h4>Notícias</h4>
    <p class="mb-0">< ?= $dynamicBlock->getHTMLContent(); ?></p>
    <a href="page/< ?= $dynamicBlock->getPage(); ?>">Saiba mais</a>
  </div>-->
</aside><!-- /.blog-sidebar -->
</div><!-- /.row -->
</main><!-- /.container -->

<footer class="blog-footer container-fluid">
  <div class="container row mx-auto">
    <div class="col-md-4 col-sm-12 my-5 px-4">
      <h4>Localização</h4>
        <?php $dynamicBlock = app\DynamicBlock::load($mysql, 4); ?>
      <p class="dynamic-block"
         data-id="<?= $dynamicBlock->getId(); ?>"
         data-page="<?= $dynamicBlock->getPage(); ?>"
         data-content="<?= $dynamicBlock->getContent(); ?>">
            <?= $dynamicBlock->getHTMLContent(); ?>
        Fone: <a href="tel:+551932432164">+55 19 3243-2164</a>
      </p>

      <div id="mapView"></div>
      <script type="text/javascript">
        $(() => {
          // HERE-JS (MAPS)
          let platform = new H.service.Platform({
            app_id: 'Bp4vZ7fRoslHTcMCmYq9',
            app_code: 'qSkHpzYFytDS6-V-R21-DQ'
          });

          $('#mapView').on('click', (event) => {
            window.open('https://www.google.com/maps/search/?api=1&query=<?= $dynamicBlock->getTextContent(); ?>',
              '_blank');
          });

          let search = new H.places.Search(platform.getPlacesService());
          search.request({
            'q': '<?= $dynamicBlock->getTextContent(); ?>',
            'at': '-22.90902,-47.06461'
          }, {}, (data) => {
            let position = data.results.items[0].position;
            let point = new H.geo.Point(position[0], position[1]);
            let defaultLayers = platform.createDefaultLayers();

            let map = new H.Map($('#mapView')[0], defaultLayers.normal.map, {
              center: point,
              zoom: 15
            });

            let marker = new H.map.Marker(point);
            map.addObject(marker);
          }, (data) => {
            console.error(data);
          });
        });
      </script>
    </div>

    <div class="col-md-4 col-sm-12 my-5 px-4">
      <h4>Facebook</h4>
      <div class="fb-page" data-href="https://www.facebook.com/"
           data-tabs="timeline" data-height="310" data-small-header="false"
           data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
      </div>
    </div>
    <div class="col-md-4 col-sm-12 my-5 px-4">
      <h4>Fale Conosco</h4>

        <?php $token = app\App::generateToken('contact'); ?>
      <form id="contactForm" method="post" action="mail.php">
        <input type="hidden" name="token" value="<?= $token; ?>" />

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
<script type="text/javascript" src="node_modules/katex/dist/katex.min.js"></script>
<script type="text/javascript" src="node_modules/highlight.js/lib/highlight.js"></script>
<script type="text/javascript" src="node_modules/quill/dist/quill.min.js"></script>
<script type="text/javascript" src="node_modules/here-js-api/scripts/mapsjs-core.js"></script>
<script type="text/javascript" src="node_modules/here-js-api/scripts/mapsjs-service.js"></script>
<script type="text/javascript" src="node_modules/here-js-api/scripts/mapsjs-places.js"></script>
<script type="text/javascript" src="js/clamp.min.js"></script>
<script type="text/javascript" src="js/init.plugin.js"></script>
</body>
</html>
