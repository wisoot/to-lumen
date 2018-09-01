<?php

namespace App;

use App\Entities\Item;
use App\Exceptions\ItemNotFoundException;
use App\Gateways\ItemManagerGateway;
use Carbon\Carbon;

class ItemManager
{
    /**
     * @var ItemManagerGateway
     */
    private $gateway;

    /**
     * ItemManager constructor.
     *
     * @param ItemManagerGateway $gateway
     */
    public function __construct(ItemManagerGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param string $description
     * @return Item
     */
    public function addItem(string $description): Item
    {
        $item = new Item([
            'description' => $description,
            'created_at' => Carbon::now()
        ]);

        return $this->gateway->create($item);
    }

    /**
     * @param int $id
     * @return Item
     * @throws ItemNotFoundException
     */
    public function finishItem(int $id): Item
    {
        $item = $this->getItem($id);

        if ($item === null) {
            throw new ItemNotFoundException();
        }

        $item->finish();

        return $this->gateway->update($item);
    }

    /**
     * @param int $id
     * @return Item|null
     */
    public function getItem(int $id): ?Item
    {
        return $this->gateway->getById($id);
    }

    /**
     * @return Item[]
     */
    public function getFinishedItems(): array
    {
        return $this->gateway->getAllFinished();
    }

    /**
     * @return Item[]
     */
    public function getUnfinishedItems(): array
    {
        return $this->gateway->getAllUnfinished();
    }
}
