<?php
/**
 * PHP Version 7.3.1
 * Main view of the blog
 *
 * @category View
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://phpcms.com.br
 */
session_start();
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require_once 'const.php';
require_once ROOT . 'vendor/autoload.php';
require_once ROOT . "php/App.php";
require_once ROOT . "php/Banner.php";
require_once ROOT . "php/Post.php";
require_once ROOT . "php/Page.php";
require_once ROOT . "php/DynamicBlock.php";
require_once ROOT . 'inc/top.php'; ?>

<div id="slider" class="w-100">
  <?php $banners = app\Banner::loadAll($mysql, 'sequence ASC', 0, 5);

  $i = 0;
  foreach ($banners as $banner) { ?>
    <div class="slide <?= $i == 0 ? 'active' : ''; ?>"
      data-id="<?= $banner->getId(); ?>"
      data-type="banner"
      data-image="<?= $banner->getImage(); ?>"
      data-link="<?= $banner->getLink(); ?>"
      data-sequence="<?= $banner->getSequence(); ?>">
      <?php if(strlen($banner->getLink()) > 0) { ?>
        <a href="<?= $banner->getLink(); ?>">
      <?php } ?>
      <img class="d-block" src="<?= $banner->getImage(); ?>" />
      <?php if(strlen($banner->getLink()) > 0) { ?>
        </a>
      <?php } ?>
    </div>
    <?php $i++;
  } ?>
</div>

<div class="row">
  <div class="col-md-8 blog-main">
    <?php $paginationSize = 5;
    if($_GET && isset($_GET['p']))
      $p = intval($_GET['p']);
    else
      $p = 0;

    $posts = app\Post::loadAll($mysql, 'updated DESC', $p, $paginationSize);
    foreach ($posts as $post) { ?>
      <div class="blog-post post"
        data-id="<?= $post->getId(); ?>"
        data-type="post"
        data-title="<?= $post->getTitle(); ?>"
        data-content="<?= $post->getContent(); ?>">
        <a class="text-dark" href="post/<?= $post->getId(); ?>">
          <h2 class="blog-post-title"><?= $post->getTitle(); ?></h2>
        </a>
        <div class="row">
          <p class="col-md-4 text-justify"><img width="100%" src="<?= $post->getThumb(); ?>"/></p>
          <div class="col">
            <p class="blog-post-body"><?= $post->getExcerpt(); ?></p>
            <a href="post/<?= $post->getId(); ?>">Saiba mais</a>
          </div>
        </div>
      </div>
    <?php } ?>

    <div class="blog-pagination bg-light">
      <?php $amount = app\Post::getTotalAmount($mysql);
      $pagination = $amount / $paginationSize;
      for($i = 0; $i < $pagination; $i++) {
        if($i == $p){ ?>
          <button type="button" class="btn btn-primary" disabled><?= $i+1; ?></button>
        <?php } else { ?>
          <button type="button" class="btn btn-primary" onclick="location.href='index.php?p=<?= $i; ?>';"><?= $i+1; ?></button>
        <?php }
      } ?>
    </div>
  </div><!-- /.blog-main -->

<?php require_once 'inc/foot.php'; ?>
