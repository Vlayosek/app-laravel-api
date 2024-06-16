<?php

namespace App\Http\Controllers\Api\Auth\Register\Applications;

use App\Http\Controllers\Api\Auth\Register\Domains\CreateAuthLoginDom;
use App\Util\Abstracts\AppGeneralAbstract;

class CreateAuthRegisterApp extends AppGeneralAbstract
{
    private $createDom;
    private $dataOutput = [];
    private $status = false;

    public function execute($data, $user, $type = 'byOne')
    {
        $this->createDom = new CreateAuthLoginDom([]);

        switch ($type) {
            case 'byOne':
                $this->createOne($data, $user,$type);
                break;
            default:
                return $this->returnApplication(0, [], false);
        }
        return $this->returnApplication(0, $this->dataOutput, $this->status);
    }

    private function createOne($data, $user, $type = 'byOne')
    {
        $this->createDom->auth = $data;
        $this->createDom->create($user, $type);
        $this->dataOutput = $this->createDom->auth;
        $this->status = $this->createDom->authStatus;
    }
}
