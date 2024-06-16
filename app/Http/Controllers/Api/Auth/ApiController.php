<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\ApiResponseController;
use Illuminate\Http\Request;

class ApiController extends ApiResponseController
{
    public function profile()
    {
        $userData = auth()->user();

        if(!$userData){
            $this->alert = "User not found";
            $this->status = 404;
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
        $this->alert = "Logout successfully";
        return $this->returnShow();
    }

}
