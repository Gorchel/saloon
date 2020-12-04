<?php

namespace App\Classes\Integrations\BotHandler;

use Illuminate\Support\Facades\Log;
use App\Classes\Integrations\Sender\Sender;

/**
 * Class SenderManager
 * @package App\Classes\Integrtions\BotHandler
 */
class SenderManager
{
    /**
     * @var Types\Feedback|Types\Visit
     */
    protected $type;

    /**
     * SenderManager constructor.
     * @param string $type
     */
    public function __construct(string $type)
    {
        $typeGetter = new TypeGetter;
        try {
            $this->type = $typeGetter->getType($type);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function handle($count)
    {
        $entriesGetter = new EntriesGetter($this->type);
        $collection = $entriesGetter->collection($count);

        if (empty($collection)) {
            return false;
        }

        $sender = new Sender($this->type);

        foreach ($collection as $entry) {
            //Отправляем
            $sender->send($entry);
        }
    }
}
