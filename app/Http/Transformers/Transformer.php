<?php

namespace App\Http\Transformers;

abstract class Transformer
{
    /**
     * transform method
     *
     * @return array
     */
    abstract public function transform(): array;
}
