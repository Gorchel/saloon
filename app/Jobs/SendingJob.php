<?php

namespace App\Jobs;

use App\Classes\Integrations\BotHandler\SenderLogger;
use App\Classes\Integrations\Sender\Clients\ClientInterface;
use App\Classes\Integrations\BotHandler\Types\TypeInterface;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use App\Entry;
use App\SenderLog;

class SendingJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, Queueable;

    protected $client;
    protected $templateType;
    protected $entry;
    protected $senderLog;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ClientInterface $client, TypeInterface $type, Entry $entry)
    {
        $this->client = $client;
        $this->templateType = $type;
        $this->entry = $entry;
        $this->senderLog = new SenderLogger($type);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (empty($this->entry->user))
        {
            \Log::error('SendingJob not fount user by entry #'.$this->entry->id);
        }

        //проверка отправленного сообщения
        if (!empty($this->senderLog->checkLog($this->entry->user->id))) {
            \Log::error('SendingJob sms by user is already sending #'.$this->entry->id);
            $this->senderLog->send($this->entry);

            return;
        }

        $template = $this->templateType->getTemplate($this->entry);



        $option = [
            'phone' => $this->entry->user->phone,
        ];

        $response = $this->client->send($template, $option);

        if (!empty($response)) {
            $this->senderLog->send($this->entry);
            \Log::info("Шаблон отправлен: ");
            \Log::info("==================");
            \Log::info($template);
        }
    }
}
