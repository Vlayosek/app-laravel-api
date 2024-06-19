<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\ApiResponseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ApiController extends ApiResponseController
{
    public function register2(Request $request)
    {
        $rules = [
            'name' => 'required|max:255|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
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
            'password.confirmed' => 'El password no coincide',
        ];

        $resultValidate = $this->validateBack($request->all(), $rules, $messages);

        if (!$resultValidate['response']) {
            return $this->errorResponse([],400, $resultValidate['messages']);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            return $this->successResponse($user,200, 'Registro exitoso');
        }
    }

    public function register(Request $request)
    {
        $user = [];
        $rules = [
            'name' => 'required|max:255|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
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
            'password.confirmed' => 'El password no coincide',
        ];

        $resultValidate = $this->validateBack($request->all(), $rules, $messages);

        if (!$resultValidate['response']) {
            $this->messages = $resultValidate['messages'];
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $this->response = true;
            $this->data = $user;
            $this->alert = "User created successfully";
        }
        return $this->returnCreate($user);
    }

    public function login(Request $request)
    {
        $data = [];
        //validation
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $messages = [
            'email.required' => 'El email es requerido.',
            'email.email' => 'El email no es valido.',
            'password.required' => 'El password es requerido.',
        ];
        $dataIn = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $resultValidate = $this->validateBack($request->all(), $rules, $messages);

        if (!$resultValidate['response']) {
            $this->alert = $resultValidate['messages'];
        } else {
            if (Auth::attempt($dataIn)) {
                $token = auth()->user()->createToken('ApiAuth')->accessToken;
                $user = auth()->user();
                $data['token'] = $token;
                $data['user'] = $user;
                $this->status = Response::HTTP_OK;
                $this->data = $data;
                $this->alert = "Login successfully";
            } else {

                $this->alert = "User not found";
                $this->status = Response::HTTP_NOT_FOUND;
            }
        }
        return $this->successResponse($data,$this->status, $this->alert);
    }

    public function profile()
    {
        $userData = auth()->user();

        if (!$userData) {
            $this->alert = "User not found";
            $this->status = Response::HTTP_NOT_FOUND;
            return $this->returnShow($userData);
        }

        $this->response = true;
        $this->data = $userData;;
        return $this->returnShow($userData);
    }

    public function logout()
    {
        $token = auth()->user()->token();
        $token->revoke();
        $this->response = true;
        return $this->returnRevokeToken();
    }

}
