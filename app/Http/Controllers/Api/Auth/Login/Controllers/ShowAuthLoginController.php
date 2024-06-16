<?php

namespace App\Http\Controllers\Api\Auth\Login\Controllers;

use App\Http\Controllers\Api\Auth\Login\Applications\GetAuthLoginApp;
use App\Http\Controllers\ApiResponseController;
use Illuminate\Http\Request;

class ShowAuthLoginController extends ApiResponseController
{
    public function init($var, Request $request)
    {
        $data = [];
        $type = $var;
        $headers = [];
        switch ($type) {
            case 'authByEmailPassword':
                $rules = [
                    'email' => 'required|email',
                    'password' => 'required',
                ];
                $messages = [
                    'email.required' => 'El email es requerido.',
                    'email.email' => 'El email no es valido.',
                    'password.required' => 'El password es requerido.',
                ];
                $data = [
                    'email' => $request->email,
                    'password' => $request->password,
                    'endConsult' => 1
                ];
                $this->module = 'Auth';

                $select = ['*'];
                break;
            default:
                $this->alert = 'No Existe metodo definido...';
                return $this->returnShow($data,$headers);
        }

        $resultValidate = $this->validateBack($request->all(), $rules, $messages);
        if (!$resultValidate['response']) {
            $this->messages = $resultValidate['messages'];
        } else {
            $get = new GetAuthLoginApp();
            $data = $get->execute($data, $select, $type, $this->module);
            $this->response = $data['status'];
            $data = $data['data'];
        }

        return $this->returnShow($data,$headers);
    }

}
