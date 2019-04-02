<?php

namespace App\Http\Controllers\Api\V1;

use App\Fakulteti;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFakultetisRequest;
use App\Http\Requests\Admin\UpdateFakultetisRequest;

class FakultetisController extends Controller
{
    public function index()
    {
        return Fakulteti::all();
    }

    public function show($id)
    {
        return Fakulteti::findOrFail($id);
    }

    public function update(UpdateFakultetisRequest $request, $id)
    {
        $fakulteti = Fakulteti::findOrFail($id);
        $fakulteti->update($request->all());
        

        return $fakulteti;
    }

    public function store(StoreFakultetisRequest $request)
    {
        $fakulteti = Fakulteti::create($request->all());
        

        return $fakulteti;
    }

    public function destroy($id)
    {
        $fakulteti = Fakulteti::findOrFail($id);
        $fakulteti->delete();
        return '';
    }
}
