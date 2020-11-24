<?php

namespace App\Classes\Integrations\BotHandler\Types;

use Carbon\Carbon;
/**
 * Class Feedback
 * @package App\Classes\Integrations\BotHandler\Types
 */
class Feedback implements TypeInterface
{
    /**
     * @return string
     */
    public function getTypeName(): string
    {
        return 'feedback';
    }

    /**
     * @return bool
     */
    public function checkTime(): bool
    {
        $now = Carbon::now('Africa/Nairobi');

        if (
            $now->hour >= config('type.feedback.start_sending_hour') &&
            $now->hour >= config('type.feedback.finish_sending_hour')
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param $query
     */
    public function query(&$query)
    {
        $now = Carbon::now('Africa/Nairobi');

        $query->whereRaw('DATE(DATE_ADD(`visited_date`, INTERVAL 1 DAY)) <= "'.$now->format('Y-m-d').'"');
    }
}
