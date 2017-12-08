<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 08.12.2017
 * Time: 00:02
 */

namespace app\models;

use app\Model;

/**
 * Class Comments
 * @package app\models
 */
class Comments extends Model
{
    public $name;
    public $text;

    /**
     * @return array|bool|null
     */
    public static function getAll()
    {
        global $app;
        $all = $app->db->queryAll('SELECT * FROM comments ORDER BY id ASC');

        return is_array($all) ? $all : [];
    }

    /**
     * @return bool
     */
    public function validate()
    {
        if (empty($this->name) || !is_string($this->name) || mb_strlen($this->name) > 255) {
            return false;
        }
        if (empty($this->text) || !is_string($this->text)) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function save()
    {
        global $app;
        $sql = 'INSERT INTO comments (name, text, created_at, updated_at) VALUES(?, ?, ?, ?)';

        $prepareResult = $app->db->prepare($sql);
        if (!$prepareResult) {
            return false;
        }
        $now = time();
        if (!$prepareResult->bind_param('ssii', $this->name, $this->text, $now, $now)) {
            return false;
        }
        $result = (bool)$prepareResult->execute();

        return $result;
    }
}
