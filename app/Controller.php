<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 06.12.2017
 * Time: 15:49
 */

namespace app;

use app\helpers\Inflector;
use ReflectionClass;

/**
 * Class Controller
 * @package app
 */
class Controller extends Model
{
    /**
     * Render view file
     * @param string $view
     * @param array $data
     */
    public function render($view, $data = [])
    {
        $controllerName = Inflector::camelCaseToId((new ReflectionClass($this))->getShortName());
        if (is_array($data)) {
            extract($data);
        }
        require __DIR__ . '/views/' . $controllerName . '/' . $view . '.php';
    }
}
