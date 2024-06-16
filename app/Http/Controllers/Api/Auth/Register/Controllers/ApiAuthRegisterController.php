<?php

namespace App\Http\Controllers\Api\Auth\Register\Controllers;

use App\Http\Controllers\Controller;
use App\Util\Interfaces\ControllerApiInterface;
use Illuminate\Http\Request;

class ApiAuthRegisterController extends Controller implements ControllerApiInterface
{

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function show($var, Request $request)
    {
        // TODO: Implement show() method.
    }

    public function store(Request $request)
    {
        $controllerStore = new StoreAuthRegisterController();
        return $controllerStore->init($request);
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
