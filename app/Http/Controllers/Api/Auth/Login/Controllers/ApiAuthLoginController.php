<?php

namespace App\Http\Controllers\Api\Auth\Login\Controllers;

use App\Http\Controllers\Controller;
use App\Util\Interfaces\ControllerApiInterface;
use Illuminate\Http\Request;

class ApiAuthLoginController extends Controller implements ControllerApiInterface
{

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function show($var, Request $request)
    {
        $controllerShow = new ShowAuthLoginController();
        return $controllerShow->init($var, $request);
    }

    public function store(Request $request)
    {
        // TODO: Implement store() method.
    }

    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
