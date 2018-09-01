<?php

namespace App\Services\Gateways\MySql;

use App\Entities\Item;

class ItemManagerGateway implements \App\Gateways\ItemManagerGateway
{
    /**
     * @param Item $item
     * @return Item
     */
    public function create(Item $item): Item
    {
        $item->id = app('db')->table(Table::ITEMS)->insertGetId([
            'description' => $item->description,
            'created_at' => $item->createdAt->toDateTimeString()
        ]);

        return $item;
    }

    /**
     * @param Item $item
     * @return Item
     */
    public function update(Item $item): Item
    {
        app('db')->table(Table::ITEMS)->where('id', $item->id)->update([
            'description' => $item->description,
            'is_finished' => $item->isFinished,
            'finished_at' => $item->finishedAt->toDateTimeString()
        ]);

        return $item;
    }

    /**
     * @param int $id
     * @return Item|null
     */
    public function getById(int $id): ?Item
    {
        $row = app('db')->table(Table::ITEMS)
            ->where('id', $id)->first();

        if ($row === null) {
            return null;
        }

        return new Item($row);
    }

    /**
     * @return Item[]
     */
    public function getAllFinished(): array
    {
        return $this->getAll(true);
    }

    /**
     * @return Item[]
     */
    public function getAllUnfinished(): array
    {
        return $this->getAll(false);
    }

    /**
     * @param bool $isFinished
     * @return Item[]
     */
    private function getAll(bool $isFinished): array
    {
        $items = [];
        $rows = app('db')->table(Table::ITEMS)
            ->where('is_finished', $isFinished)
            ->get()->all();

        foreach ($rows as $row) {
            $items[] = new Item($row);
        }

        return $items;
    }
}
