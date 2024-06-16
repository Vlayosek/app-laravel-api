<?php

namespace App\Http\Controllers\Api\Auth\Login\Domains\GetBuilder;

class GetByEmailConcret
{
    public function getByEmail($sql, $dataInput)
    {
        $sql->where('email', $dataInput);

        return $sql;
    }

    public function getData($select, $sql, $id)
    {
        $sql->select($select);
        return $this->getByEmail($sql, $id);
    }
}
