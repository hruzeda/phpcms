<?php
/**
 * PHP Version 7.3.1
 * Model attribute API
 *
 * @category Script
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://phpcms.com.br
 */
session_start();
require_once 'const.php';

if (LOGGED_USER == null) {
    die('1');
} elseif ($_POST) {
    $model = $_POST['model'];

    switch ($model) {
        case 'Banner':
            require_once ROOT . "php/Banner.php";
            die(app\Banner::getAttributeArray());
            break;
        case 'Post':
            require_once ROOT . "php/Post.php";
            die(app\Post::getAttributeArray());
            break;
        case 'Page':
            require_once ROOT . "php/Page.php";
            die(app\Page::getAttributeArray());
            break;
        case 'DynamicBlock':
            require_once ROOT . "php/DynamicBlock.php";
            die(app\DynamicBlock::getAttributeArray());
            break;
    }
}