<?php

namespace App\Http\Controllers\Api\Auth\Login\Domains\GetBuilder;

use App\Http\Controllers\Api\Auth\Login\Domains\AuthLoginAbstract;

class GetByDirector extends AuthLoginAbstract
{
    public function createByEmailPassword(GetByEmailPassword $get, $select = ['*'], $endConsult = 1)
    {
        $this->sql = $get->getData($select, $this->sql, $this->auth);
        return $this->endConsult($endConsult);
    }
}
