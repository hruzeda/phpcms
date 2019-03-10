<?php
/**
 * PHP Version 7.3.1
 * The post view
 *
 * @category View
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://phpcms.com.br
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
      $post = app\Post::load($mysql, $id); ?>
      <div class="blog-post post"
          data-id="<?= $post->getId(); ?>"
          data-image="<?= $post->getImage(); ?>"
          data-thumb="<?= $post->getThumb(); ?>"
          data-title="<?= $post->getTitle(); ?>"
          data-content="<?= strip_tags($post->getContent()); ?>">
        <h1 class="blog-post-title mb-1"><?= $post->getTitle(); ?></h1>
        <p class="small font-italic text-muted"><?= $post->getCreatedDate(); ?></p>
        <p class="text-center"><img width="100%" src="<?= $post->getImage(); ?>"/></p>
        <p class="blog-post-body"><?= $post->getHTMLContent(); ?></p>
      </div>

      <div class="fb-comments"
         data-href="http://phpcms.com.br/post.php?id=<?= $post->getId(); ?>"
         data-width="100%" data-numposts="5"></div>
  </div><!-- /.blog-main -->

<?php require_once 'inc/foot.php'; ?>

