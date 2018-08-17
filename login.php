<?php
/**
 * PHP Version 7.2.6
 * Login script
 *
 * @category Script
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://nolinkyet.com.br
 */
session_start();
require_once 'const.php';
require_once ROOT . "php/App.php";

if (LOGGED_USER != null) {
    die('1');
} elseif ($_POST) {
    $mysqli = app\App::getConnection();
    $result = $mysqli->query("SELECT pwd FROM `admin` LIMIT 1");

    if ($result->num_rows === 1) {
        $result->data_seek(0);
        $validHash = $result->fetch_assoc()['pwd'];

        $pwd = app\App::secureString($_POST['pwd']);
        $salt = '#supersalt@';
        $hash = hash_pbkdf2('sha512', $pwd, $salt, 17);

        if ($hash === $validHash) {
            $_SESSION['logged_user'] = true;
            die('1');
        }
    }
}

die('0');
