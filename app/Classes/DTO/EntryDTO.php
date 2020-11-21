<?php

namespace App\Classes\DTO;

use App\Entry;
use App\User;

/**
 * Class EntryDTO
 * @package App\Classes\DTO
 */
class EntryDTO
{
    /**
     * @var
     */
    protected $externalId;
    /**
     * @var
     */
    protected $user_id;
    /**
     * @var
     */
    protected $visitedDate;
    /**
     * @var Entry
     */
    protected $model;

    /**
     * EntryDTO constructor.
     * @param Entry|null $entry
     */
    public function __construct(?Entry $entry = null)
    {
        if (!empty($entry)) {
            $this->model = $entry;
        } else {
            $this->model = new Entry;
        }
    }

    /**
     * @return int
     */
    public function getExternalId(): int
    {
        return $this->model->external_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->model->user_id;
    }

    /**
     * @return string
     */
    public function getVisitedDate(): string
    {
        return $this->model->visited_date;
    }

    /**
     * @return string
     */
    public function getModel(): User
    {
        return $this->model;
    }

    /**
     * @param int $external_id
     * @return EntryDTO
     */
    public function setExternalId(int $external_id): EntryDTO
    {
        $this->model->external_id = $external_id;
        return $this;
    }

    /**
     * @param User $user
     * @return EntryDTO
     */
    public function setUserId(User $user): EntryDTO
    {
        $this->model->user_id = $user->id;
        return $this;
    }

    /**
     * @param string $visitedDate
     * @return EntryDTO
     */
    public function setVisitedDate(string $visitedDate): EntryDTO
    {
        $this->model->visited_date = $visitedDate;
        return $this;
    }

    /**
     * @return bool
     */
    public function store(): EntryDTO
    {
        $this->model->save();

        return $this;
    }
}
