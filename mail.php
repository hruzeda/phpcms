<?php
/**
 * PHP Version 7.3.1
 * Mail script
 *
 * @category Script
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://phpcms.com.br
 */
session_start();
require_once 'const.php';
require_once 'vendor/autoload.php';
require_once 'php/App.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_SESSION['contact_token']) && $_POST) {
    $token = $_POST['token'];

    if ($_SESSION['contact_token'] !== $token) {
        die('Falha de autenticação.');
    }

    $email = app\App::secureString($_POST['email']);
    $msg = app\App::secureString($_POST['msg']);

    $body = "<html><head><meta charset='utf-8'/></head><body><div style='width:400px'>";
    $body .= "<h4>Contato do Site</h4><p style='font: 12px sans-serif;'>";

    $mail = new PHPMailer(true);
    try {
        $mail->setFrom($email);
        $mail->addAddress('', 'Contato - Centro Castelo');
        $mail->isHTML(true);
        $mail->Subject = 'Contato do site';
        $mail->Body = $body . $msg . "</p></div></body></html>";
        $mail->send();
        die('Mensagem enviada com sucesso!');
    } catch (Exception $ex) {
        die('Houve um erro ao enviar sua mensagem. Tente enviar sua mensagem diretamente por e-mail!');
    }
}

die('0');
