<?php

namespace App\Classes\Integrations\BotHandler;

use App\Classes\Integrations\BotHandler\Types\TypeInterface;
use Illuminate\Support\Facades\Log;
use App\Classes\Integrations\BotHandler\Types\Visit;
use App\Classes\Integrations\BotHandler\Types\Feedback;
use App\Entry;

/**
 * Class EntriesGetter
 * @package App\Classes\Integrtions\BotHandler
 */
class EntriesGetter
{

    /**
     * @var TypeInterface
     */
    protected $type;

    /**
     * EntriesGetter constructor.
     * @param TypeInterface $type
     */
    public function __construct(TypeInterface $type)
    {
        $this->type = $type;
    }

    /**
     * @return bool|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function collection($count)
    {
        if (!$this->type->checkTime()) {
            return false;
        }

        $query = Entry::query();

        $this->type->query($query);

        //проверка наличия отправленой записи
        $query->whereDoesntHave('sender_log', function($query) {
            $query->where('type','=', $this->type->getTypeName());
        });

        if (!empty($count)) {
            $query->limit($count);
        }

        return $query->get();
    }
}
