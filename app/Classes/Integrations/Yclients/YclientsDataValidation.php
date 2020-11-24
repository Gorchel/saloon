<?php

namespace App\Classes\Integrations\Yclients;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

/**
 * Class YclientsDataValidation
 * @package App\Classes\Integrtions\Yclients
 */
class YclientsDataValidation
{
    public function validation(Request $request) {
        $validator = \Validator::make($request->all(), [
            'data' => 'required'
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }
}
