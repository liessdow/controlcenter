<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class VatsimAPIException extends Exception
{
    /**
     * MissingHandoverObjectException constructor.
     * @param string $user
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct( $message, $code, $previous);
    }
}
