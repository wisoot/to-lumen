<?php

namespace App\Exceptions;

abstract class Exception extends \Exception
{
    /**
     * @return int
     */
    abstract public function getErrorCode(): int;
}
