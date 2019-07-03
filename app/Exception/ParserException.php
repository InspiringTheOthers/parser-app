<?php

namespace App\Exception;

use Exception;
use Throwable;

final class ParserException extends Exception
{
    /**
     * ParserException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Some error during parsing!", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}