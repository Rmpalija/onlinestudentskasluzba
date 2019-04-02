<?php

namespace App\Http\Controllers\Api\V1;

use App\Predmeti;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePredmetisRequest;
use App\Http\Requests\Admin\UpdatePredmetisRequest;

class PredmetisController extends Controller
{
    public function index()
    {
        return Predmeti::all();
    }

    public function show($id)
    {
        return Predmeti::findOrFail($id);
    }

    public function update(UpdatePredmetisRequest $request, $id)
    {
        $predmeti = Predmeti::findOrFail($id);
        $predmeti->update($request->all());
        

        return $predmeti;
    }

    public function store(StorePredmetisRequest $request)
    {
        $predmeti = Predmeti::create($request->all());
        

        return $predmeti;
    }

    public function destroy($id)
    {
        $predmeti = Predmeti::findOrFail($id);
        $predmeti->delete();
        return '';
    }
}
