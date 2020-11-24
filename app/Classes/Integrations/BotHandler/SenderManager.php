<?php

namespace App\Classes\Integrations\BotHandler;

use Illuminate\Support\Facades\Log;

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
     */
    public function handle()
    {
        $entriesGetter = new EntriesGetter($this->type);
        $collection = $entriesGetter->collection();

        if (empty($collection)) {
            return false;
        }

        $senderLogger = new SenderLogger($this->type);

        foreach ($collection as $entry) {
            //Отправляем

            //Сохраняем в лог
            $senderLogger->send($entry);
        }
    }
}
