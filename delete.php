<?php
/**
 * PHP Version 7.3.1
 * Delete script
 *
 * @category Script
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://phpcms.com.br
 */
session_start();
require_once 'const.php';
require_once ROOT . "php/App.php";

if (LOGGED_USER === null) {
    die('0');
} elseif ($_POST) {
    $id = intval($_POST['id']);
    $entity = app\App::secureString($_POST['entity']);
    $mysql = app\App::getConnection();

    switch ($entity) {
        case "banner":
            require_once ROOT . "php/Banner.php";
            $banner = app\Banner::load($mysql, $id);
            die($banner->delete($mysql));
            break;

        case "dynamicBlock":
            require_once ROOT . "php/DynamicBlock.php";
            $dynamicBlock = app\DynamicBlock::load($mysql, $id);
            die($dynamicBlock->delete($mysql));
            break;

        case "post":
            require_once ROOT . "php/Post.php";
            $post = app\Post::load($mysql, $id);
            die($post->delete($mysql));
            break;

        case "page":
            require_once ROOT . "php/Page.php";
            $page = app\Page::load($mysql, $id);
            die($page->delete($mysql));
            break;
    }
}

die('0');
