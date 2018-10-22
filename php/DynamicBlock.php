<?php
/**
 * PHP Version 7.2.6
 * Dynamic block class
 *
 * @category Class
 * @package  app
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://centrocastelo.org.br
 */
namespace app;

class DynamicBlock
{
    private $id;
    private $content;
    private $page;

    /**
     * DynamicBlock constructor.
     * @param $content
     */
    public function __construct($content, $page)
    {
        $this->id = null;
        $this->content = $content;
        $this->page = $page;
    }

    /**
     * @param $mysql
     * @param $id
     * @return DynamicBlock|null
     */
    public static function load($mysql, $id)
    {
        $result = $mysql->query("SELECT content, page FROM dynamic_block WHERE id = {$id} LIMIT 1");
        if ($result->num_rows === 1) {
            $result->data_seek(0);
            $result = $result->fetch_assoc();

            $dynamicBlock = new DynamicBlock($result['content'], $result['page']);
            $dynamicBlock->id = $id;
            return $dynamicBlock;
        } else {
            return null;
        }
    }

    /**
     * @return array of types
     */
    public static function getAttributeArray()
    {
        return array('content' => array('type' => 'text', 'placeholder' => '', 'required' => 'true'),
            'page' => array(
                'type' => 'join',
                'options' => json_encode(Page::loadAllToJSON(App::getConnection()), JSON_FORCE_OBJECT),
                'placeholder' => 'Página',
                'required' => 'false'
            )
        );
    }

    /**
     * @param $mysql
     * @return bool|string
     */
    public function save($mysql)
    {
        $status = true;

        $result = $mysql->query("SELECT content FROM dynamic_block WHERE id = {$this->id}");
        if ($result->num_rows === 1) {
            $status = $mysql->query("UPDATE dynamic_block SET
                content = '{$this->content}',
                page = $this->page WHERE id = {$this->id}");

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
        $status = $mysql->query("DELETE FROM dynamic_block WHERE id = {$this->getId()}");
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
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
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
    public function getHTMLContent()
    {
        $aux = preg_replace("/<p[^>]*?>/", "", html_entity_decode($this->content));
        return str_replace("</p>", "<br />", $aux);
    }

    /**
     * @return string
     */
    public function getTextContent()
    {
        $aux = preg_replace("/<p[^>]*?>/", "", html_entity_decode($this->content));
        $aux = str_replace("</p>", " ", $aux);
        return strip_tags($aux);
    }
}
