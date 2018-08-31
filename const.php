<?php
/**
 * PHP Version 7.2.6
 * Script for constants initialization
 *
 * @category Script
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://centrocastelo.org.br
 */
setlocale(LC_ALL, 'pt_BR');
define("ROOT", __DIR__ . "/");

if (isset($_SESSION['logged_user'])) {
    define("LOGGED_USER", $_SESSION['logged_user']);
} else {
    define("LOGGED_USER", null);
}
