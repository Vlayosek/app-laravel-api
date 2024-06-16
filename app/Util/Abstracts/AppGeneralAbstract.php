<?php

namespace App\Util\Abstracts;

class AppGeneralAbstract
{
    public function returnApplication($endConsult, $dataOutput, $statusApplication = false)
    {
        if ($endConsult == 1 && $dataOutput) {
            $statusApplication = true;
        }else{
            if ($endConsult == 2 && count($dataOutput) > 0) {
                $statusApplication = true;
            } else{
                if ($endConsult == 3 && count($dataOutput) > 0) {
                    $statusApplication = true;
                } else {
                    if ($endConsult == 4 && count($dataOutput) > 0) {
                        $statusApplication = true;
                    }
                }
            }
        }
        return [
            'status' => $statusApplication,
            'data' => $dataOutput,
        ];
    }
}
