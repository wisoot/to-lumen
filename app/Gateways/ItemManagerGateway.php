<?php

namespace App\Gateways;

use App\Entities\Item;

interface ItemManagerGateway
{
    /**
     * @param Item $item
     * @return Item
     */
    public function create(Item $item): Item;

    /**
     * @param Item $item
     * @return Item
     */
    public function update(Item $item): Item;

    /**
     * @param int $id
     * @return Item|null
     */
    public function getById(int $id): ?Item;

    /**
     * @return Item[]
     */
    public function getAllFinished(): array;

    /**
     * @return Item[]
     */
    public function getAllUnfinished(): array;
}
