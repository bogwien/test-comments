<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 07.12.2017
 * Time: 15:17
 */

namespace app\models;

/**
 * Class OnSubmitEvent
 * @package app\models
 */
class Event implements EventInterface
{
    protected $_name;
    protected $_target;
    protected $_params = [];
    protected $_propagationStopped = false;

    public function __construct($name = null, array $params = [], $target = null, $stopPropagation = false)
    {
        $this->_name = $name;
        $this->_target = $target;
        $this->_params = $params;
        $this->_propagationStopped = (bool)$stopPropagation;
    }

    /**
     * Get event name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Get target/context from which event was triggered
     *
     * @return null|string|object
     */
    public function getTarget()
    {
        return $this->_target;
    }

    /**
     * Get parameters passed to the event
     *
     * @return array
     */
    public function getParams()
    {
        return $this->_params;
    }

    /**
     * Get a single parameter by name
     *
     * @param string $name
     * @return mixed
     */
    public function getParam($name)
    {
        return isset($this->_params[$name]) ? $this->_params[$name] : null;
    }

    /**
     * Set the event name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * Set the event target
     *
     * @param  null|string|object $target
     * @return void
     */
    public function setTarget($target)
    {
        $this->_target = $target;
    }

    /**
     * Set event parameters
     *
     * @param array $params
     * @return void
     */
    public function setParams(array $params)
    {
        $this->_params = $params;
    }

    /**
     * Indicate whether or not to stop propagating this event
     *
     * @param bool $flag
     */
    public function stopPropagation($flag)
    {
        $this->_propagationStopped = (bool)$flag;
    }

    /**
     * Has this event indicated event propagation should stop?
     *
     * @return bool
     */
    public function isPropagationStopped()
    {
        return $this->_propagationStopped;
    }
}
