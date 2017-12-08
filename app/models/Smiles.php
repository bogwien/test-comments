<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 08.12.2017
 * Time: 16:51
 */

namespace app\models;

/**
 * Class Smiles
 * @package app\models
 */
class Smiles
{
    public static $map = [
        ':)' => '/images/happy.png',
        ':-)' => '/images/happy.png',
        ':(' => '/images/sad.png',
        ':-(' => '/images/sad.png',
        ';)' => '/images/wink.png',
        ';-)' => '/images/wink.png',
        ':|' => '/images/neutral.png',
        ':-|' => '/images/neutral.png',
    ];

    /**
     * @return array
     */
    public static function getMap()
    {
        $map = [];

        foreach (self::$map as $k => $item) {
            $map[$k] = "<img src='{$item}'>";
        }

        return $map;
    }
}
