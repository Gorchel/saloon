<?php

namespace App\Classes\Integrations\BotHandler\Types;

use App\Entry;
use Carbon\Carbon;

/**
 * Class Visit
 * @package App\Classes\Integrations\BotHandler\Types
 */
class Visit implements TypeInterface
{
    /**
     * @return string
     */
    public function getTypeName(): string
    {
        return 'visit';
    }

    /**
     * @return bool
     */
    public function checkTime(): bool
    {
        $now = Carbon::now('Africa/Nairobi');

        if (
            $now->hour >= config('type.visit.start_sending_hour') &&
            $now->hour >= config('type.visit.finish_sending_hour')
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

        $query->whereRaw('DATE(DATE_SUB(`visited_date`, INTERVAL 1 DAY)) <= "'.$now->format('Y-m-d').'"');
    }

    /**
     * @param Entry $entry
     * @return string
     */
    public function getTemplate(Entry $entry): string
    {
        $visitedDate = Carbon::parse($entry->visited_date, 'Africa/Nairobi');

        $text = "@HSM@\nlegend_city_visit\nСообщение от Legend City🌃\n\n ".(!empty($entry->user) ? $entry->user->name : '').", вы записаны на ".$visitedDate->format('d.m')." в ".$visitedDate->format('H:i')."✨\n\n";
        $text .= "💢Хотим Вас оповестить, что по новым правилам салона в случае не подтверждения записи за 1 день, мы имеем право удалить вашу запись. Надеемся на Ваше понимание🙏🏼\n\n";
        $text .= "Ждём Вас по адресу Ходынский бульвар 4, Метро ЦСКА, ТЦ Авиапарк, 1 этаж зона A (Зеленая зона)✨ Направление на магазин HOFF - мы прям напротив него.";
        $text .= "Если не сможете найти, позвоните: +7 (495) 933-44-74 🎡\n\n ";
        $text .= "С Уважением, Legend City✨`;";

        dd($text);
        return $text;
    }
}
