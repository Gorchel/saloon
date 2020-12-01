<?php

namespace App\Jobs;

use Illuminate\Http\Request;
use App\Classes\Integrations\Yclients\YclientsManager;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use App\Entry;

class YclientsJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, Queueable;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $yclientsManager = new YclientsManager($this->request->all());
        $yclientsManager->handle();
    }
}
