<?php

namespace App\Http\Controllers\Api\Auth\Login\Domains\GetBuilder;

class GetByPasswordConcret
{
    public function getByPassword($sql, $dataInput)
    {
        $sql->where('password', $dataInput);

        return $sql;
    }

    public function getData($select, $sql, $id)
    {
        $sql->select($select);
        return $this->getByPassword($sql, $id);
    }
}
