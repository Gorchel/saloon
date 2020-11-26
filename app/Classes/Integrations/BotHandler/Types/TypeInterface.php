<?php

namespace App\Classes\Integrations\BotHandler\Types;

use App\Entry;

/**
 * Interface TypeInterface
 * @package App\Classes\Integrations\BotHandler\Types
 */
interface TypeInterface
{
    /**
     * @return mixed
     */
    public function getTypeName(): string;
    public function checkTime(): bool;
    public function query(&$query);
    public function getTemplate(Entry $entry);
}
