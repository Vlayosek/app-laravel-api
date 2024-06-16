<?php

namespace App\Http\Controllers\Api\Auth\Register\Controllers;

use App\Http\Controllers\Api\Auth\Register\Applications\CreateAuthRegisterApp;
use App\Http\Controllers\ApiResponseController;

class StoreAuthRegisterController extends ApiResponseController
{
    public function init($request)
    {
        $rules = [];
        $messages = [];
        $type = $request->get('type') !== null ? $request->get('type') : 'basic';
        $data = [];
        switch ($type) {
            case 'basic':
                $rules = [
                    'name' => 'required|max:255|min:5',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6',
                ];
                $messages = [
                    'name.required' => 'El nombre es requerido',
                    'name.min' => 'El nombre debe tener al menos 5 caracteres',
                    'name.max' => 'El nombre debe tener maximo 255 caracteres',
                    'email.required' => 'El correo es requerido',
                    'email.email' => 'El correo no es valido',
                    'email.unique' => 'El correo ya existe',
                    'password.required' => 'El password es requerido',
                    'password.min' => 'El password debe tener al menos 6 caracteres',
                ];
                $type = 'byOne';
                break;
        }
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
}
