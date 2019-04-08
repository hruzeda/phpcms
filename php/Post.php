<?php
/**
 * PHP Version 7.3.1
 * Post class
 *
 * @category Class
 * @package  app
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://phpcms.com.br
 */

namespace app;

class Post
{
    private $id;
    private $image;
    private $thumb;
    private $title;
    private $content;
    private $updated;

    /**
     * Post constructor.
     * @param $image
     * @param $thumb
     * @param $title
     * @param $content
     */
    public function __construct($image, $thumb, $title, $content)
    {
        $this->id = null;
        $this->image = $image;
        $this->thumb = $thumb;
        $this->title = $title;
        $this->content = $content;
        $this->updated = null;
    }

    /**
     * @param $mysql
     * @param $id
     * @return Post|null
     */
    public static function load($mysql, $id)
    {
        $result = $mysql->query("SELECT image, thumb, title, content,  updated FROM post WHERE id = {$id} LIMIT 1");
        if ($result->num_rows === 1) {
            $result->data_seek(0);
            $result = $result->fetch_assoc();

            $post = new Post($result['image'], $result['thumb'], $result['title'], $result['content']);
            $post->id = $id;
            $post->updated = $result['updated'];
            return $post;
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

        $result = $mysql->query("SELECT id, image, thumb, title, content, updated FROM post " .
            "ORDER BY {$order} LIMIT {$page}, {$pageSize}");
        if ($result->num_rows > 0) {
            $result->data_seek(0);
            while ($pResult = $result->fetch_assoc()) {
                $post = new Post($pResult['image'], $pResult['thumb'], $pResult['title'], $pResult['content']);
                $post->id = $pResult['id'];
                $post->updated = $pResult['updated'];
                array_push($list, $post);
            }
        }

        return $list;
    }

    public static function getTotalAmount($mysql)
    {
        $amount = 0;
        $result = $mysql->query("SELECT count(id) 'amount' FROM post");
        if ($result->num_rows === 1) {
            $result->data_seek(0);
            $amount = intval($result->fetch_assoc()['amount']);
        }
        return $amount;
    }

    /**
     * @return array of types
     */
    public static function getAttributeArray()
    {
        return json_encode(array('image' => array('type' => 'image', 'placeholder' => '', 'required' => 'false'),
            'title' => array('type' => 'string', 'placeholder' => 'Título', 'required' => 'true'),
            'content' => array('type' => 'text', 'placeholder' => '', 'required' => 'true')), JSON_FORCE_OBJECT);
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
                $file = $this->image;
                $this->thumb = App::saveImage($file, 218);
                $this->image = App::saveImage($file, 907);
            } catch (\Exception $ex) {
                $status = $ex->getMessage();
            }
        }

        if ($status === true) {
            if ($this->id > 0) {
                $status = $mysql->query("UPDATE post SET image = '{$this->image}', thumb = '{$this->thumb}', " .
                    "title = '{$this->title}', content = '{$this->content}' WHERE id = {$this->id}");
            } else {
                $status = $mysql->query("INSERT INTO post (image, thumb, title, content) VALUES (" .
                    "'{$this->image}', '{$this->thumb}', '{$this->title}', '{$this->content}')");
                $this->id = $mysql->insert_id;
            }

            if ($status !== true) {
                $status = $mysql->error;
            }
        }

        return $status;
    }

    /**
     * @param $mysql
     * @return bool|string
     */
    public function delete($mysql)
    {
        $status = true;
        $status = $mysql->query("DELETE FROM post WHERE id = {$this->getId()}");
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
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @param string $thumb
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getExcerpt()
    {
        if ($this->content != null) {
            $result = preg_replace("~</h1>|</h2>|</h3>|</h4>|</p>~", "<br/>", $this->getHTMLContent(), -1);
            //$result = str_replace("</p>", "<br/>", $result);
            return strip_tags($result, '<br><strong><b><u><i>');
        }
    }

    /**
     * @return string
     */
    public function getHTMLContent()
    {
        return html_entity_decode($this->content);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getUpdatedDate()
    {
        return ucwords(/*utf8_encode(*/strftime('%A, %e de %B de %Y', strtotime($this->updated)))/*)*/;
    }
}
