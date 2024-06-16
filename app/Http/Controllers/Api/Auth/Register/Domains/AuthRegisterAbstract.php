<?php

namespace App\Http\Controllers\Api\Auth\Register\Domains;

use App\Util\SiORM;

abstract class AuthRegisterAbstract extends SiORM
{
    public $modulo = 'Auth';
    public $auth = null;
    public $auths = [];
    public $headers = [];
    public $authStatus = false;
    public $model;

    public function __construct($data = ['*'])
    {
        $this->auth = $data;
        $this->model = "App\Models\\" . $this->modulo . '\User';
        $this->sql = $this->model::select(['*']);
    }
}
