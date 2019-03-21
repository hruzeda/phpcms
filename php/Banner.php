<?php
/**
 * PHP Version 7.3.1
 * Banner class
 *
 * @category Class
 * @package  app
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://phpcms.com.br
 */

namespace app;

class Banner
{
    private $id;
    private $image;
    private $link;
    private $sequence;

    /**
     * Banner constructor.
     * @param $image
     * @param $link
     * @param $sequence
     */
    public function __construct($image, $link, $sequence)
    {
        $this->id = null;
        $this->image = $image;
        $this->sequence = $sequence;
        $this->link = $link;
    }

    /**
     * @param $mysql
     * @param $id
     * @return Banner|null
     */
    public static function load($mysql, $id)
    {
        $result = $mysql->query("SELECT image, link, sequence FROM banner WHERE " . "id = {$id} LIMIT 1");
        if ($result->num_rows === 1) {
            $result->data_seek(0);
            $result = $result->fetch_assoc();

            $banner = new Banner($result['image'], $result['link'], $result['sequence']);
            $banner->id = $id;
            return $banner;
        } else {
            return null;
        }
    }

    /**
     * @param $mysql
     * @param $order
     * @param $page
     * @param $pageSize
     * @return array
     */
    public static function loadAll($mysql, $order, $page, $pageSize)
    {
        $page *= $pageSize;
        $list = array();

        $result =
            $mysql->query("SELECT id, image, link, sequence FROM banner ORDER BY {$order} LIMIT {$page}, {$pageSize}");
        if ($result->num_rows > 0) {
            $result->data_seek(0);
            while ($bResult = $result->fetch_assoc()) {
                $banner = new Banner($bResult['image'], $bResult['link'], $bResult['sequence']);
                $banner->id = $bResult['id'];
                array_push($list, $banner);
            }
        }

        return $list;
    }

    /**
     * @return array of types
     */
    public static function getAttributeArray()
    {
        return json_encode(array('image' => array('type' => 'image', 'placeholder' => '', 'required' => 'true'),
            'link' => array('type' => 'string', 'placeholder' => 'Link', 'required' => 'false'),
            'sequence' => array('type' => 'int', 'placeholder' => 'Posição', 'required' => 'true')), JSON_FORCE_OBJECT);
    }

    /**
     * @param $mysql
     * @return bool|string
     */
    public function save($mysql)
    {
        $status = true;
        if (is_array($this->image)) {
            try {
                $this->image = App::saveImage($this->image, 907);
            } catch (\Exception $ex) {
                $status = $ex->getMessage();
            }
        }

        if ($status === true) {
            if ($this->id > 0) {
                $status = $mysql->query("UPDATE banner SET " .
                    "image = '{$this->image}', link = '{$this->link}', sequence = {$this->sequence} " .
                    "WHERE id = {$this->id}");
            } else {
                $status = $mysql->query("INSERT INTO banner(image, link, sequence) VALUES " .
                    "('{$this->image}', '{$this->link}', {$this->sequence})");
                $this->id = $mysql->insert_id;
            }
        }

        $status = $status === true ? $this->saveSequence($mysql) : $mysql->error;
        return $status;
    }

    /**
     * @param $mysql
     * @return bool|string
     */
    private function saveSequence($mysql)
    {
        $result = $mysql->query("SELECT id, sequence FROM banner WHERE " .
            "sequence >= {$this->sequence} AND id != {$this->id} ORDER BY sequence ASC");

        $status = true;
        if ($result->num_rows > 0) {
            $pointer = array('id' => $this->id, 'sequence' => $this->sequence);
            while ($banner = $result->fetch_assoc() && $status === true) {
                $diff = $pointer['sequence'] - $banner['sequence'];
                if ($diff >= 1) {
                    break;
                } else {
                    $status = $mysql->query("UPDATE banner SET sequence = " . ((0 - $diff) + $banner['sequence'] + 1) .
                        " WHERE id = {$banner['id']}");
                    $pointer = $banner;
                }
            }
        }

        return $status === true ? $status : $mysql->error;
    }

    /**
     * @param $mysql
     * @return bool|string
     */
    public function delete($mysql)
    {
        $status = true;
        $status = $mysql->query("DELETE FROM banner WHERE id = {$this->getId()}");
        if ($status !== true) {
            $status = $mysql->error;
        }
        return $status;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return int
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * @param int $sequence
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;
    }
}
