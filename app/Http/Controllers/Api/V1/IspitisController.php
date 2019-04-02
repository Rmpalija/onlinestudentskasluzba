<?php

namespace App\Http\Controllers\Api\V1;

use App\Ispiti;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIspitisRequest;
use App\Http\Requests\Admin\UpdateIspitisRequest;

class IspitisController extends Controller
{
    public function index()
    {
        return Ispiti::all();
    }

    public function show($id)
    {
        return Ispiti::findOrFail($id);
    }

    public function update(UpdateIspitisRequest $request, $id)
    {
        $ispiti = Ispiti::findOrFail($id);
        $ispiti->update($request->all());
        

        return $ispiti;
    }

    public function store(StoreIspitisRequest $request)
    {
        $ispiti = Ispiti::create($request->all());
        

        return $ispiti;
    }

    public function destroy($id)
    {
        $ispiti = Ispiti::findOrFail($id);
        $ispiti->delete();
        return '';
    }
}
