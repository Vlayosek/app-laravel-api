<?php

namespace App\Http\Controllers\Api\Auth\Register\Domains;

class CreateAuthLoginDom extends AuthRegisterAbstract
{
    public function create($user, $type = 'byOne')
    {
        if ($type == 'byOne') {
            $this->createOne($user);
        }
    }

    public function createOne($user)
    {
        $auth = new $this->model;
        $mapColumns=$auth->maps;

        array_shift($mapColumns); // QUITA ID DE ARRAY MAP
        foreach ($mapColumns as $key => $value) {
            $auth->$key = $this->auth[$value] ?? null;
        }

        $auth->created_at = date('Y-m-d H:i:s');
        $auth->password = bcrypt($this->auth['password']);

        if ($auth->save()) {
            $this->authStatus = true;
            $this->auth = $auth;
        } else {
            $this->authStatus = false;
            $this->auth= 'Existe un Error al Guardar el registro';
        }
    }
}
