<?php

namespace App\Http\Transformers\Item;

use App\Entities\Item;
use App\Http\Transformers\Transformer;

class ItemTransformer extends Transformer
{
    /**
     * @var Item
     */
    private $item;

    /**
     * UserTransformer constructor
     *
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * transform method
     *
     * @return array
     */
    public function transform(): array
    {
        $data = [
            'id' => $this->item->id,
            'description' => $this->item->description,
            'is_finished' => $this->item->isFinished,
            'created_at' => $this->item->createdAt->toRfc3339String(),
            'finished_at' => $this->item->finishedAt !== null
                ? $this->item->finishedAt->toRfc3339String()
                : null,
        ];

        return $data;
    }
}
