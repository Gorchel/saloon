<?php

namespace App\Classes\Integrations\BotHandler;

use Illuminate\Support\Facades\Log;
use App\SenderLog;
use App\Entry;
use App\Classes\Integrations\BotHandler\Types\TypeInterface;

/**
 * Class SenderLogger
 * @package App\Classes\Integrtions\BotHandler
 */
class SenderLogger
{
    /**
     * @var TypeInterface
     */
    protected $type;

    /**
     * SenderLogger constructor.
     * @param TypeInterface $type
     */
    public function __construct(TypeInterface $type)
    {
       $this->type = $type;
    }

    /**
     * @param Entry $entry
     */
    public function send(Entry $entry)
    {
        $model = new SenderLog;
        $model->entry_id = $entry->id;
        $model->type = $this->type->getTypeName();
        $model->save();
    }
}
