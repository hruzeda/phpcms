<?php
/**
 * PHP Version 7.2.6
 * Mail script
 *
 * @category Script
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://nolinkyet.com.br
 */
session_start();
require_once 'const.php';
require_once 'php/App.php';
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_SESSION['contato_token']) && $_POST) {
    $token = $_POST['token'];

    if($_SESSION['contato_token'] !== $token) {
        die('Falha de autenticação.');
    }

    $email = app\App::secureString($_POST['email']);
    $msg = app\App::secureString($_POST['msg']);

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'hidden';
        $mail->SMTPAuth = true;
        $mail->Username = 'hidden';
        $mail->Password = 'hidden';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($email);
        $mail->addAddress('contato@centrocastelo.org.br', 'Contato - Centro Castelo');
        $mail->isHTML(true);
        $mail->Subject = 'Contato do site';
        $mail->Body = $msg;
        $mail->send();
    } catch(Exception $ex) {
        die('Houve um erro ao enviar sua mensagem. Tente enviar sua mensagem diretamente por e-mail!');
    }
}

die('0');
