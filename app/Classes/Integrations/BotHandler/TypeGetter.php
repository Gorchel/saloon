<?php

namespace App\Classes\Integrations\BotHandler;

use App\Classes\Integrations\BotHandler\Types\Visit;
use App\Classes\Integrations\BotHandler\Types\Feedback;

/**
 * Class EntriesGetter
 * @package App\Classes\Integrtions\BotHandler
 */
class TypeGetter
{
    /**
     * @param string $type
     * @return Feedback|Visit
     * @throws \Exception
     */
    public function getType(string $type)
    {
        switch ($type) {
            case 'visit':
                return new Visit;
            case 'feedback':
                return new Feedback();
                break;
            default:
                throw new \Exception("EntriesGetter: " . $type . ' is not found');
        }
    }
}
