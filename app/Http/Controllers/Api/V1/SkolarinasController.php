<?php

namespace App\Http\Controllers\Api\V1;

use App\Skolarina;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSkolarinasRequest;
use App\Http\Requests\Admin\UpdateSkolarinasRequest;

class SkolarinasController extends Controller
{
    public function index()
    {
        return Skolarina::all();
    }

    public function show($id)
    {
        return Skolarina::findOrFail($id);
    }

    public function update(UpdateSkolarinasRequest $request, $id)
    {
        $skolarina = Skolarina::findOrFail($id);
        $skolarina->update($request->all());
        

        return $skolarina;
    }

    public function store(StoreSkolarinasRequest $request)
    {
        $skolarina = Skolarina::create($request->all());
        

        return $skolarina;
    }

    public function destroy($id)
    {
        $skolarina = Skolarina::findOrFail($id);
        $skolarina->delete();
        return '';
    }
}
