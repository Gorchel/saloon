<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Integrations\Yclients\YclientsManager;
use App\Classes\Integrations\Yclients\YclientsDataValidation;

class YclientsController extends Controller
{
    public function webhook(Request $request)
    {
        $validation = new YclientsDataValidation;
        if (!$validation->validation($request)) {
            return;
        }

        $yclientsManager = new YclientsManager($request->all());
        $yclientsManager->handle();
    }
}
