<?php

namespace App\Exceptions;

class ItemNotFoundException extends Exception
{
    /**
     * @return int
     */
    public function getErrorCode(): int
    {
        return 101;
    }
}
