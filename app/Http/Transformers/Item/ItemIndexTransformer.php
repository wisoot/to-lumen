<?php

namespace App\Http\Transformers\Item;

use App\Entities\Item;
use App\Http\Transformers\Transformer;

class ItemIndexTransformer extends Transformer
{
    /**
     * @var Item[]
     */
    private $items;

    /**
     * UserTransformer constructor
     *
     * @param Item[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * transform method
     *
     * @return array
     */
    public function transform(): array
    {
        $data = [];

        foreach ($this->items as $item) {
            $data[] = (new ItemTransformer($item))->transform();
        }

        return $data;
    }
}
