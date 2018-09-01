<?php

namespace App\Entities;

use Carbon\Carbon;

class Item extends Entity
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $description;

    /**
     * @var bool
     */
    public $isFinished = false;

    /**
     * @var Carbon
     */
    public $createdAt;

    /**
     * @var Carbon|null
     */
    public $finishedAt;

    /**
     * @param array $data
     */
    public function setData(array $data = []): void
    {
        if (isset($data['created_at']) && !$data['created_at'] instanceof Carbon) {
            $data['created_at'] = new Carbon($data['created_at']);
        }

        if (isset($data['finished_at']) && !$data['finished_at'] instanceof Carbon) {
            $data['finished_at'] = new Carbon($data['finished_at']);
        }

        if (isset($data['is_finished']) && !is_bool($data['is_finished'])) {
            $data['is_finished'] = (bool) $data['is_finished'];
        }

        parent::setData($data);
    }

    /**
     * Mark the item as finished
     */
    public function finish(): void
    {
        if ($this->isFinished) {
            return;
        }

        $this->isFinished = true;
        $this->finishedAt = Carbon::now();
    }
}
