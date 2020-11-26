<?php

namespace App\Classes\Integrations\Sender;

use App\Classes\Integrations\BotHandler\Types\TypeInterface;
use App\Classes\Integrations\Sender\Clients\Chat2Desc;
use App\Classes\Integrations\Sender\Clients\Watsapp;
use App\Jobs\SendingJob;
use App\Entry;

/**
 * Class Sender
 * @package App\Classes\Integrtions\Sender
 */
class Sender
{
    /**
     * @var Watsapp
     */
    protected $client;
    /**
     * @var TypeInterface
     */
    protected $type;

    /**
     * Sender constructor.
     * @param TypeInterface $type
     * @throws \Exception
     */
    public function __construct(TypeInterface $type)
    {
        switch (config('clients.default'))
        {
            case 'chat2desc':
                $this->client = new Chat2Desc();
                break;
            case 'watsapp':
                $this->client = new Watsapp();
                break;
            default:
                throw new \Exception("Sender: " . config('clients.default') . ' is not found');
        }

        $this->type = $type;
    }

    /**
     * @param Entry $entry
     */
    public function send(Entry $entry)
    {
        $job = (new SendingJob($this->client,$this->type,$entry));
        dispatch($job);
    }
}
