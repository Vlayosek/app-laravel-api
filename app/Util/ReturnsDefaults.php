<?php

namespace App\Util;

use Illuminate\Http\Response;
trait ReturnsDefaults
{
    public $messages = [];
    public $alert = 'Algo Salió Mal, Intenta Nuevamente Por Favor...!';
    public $response = false;
    public $user = 0;
    public $data = [];
    public $module='';
    public int $status = Response::HTTP_NOT_FOUND;

    public function __construct()
    {
        $this->returnDefault();
    }


    public function returnIndex()
    {
        $this->returnDefault();
        return $this->default;
    }

    public function returnShow($data = [], $headers = [], $message = false)
    {
        if ($this->response) {
            $this->status = Response::HTTP_OK;
            $this->alert = 'Dato Encontrado Correctamente';
        }
        return [
            'status'    => $this->status,
            'response'  => $this->response,
            'msj'     => $this->alert,
            'messages'  => $this->messages,
            'data'      => $data,
            'headers'   => $headers,
        ];
    }

    public function returnEdit()
    {
        if ($this->response == true) {
            $this->alert = 'Proceso Realizado Correctamente..';
        }
        $this->returnDefault();
        return $this->default;
    }

    public function returnCreate($data = [])
    {
        if ($this->response) {
            $this->alert = 'Creado Correctamente..';
        }
        $this->returnDefault();
        $this->default['data'] = $data;
        return $this->default;
    }

    public function returnUpdate($data = [])
    {
        if ($this->response) {
            $this->alert = 'Actualizado Correctamente..';
        }
        $this->returnDefault();
        $this->default['data'] = $data;
        return $this->default;
    }

    public function returnDestroy()
    {
        if ($this->response) {
            $this->alert = 'Eliminado Correctamente..';
        }
        $this->returnDefault();
        return $this->default;
    }

    private $default = [];
    private function returnDefault()
    {
        $this->default = [
            'status' => $this->status,
            'response'  => $this->response,
            'msj'     => $this->alert,
            'messages'  => $this->messages,
        ];
    }
}
