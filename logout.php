<?php
/**
 * PHP Version 7.2.6
 * Logout from admin script
 *
 * @category Script
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://nolinkyet.com.br
 */
session_start();
session_destroy();
header('Location: index.php');
