<?php

namespace App\Http\Controllers\Api\Auth\Login\Domains;

use App\Util\SiORM;

abstract class AuthLoginAbstract extends SiORM
{
    public $modulo = 'Auth';
    public $auth = null;
    public $auths = [];
    public $headers = [];
    public $authStatus = false;
    public $model;

    public function __construct($data = ['*'],$module =null)
    {
        if(isset($module)){
            $this->modulo = $module;
        }
        $this->auth = $data;
        $this->model = "App\Models\\" . $this->modulo . '\User';
        $this->sql = $this->model::select(['*']);
    }
}
