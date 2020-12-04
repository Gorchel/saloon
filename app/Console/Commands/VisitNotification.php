<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Classes\Integrations\BotHandler\SenderManager;

/**
 * Class VisitNotification
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class VisitNotification extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "visit:notification {count?}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Напоминание о визите";


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $senderManager = new SenderManager('visit');
        $senderManager->handle($this->argument('count'));
    }
}
