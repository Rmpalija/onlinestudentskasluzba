<?php

namespace App\Http\Controllers\Api\V1;

use App\Studenti;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStudentisRequest;
use App\Http\Requests\Admin\UpdateStudentisRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class StudentisController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Studenti::all();
    }

    public function show($id)
    {
        return Studenti::findOrFail($id);
    }

    public function update(UpdateStudentisRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $studenti = Studenti::findOrFail($id);
        $studenti->update($request->all());
        

        return $studenti;
    }

    public function store(StoreStudentisRequest $request)
    {
        $request = $this->saveFiles($request);
        $studenti = Studenti::create($request->all());
        

        return $studenti;
    }

    public function destroy($id)
    {
        $studenti = Studenti::findOrFail($id);
        $studenti->delete();
        return '';
    }
}
