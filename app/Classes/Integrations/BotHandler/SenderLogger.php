<?php

namespace App\Classes\Integrations\BotHandler;

use Illuminate\Support\Facades\Log;
use App\SenderLog;
use Carbon\Carbon;
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
        $model->user_id = $entry->user_id;
        $model->type = $this->type->getTypeName();
        $model->save();
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function checkLog(int $user_id)
    {
        return SenderLog::where('user_id', $user_id)
            ->where('type', $this->type->getTypeName())
            ->whereDate('created_at', Carbon::now('Africa/Nairobi')->format('Y-m-d'))
            ->first();
    }
}
