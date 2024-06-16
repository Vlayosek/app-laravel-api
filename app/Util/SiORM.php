<?php

namespace App\Util;

abstract class SiORM
{
    public $sql;
    public $location;

    public function getByPaginate($limit = 0)
    {
        if ($limit == 0) {
            return $this->sql->paginate(config('app.pagination', 20));
        }
        return $this->sql->paginate($limit);
    }

    public function endConsult($type = 1, $limit = 0, $get = null)
    {
        if ($limit > 0)
            $this->sql->limit($limit);
        if ($type == 1)
            return $this->sql->first();
        else {
            if ($type == 3) {
                return $this->getByPaginate($limit);
            } else if ($type == 4)
                return $this->getByPaginate($limit);
            else
                return $this->sql->get($get);
        }
    }

    public function initConsult($select = ['*'])
    {
        $columnNamesArray = $this->sql->getModel()->maps;
        $newSelect = null;
        if (isset($columnNamesArray) && !empty($columnNamesArray) && $select[0] !== "*") {
            if (is_array($select)) {
                $newSelect = array_map(function ($item) use ($columnNamesArray) {
                    return array_search($item, $columnNamesArray);
                }, $select);
            } else {
                $newSelect = array_search($select, $columnNamesArray);
            }
        }
        $this->sql = $this->model::select($select);
    }
}
