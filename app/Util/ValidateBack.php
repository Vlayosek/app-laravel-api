<?php

namespace App\Util;

use Illuminate\Support\Facades\Validator;
trait ValidateBack
{
    public function validateBack($request, $rules, $messages = [])
    {
        $response = true;
        $validator = Validator::make($request, $rules, $messages);
        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            $response = false;
        }
        return [
            'response' => $response,
            'messages' => $messages,
        ];
    }


    public function validateBackNew($request, $rules, $messages = [])
    {
        $response = true;
        $validator = Validator::make($request, $rules, $messages);
        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            $response = false;
        }
        return [
            'response' => $response,
            'messages' => $messages,
        ];
    }
}
