<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 06.12.2017
 * Time: 14:42
 */

namespace app;

use app\models\EventManager;
use app\models\EventManagerInterface;

/**
 * Class Application
 * @package app
 */
class Application extends Model
{
    /**
     * @var Route
     */
    public $route;

    /**
     * @var EventManagerInterface
     */
    public $eventManager;

    /**
     * @var DB
     */
    public $db;

    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->eventManager = EventManager::getInstance();
    }

    public function run()
    {
        try {
            $this->eventManager->init();
            $this->route->runAction();
        } catch (HttpException $e) {
            $this->route->runErrorAction($e);
        }
    }
}
