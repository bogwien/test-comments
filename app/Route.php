<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 06.12.2017
 * Time: 15:18
 */

namespace app;

use app\helpers\Inflector;

/**
 * Class Route
 * @package app
 */
class Route extends Model
{
    public $routeRules = [];
    public $errorRule;
    public $controllersNamespace = 'app\controllers';

    /**
     * Run controller/action by route in uri
     * @throws HttpException
     */
    public function runAction()
    {
        $shortUri = $this->getShortUri();
        if (!isset($this->routeRules[$shortUri])) {
            throw new HttpException(404, 'Page not found');
        }

        list($controllerName, $actionName) = explode('/', $this->routeRules[$shortUri], 2);
        $controllerName = $this->controllersNamespace . '\\' . Inflector::idToCamelCase($controllerName);
        $actionName = Inflector::idToLowerCamelCase($actionName);

        $controller = new $controllerName();
        $controller->$actionName();
    }

    /**
     * Parse uri and get route
     * @return string
     */
    protected function getShortUri()
    {
        $fullUri = $_SERVER['REQUEST_URI'];
        $shortUri = $fullUri;
        $shortUriPosEnd = mb_strpos($fullUri, '?', 0, 'utf8');
        if ($shortUriPosEnd !== false) {
            $shortUri = mb_substr($fullUri, 1, $shortUriPosEnd, 'utf8');
        }
        $shortUri = trim($shortUri, '/?');

        return $shortUri;
    }

    /**
     * Run error action
     * @param HttpException $e
     */
    public function runErrorAction(HttpException $e)
    {
        list($controllerName, $actionName) = explode('/', $this->errorRule, 2);
        $controllerName = $this->controllersNamespace . '\\' . Inflector::idToCamelCase($controllerName);
        $actionName = Inflector::idToLowerCamelCase($actionName);

        $controller = new $controllerName();
        $controller->$actionName($e);
    }
}
