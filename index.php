<?php
/**
 * PHP Version 7.2.6
 * Index page of the blog
 *
 * @category Page
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://nolinkyet.com.br
 */
session_start();
require_once 'const.php';
require_once ROOT . 'vendor/autoload.php';
require_once ROOT . "php/App.php";
require_once ROOT . "php/Banner.php";
require_once ROOT . "php/Post.php";
require_once ROOT . "php/DynamicBlock.php";
require_once ROOT . 'inc/top.php'; ?>

<!-- ADD THE NEW BANNER PLUGIN -->
<div id="banner">
    <?php $mysql = app\App::getConnection();
    $banners = app\Banner::loadAll($mysql, 'sequence ASC', 0, 5);

    $i = 0;
    foreach ($banners as $banner) { ?>
      <div class="carousel-item<?= $i == 0 ? ' active' : ''; ?>"
        data-id="<?= $banner->getId(); ?>"
        data-type="banner"
        data-image="<?= $banner->getImage(); ?>"
        data-link="<?= $banner->getLink(); ?>"
        data-sequence="<?= $banner->getSequence(); ?>">
        <a href="<?= $banner->getLink(); ?>"><img class="d-block w-100" src="<?= $banner->getImage(); ?>" /></a>
      </div>
    <?php $i++;
    } ?>
</div>

<div class="row">
  <div class="col-md-8 blog-main">
    <?php $posts = app\Post::loadAll($mysql, 'last_update DESC', 0, 5);
    foreach ($posts as $post) { ?>
      <div class="blog-post"
        data-id="<?= $post->getId(); ?>"
        data-type="post"
        data-title="<?= $post->getTitle(); ?>"
        data-content="<?= $post->getContent(); ?>">
        <h2 class="blog-post-title"><?= $post->getTitle(); ?></h2>
        <div class="row">
          <p class="col-md-4 text-justify"><img width="100%" src="<?= $post->getThumb(); ?>"/></p>
          <div class="col">
            <p class="blog-post-body"><?= $post->getExcerpt(); ?></p>
            <a href="noticia.php?id=<?= $post->getId(); ?>">Saiba mais</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div><!-- /.blog-main -->

<?php require_once 'inc/foot.php'; ?>
