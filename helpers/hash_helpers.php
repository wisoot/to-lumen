<?php

/**
 * bcrypt function
 *
 * @param string $password
 * @return string
 */
function bcrypt(string $password): string
{
    return app('hash')->make($password);
}