<?php
/**
 * PHP Version 7.2.6
 * The custom page view
 *
 * @category View
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://centrocastelo.org.br
 */
session_start();

if (!isset($_GET['id'])) {
    header("Location: index.php");
} else {
    $id = intval($_GET['id']);
}

require_once 'const.php';
require_once ROOT . 'vendor/autoload.php';
require_once ROOT . "php/App.php";
require_once ROOT . "php/Banner.php";
require_once ROOT . "php/Post.php";
require_once ROOT . "php/Page.php";
require_once ROOT . "php/DynamicBlock.php";
require_once ROOT . 'inc/top.php'; ?>

<div class="row">
  <div class="col-md-8 blog-main">
    <?php $mysql = app\App::getConnection();
      $page = app\Page::load($mysql, $id); ?>
      <div class="blog-post page"
          data-id="<?= $page->getId(); ?>"
          data-image="<?= $page->getImage(); ?>"
          data-thumb="<?= $page->getThumb(); ?>"
          data-title="<?= $page->getTitle(); ?>"
          data-content="<?= strip_tags($page->getContent()); ?>">
        <h1 class="blog-post-title mb-1"><?= $page->getTitle(); ?></h1>
        <!--<p class="small font-italic text-muted"><?= $page->getLastUpdate(); ?></p>-->
        <p class="text-center"><img width="100%" src="<?= $page->getImage(); ?>"/></p>
        <p class="blog-post-body"><?= $page->getHTMLContent(); ?></p>
      </div>

      <div class="fb-comments"
         data-href="http://centrocastelo.org.br/page.php?id=<?= $page->getId(); ?>"
         data-width="100%" data-numposts="5"></div>
  </div><!-- /.blog-main -->

<?php require_once 'inc/foot.php'; ?>

