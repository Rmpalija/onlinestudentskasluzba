<?php

namespace App\Http\Controllers\Admin;

use App\Profesori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProfesorisRequest;
use App\Http\Requests\Admin\UpdateProfesorisRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class ProfesorisController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Profesori.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('profesori_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('profesori_delete')) {
                return abort(401);
            }
            $profesoris = Profesori::onlyTrashed()->get();
        } else {
            $profesoris = Profesori::all();
        }

        return view('admin.profesoris.index', compact('profesoris'));
    }

    /**
     * Show the form for creating new Profesori.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('profesori_create')) {
            return abort(401);
        }
        
        $fakultets = \App\Fakulteti::get()->pluck('naziv', 'id');

        $predmetis = \App\Predmeti::get()->pluck('naziv', 'id');

        $enum_status = Profesori::$enum_status;
            
        return view('admin.profesoris.create', compact('enum_status', 'fakultets', 'predmetis'));
    }

    /**
     * Store a newly created Profesori in storage.
     *
     * @param  \App\Http\Requests\StoreProfesorisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfesorisRequest $request)
    {
        if (! Gate::allows('profesori_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $profesori = Profesori::create($request->all());
        $profesori->fakultet()->sync(array_filter((array)$request->input('fakultet')));
        $profesori->predmeti()->sync(array_filter((array)$request->input('predmeti')));



        return redirect()->route('admin.profesoris.index');
    }


    /**
     * Show the form for editing Profesori.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('profesori_edit')) {
            return abort(401);
        }
        
        $fakultets = \App\Fakulteti::get()->pluck('naziv', 'id');

        $predmetis = \App\Predmeti::get()->pluck('naziv', 'id');

        $enum_status = Profesori::$enum_status;
            
        $profesori = Profesori::findOrFail($id);

        return view('admin.profesoris.edit', compact('profesori', 'enum_status', 'fakultets', 'predmetis'));
    }

    /**
     * Update Profesori in storage.
     *
     * @param  \App\Http\Requests\UpdateProfesorisRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfesorisRequest $request, $id)
    {
        if (! Gate::allows('profesori_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $profesori = Profesori::findOrFail($id);
        $profesori->update($request->all());
        $profesori->fakultet()->sync(array_filter((array)$request->input('fakultet')));
        $profesori->predmeti()->sync(array_filter((array)$request->input('predmeti')));



        return redirect()->route('admin.profesoris.index');
    }


    /**
     * Display Profesori.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('profesori_view')) {
            return abort(401);
        }
        
        $fakultets = \App\Fakulteti::get()->pluck('naziv', 'id');

        $predmetis = \App\Predmeti::get()->pluck('naziv', 'id');
$ispitis = \App\Ispiti::where('profesor_id', $id)->get();

        $profesori = Profesori::findOrFail($id);

        return view('admin.profesoris.show', compact('profesori', 'ispitis'));
    }


    /**
     * Remove Profesori from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('profesori_delete')) {
            return abort(401);
        }
        $profesori = Profesori::findOrFail($id);
        $profesori->delete();

        return redirect()->route('admin.profesoris.index');
    }

    /**
     * Delete all selected Profesori at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('profesori_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Profesori::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Profesori from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('profesori_delete')) {
            return abort(401);
        }
        $profesori = Profesori::onlyTrashed()->findOrFail($id);
        $profesori->restore();

        return redirect()->route('admin.profesoris.index');
    }

    /**
     * Permanently delete Profesori from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('profesori_delete')) {
            return abort(401);
        }
        $profesori = Profesori::onlyTrashed()->findOrFail($id);
        $profesori->forceDelete();

        return redirect()->route('admin.profesoris.index');
    }
}
