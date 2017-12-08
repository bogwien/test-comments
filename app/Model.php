<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 06.12.2017
 * Time: 15:26
 */

namespace app;

class Model
{
    /**
     * Configure object by config
     * @param array $properties
     */
    public function configure($properties)
    {
        foreach ($properties as $name => $value) {
            if (is_array($value) && isset($value['class'])) {
                $class = $value['class'];
                unset($value['class']);
                $this->$name = new $class($value);
            } else {
                $this->$name = $value;
            }
        }
    }

    /**
     * Model constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->configure($config);
    }
}
