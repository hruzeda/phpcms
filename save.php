<?php
/**
 * PHP Version 7.2.6
 * Save script
 *
 * @category Script
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://centrocastelo.org.br
 */
session_start();
require_once 'const.php';
require_once ROOT . "php/App.php";

if (LOGGED_USER === null) {
    die('0');
} elseif ($_POST && isset($_GET['entity'])) {
    $entity = app\App::secureString($_GET['entity']);
    $mysql = app\App::getConnection();

    switch ($entity) {
        case "banner":
            require_once ROOT . "php/Banner.php";

            $id = intval($_POST['id']);
            $image = $_FILES ? $_FILES['image'] : null;
            $link = app\App::secureString($_POST['link']);
            $sequence = intval($_POST['sequence']);

            if ($id === 0 && $image === null) {
                die("Image is required for a new banner.");
            }

            if ($id > 0) {
                $banner = app\Banner::load($mysql, $id);
                if ($image !== null) {
                    $banner->setImage($image);
                }
                $banner->setLink($link);
                $banner->setSequence($sequence);
            } else {
                $banner = new app\Banner($image, $link, $sequence);
            }

            die($banner->save($mysql));
            break;

        case "dynamicBlock":
            require_once ROOT . "php/DynamicBlock.php";

            $id = intval($_POST['id']);
            $page = intval($_POST['page']);
            $content = htmlentities($_POST['content'], ENT_QUOTES);

            if ($id > 0) {
                $dynamicBlock = app\DynamicBlock::load($mysql, $id);
                $dynamicBlock->setContent($content);
                $dynamicBlock->setPage($page);
                die($dynamicBlock->save($mysql));
            }
            break;

        case "post":
            require_once ROOT . "php/Post.php";

            $id = intval($_POST['id']);
            $image = $_FILES ? $_FILES['image'] : null;
            $title = app\App::secureString($_POST['title']);
            $content = htmlentities($_POST['content'], ENT_QUOTES);

            if ($id === 0 && $image === null) {
                die("Image is required for a new post.");
            }

            if ($id > 0) {
                $post = app\Post::load($mysql, $id);
                if ($image !== null) {
                    $post->setImage($image);
                }
                $post->setTitle($title);
                $post->setContent($content);
            } else {
                $post = new app\Post($image, null, $title, $content);
            }

            die($post->save($mysql));
            break;

        case "page":
            require_once ROOT . "php/Page.php";

            $id = intval($_POST['id']);
            $image = $_FILES ? $_FILES['image'] : null;
            $title = app\App::secureString($_POST['title']);
            $content = htmlentities($_POST['content'], ENT_QUOTES);

            if ($id === 0 && $image === null) {
                die("Image is required for a new page.");
            }

            if ($id > 0) {
                $page = app\Page::load($mysql, $id);
                if ($image !== null) {
                    $page->setImage($image);
                }
                $page->setTitle($title);
                $page->setContent($content);
            } else {
                $page = new app\Page($image, null, $title, $content);
            }

            die($page->save($mysql));
            break;
    }
}

die('0');
