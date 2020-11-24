<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Classes\Integrations\BotHandler\SenderManager;

/**
 * Class FeedbackNotification
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class FeedbackNotification extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "feedback:notification";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Напоминание после визита";


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $senderManager = new SenderManager('feedback');
        $senderManager->handle();
    }
}
