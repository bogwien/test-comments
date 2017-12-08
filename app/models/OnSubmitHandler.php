<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 08.12.2017
 * Time: 14:36
 */

namespace app\models;

use app\Model;

/**
 * Class OnSubmitHandler
 * @package app\models
 */
class OnSubmitHandler extends Model
{
    /**
     * @param EventInterface $event
     * @param string $eventName
     * @param EventManagerInterface $eventManager
     */
    public static function handleEvent(EventInterface $event, $eventName, EventManagerInterface $eventManager)
    {
        /** @var Comments $model */
        $model = $event->getParam('model');
        $model->text = self::replaceSmiles($model->text);
        $model->save();
    }

    /**
     * @param string $string
     * @return string
     */
    protected static function replaceSmiles($string)
    {
        $map = Smiles::getMap();

        return strtr($string, $map);
    }
}
