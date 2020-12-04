<?php

namespace App\Classes\Integrations\BotHandler\Types;

use App\Entry;
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
            $now->hour <= config('type.feedback.finish_sending_hour')
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

    /**
     * @param Entry $entry
     * @return string
     */
    public function getTemplate(Entry $entry): string
    {
        $visitedDate = Carbon::parse($entry->visited_date, 'Africa/Nairobi');

        $text = "@HSM@\nlegend_city_feedback\nСообщение от Legend City🌃\n\n ".(!empty($entry->user) ? $entry->user->name : '').", добрый день!\n\n";
        $text .= "Нам очень важно Ваше мнение о сервисе салона Legend Сity от ".$visitedDate->format('d.m').", будем рады сделать его ещё лучше в следующий раз!✨ \n\n";
        $text .= "Оцените от 1 до 5:\n";
        $text .= "🍃На сколько Вам понравилось посещение салона?\n";
        $text .= "🍃Вам понравилось обслуживание администратора?\n";
        $text .= "🍃Порекомендуете ли Вы наш салон своим друзьям и близким?\n\n";
        $text .= "✨Сделайте приятный *подарок для Ваших друзей*: напишите имя и контакты Ваших друзей и мы от Вашего лица *подарим укладку* в нашем салоне✨\n\n";
        $text .= "Ждём Вас вновь, с уважением Legend City 🌃";

        return $text;
    }
}
