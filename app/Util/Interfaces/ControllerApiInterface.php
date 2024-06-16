<?php

namespace App\Util\Interfaces;

use Illuminate\Http\Request;

interface ControllerApiInterface
{
    public function index();
    public function show($var, Request $request);
    public function store(Request $request);
    public function update(Request $request,$id);
    public function destroy($id);
}
