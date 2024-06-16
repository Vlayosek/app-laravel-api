<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\ApiResponseController;
use Illuminate\Http\Request;

class ApiController extends ApiResponseController
{

    public function login(Request $request)
    {
        //VALIDACION
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $messages = [
            'email.required' => 'El correo es requerido',
            'email.email' => 'El correo no es valido',
            'password.required' => 'El password es requerido',
        ];
        $resultValidate = $this->validateBack($request->all(), $rules, $messages);
        if (!$resultValidate['response']) {
            $this->messages = $resultValidate['messages'];
        } else {
            $createApp = new CreateAuthRegisterApp();
            $data = $createApp->execute($request->all(), $this->user, $type);

            $this->response = $data['status'];

            if(!$this->response){
                $this->alert = $data['data'];
                $data = [];
            } else {
                $data = $data['data'];
            }
        }
        return $this->returnCreate($data);

    }
    public function profile(Request $request)
    {
        //
    }

    public function logout(Request $request)
    {
        //
    }

}
