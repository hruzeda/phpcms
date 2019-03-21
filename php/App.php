<?php
/**
 * PHP Version 7.3.1
 * Main application class
 *
 * @category Class
 * @package  app
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://phpcms.com.br
 */
namespace app;

class App
{
    private static $instance;
    private static $connection;

    /**
     * App constructor.
     */
    public function __construct()
    {
        if (self::$instance != null) {
            return self::$instance;
        }
        self::$instance = $this;
        return self::$instance;
    }

    /**
     * @param $string
     * @return string
     * @throws \Exception
     */
    public static function secureString($string)
    {
        return self::getConnection()->real_escape_string(trim($string));
    }

    /**
     * @return \mysqli
     * @throws \Exception
     */
    public static function getConnection()
    {
        if (self::$connection != null) {
            return self::$connection;
        }

        self::$connection = new \mysqli("localhost", "root", "root", "cms");
        if (self::$connection->connect_error) {
            throw new \Exception("Unable to connect to database");
        }
        return self::$connection;
    }

    /**
     * @param $form
     * @return string
     */
    public static function generateToken($form)
    {
        $token = md5(uniqid(microtime(), true));
        $_SESSION[$form . '_token'] = $token;
        return $token;
    }

    /**
     * @param $uploadFile
     * @param $width
     * @return string
     * @throws \Exception
     */
    public static function saveImage($uploadFile, $width)
    {
        if (stripos($uploadFile['type'], 'jpeg') >= 0 || stripos($uploadFile['type'], 'jpg') >= 0) {
            $image = imagecreatefromjpeg($uploadFile['tmp_name']);
        } elseif (stripos($uploadFile['type'], 'gif') >= 0) {
            $image = imagecreatefromgif($uploadFile['tmp_name']);
        } elseif (stripos($uploadFile['type'], 'png') >= 0) {
            $image = imagecreatefrompng($uploadFile['tmp_name']);
        } else {
            throw new \Exception('Invalid format');
        }

        $image = imagescale($image, $width);
        $path = str_replace('\\', '/', 'img/upload/' . time() . '.jpg');
        imagejpeg($image, ROOT . $path, 70);
        return $path;
    }
}
