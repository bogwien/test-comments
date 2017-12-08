<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 07.12.2017
 * Time: 15:09
 */

namespace app\models;

/**
 * Class EventManager
 * @package app\models
 */
class EventManager implements EventManagerInterface
{
    /**
     * @var EventManager
     */
    protected static $_instance;

    protected $_listeners = [];

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    /**
     * @return EventManager
     */
    static public function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function init()
    {
        $listeners = Listeners::getAll();

        foreach ($listeners as $listener) {
            $this->_listeners[$listener['event']][$listener['priority']][] = $listener['callback'];
        }
    }

    /**
     * Attaches a listener to an event
     *
     * @param string $event the event to attach too
     * @param callable $callback a callable function
     * @param int $priority the priority at which the $callback executed
     * @return bool true on success false on failure
     */
    public function attach($event, $callback, $priority = 0)
    {
        if (!is_string($event) || !is_callable($callback, true, $callbackName) || !is_integer($priority)) {
            return false;
        }
        $this->_listeners[$event][$priority][$callbackName] = $callback;

        return true;
    }

    /**
     * Detaches a listener from an event
     *
     * @param string $event the event to attach too
     * @param callable $callback a callable function
     * @return bool true on success false on failure
     */
    public function detach($event, $callback)
    {
        if (empty($this->_listeners[$event]) || !is_callable($callback, true, $callbackName)) {
            return false;
        }

        foreach ($this->_listeners[$event] as $p => $listeners) {
            if (array_key_exists($callbackName, $listeners)) {
                unset($this->_listeners[$event][$p][$callbackName]);
                return true;
            }
        }

        return false;
    }

    /**
     * Clear all listeners for a given event
     *
     * @param  string $event
     * @return void
     */
    public function clearListeners($event)
    {
        if (isset($this->_listeners[$event])) {
            unset($this->_listeners[$event]);
        }
    }

    /**
     * Trigger an event
     *
     * Can accept an EventInterface or will create one if not passed
     *
     * @param  string|EventInterface $event
     * @param  object|string $target
     * @param  array|object $argv
     */
    public function trigger($event, $target = null, $argv = [])
    {
        if (!is_object($event)) {
            $event = new Event($event, $argv, $target);
        }
        $eventName = $event->getName();
        $listeners = $this->getEventListeners($eventName);
        foreach ($listeners as $listener) {
            if ($event->isPropagationStopped()) {
                break;
            }
            call_user_func($listener, $event, $eventName, $this);
        }
    }

    /**
     * @param $eventName
     * @return array
     */
    protected function getEventListeners($eventName)
    {
        if (empty($this->_listeners[$eventName])) {
            return [];
        }

        $sortedListeners = [];
        $priorities = $this->_listeners[$eventName];
        ksort($priorities, SORT_NUMERIC);

        foreach ($priorities as $p => $listeners) {
            foreach ($listeners as $listener) {
                $sortedListeners[] = $listener;
            }
        }

        return $sortedListeners;
    }
}
