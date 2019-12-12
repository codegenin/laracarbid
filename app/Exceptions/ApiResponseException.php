<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ApiResponseException extends Exception
{
    /**
     * The recommended response to send to the client.
     *
     * @var \Symfony\Component\HttpFoundation\Response|null
     */
    public $response;

    /**
     * Create a new exception instance.
     *
     * @param string                                      $message
     * @param  \Symfony\Component\HttpFoundation\Response $response 
     */
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
