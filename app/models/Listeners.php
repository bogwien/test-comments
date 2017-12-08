<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 08.12.2017
 * Time: 13:32
 */

namespace app\models;

use app\Model;

/**
 * Class Listeners
 * @package app\models
 */
class Listeners extends Model
{
    /**
     * @return array|bool|null
     */
    public static function getAll()
    {
        global $app;
        $all = $app->db->queryAll('SELECT * FROM listeners ORDER BY event ASC, priority DESC, id ASC');

        return is_array($all) ? $all : [];
    }
}
