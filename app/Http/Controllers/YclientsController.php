<?php

namespace App\Http\Controllers;

use App\Jobs\YclientsJob;
use Illuminate\Http\Request;
use App\Classes\Integrations\Yclients\YclientsManager;
use App\Classes\Integrations\Yclients\YclientsDataValidation;

class YclientsController extends Controller
{
    public function webhook(Request $request)
    {
        \Log::info(json_encode($request->all()));
        $validation = new YclientsDataValidation;
        if (!$validation->validation($request)) {
            return;
        }

        $job = (new YclientsJob($request->all()));
        dispatch($job);
    }
}
