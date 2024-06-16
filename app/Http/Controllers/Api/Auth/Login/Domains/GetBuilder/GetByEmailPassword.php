<?php

namespace App\Http\Controllers\Api\Auth\Login\Domains\GetBuilder;

class GetByEmailPassword
{
    public function getByEmailAndPassword($sql, $dataInput)
    {
        isset($dataInput['email']) ?
            (new GetByEmailConcret())->getByEmail($sql, $dataInput) : null;

        isset($dataInput['password']) ?
            (new GetByPasswordConcret())->getByPassword($sql, $dataInput) : null;



        return $sql;
    }

    public function getData($select, $sql, $dataInput)
    {
        $sql->select($select);
        return $this->getByEmailAndPassword($sql, $dataInput);
    }
}
