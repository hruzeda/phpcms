<?php
/**
 * PHP Version 7.3.1
 * Logout from admin script
 *
 * @category Script
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://phpcms.com.br
 */
session_start();
session_destroy();
header('Location: index.php');
