<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 06.12.2017
 * Time: 16:08
 */

namespace app;

/**
 * Class HttpException
 * @package app
 */
class HttpException extends \Exception
{
    public $statusCode;

    public function __construct($status, $message = null, $code = 0, \Exception $previous = null)
    {
        $this->statusCode = $status;
        parent::__construct($message, $code, $previous);
    }
}
