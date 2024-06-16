<?php

namespace App\Http\Controllers\Api\Auth\Login\Applications;

use App\Http\Controllers\Api\Auth\Login\Domains\GetBuilder\GetByDirector;
use App\Http\Controllers\Api\Auth\Login\Domains\GetBuilder\GetByEmailPassword;
use App\Models\Auth\User;
use App\Util\Abstracts\AppGeneralAbstract;
use Illuminate\Support\Facades\Hash;

class GetAuthLoginApp extends AppGeneralAbstract
{
    private $dataOutput = [];
    private $endConsult;
    private $token;

    public function execute($dataIn = [], $select = [], $type = '', $module = '')
    {
        $this->endConsult = $dataIn['endConsult'] ?? 1;
        switch ($type) {
            case 'authByEmailPassword':
                $this->getLoginByEmailPassword($dataIn, $select, $module);
                break;
            default: // Para consultas combinadas
                return $this->returnApplication(0, [], false);
        }

        return $this->returnApplication($this->endConsult, $this->dataOutput);
    }

    private function getLoginByEmailPassword($dataIn, $select, $module)
    {
        if (!isset($dataIn['email'])) {
            $this->dataOutput = 'El campo email es necesario';
            $this->endConsult = 0;
            return;
        }

        if (!isset($dataIn['password'])) {
            $this->dataOutput = 'El campo password es necesario';
            $this->endConsult = 0;
            return;
        }

        $user = User::select('id', 'name', 'email', 'created_at', 'password')->where('email', $dataIn['email'])->first();

        if(!empty($user)) {
            if(Hash::check($dataIn['password'], $user->password)) {
                $this->token = $user->createToken('ApiAuth')->accessToken;
                $array = [
                    'token' =>  $this->token,
                    'user' => $user
                ];
                $this->dataOutput = $array;
                $this->endConsult = 1;
            } else {
                $this->dataOutput = 'Password no coincide';
                $this->endConsult = 0;
            }
        } else {
            $this->dataOutput = 'Correo ingresado inválido';
            $this->endConsult = 0;
        }
    }

    private function getLoginByEmailPassword2($dataIn, $select, $module)
    {
        array_pop($dataIn);

        if (!isset($dataIn['email'])) {
            $this->dataOutput = 'El campo email es necesario';
            $this->endConsult = 0;
            return;
        }

        if (!isset($dataIn['password'])) {
            $this->dataOutput = 'El campo password es necesario';
            $this->endConsult = 0;
            return;
        }

        if (auth()->attempt($dataIn)) {
            $token = auth()->user()->createToken('ApiAuth')->accessToken;

            $user = User::select('id', 'name', 'email', 'created_at')->where('email', $dataIn['email'])->first();

            $array = [
                'token' => $token,
                'user' => $user
            ];
            $this->dataOutput = $array;
            $this->endConsult = 1;
        } else {
            $this->dataOutput = 'Credenciales Incorrectas';
            $this->endConsult = 0;
        }
    }

    private function getLoginByEmailPasswordOld($dataIn, $select, $module)
    {
        array_pop($dataIn);
        if (!isset($dataIn['email'])) {
            $this->dataOutput = 'El campo email es necesario';
            $this->endConsult = 0;
            return;
        }

        if (!isset($dataIn['password'])) {
            $this->dataOutput = 'El campo password es necesario';
            $this->endConsult = 0;
            return;
        }

        $this->dataOutput = (new GetByDirector($dataIn, $module))
            ->createByEmailPassword(new GetByEmailPassword(), $select, $this->endConsult);
    }

}
