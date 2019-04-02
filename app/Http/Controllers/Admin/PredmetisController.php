<?php

namespace App\Http\Controllers\Admin;

use App\Predmeti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePredmetisRequest;
use App\Http\Requests\Admin\UpdatePredmetisRequest;

class PredmetisController extends Controller
{
    /**
     * Display a listing of Predmeti.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('predmeti_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('predmeti_delete')) {
                return abort(401);
            }
            $predmetis = Predmeti::onlyTrashed()->get();
        } else {
            $predmetis = Predmeti::all();
        }

        return view('admin.predmetis.index', compact('predmetis'));
    }

    /**
     * Show the form for creating new Predmeti.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('predmeti_create')) {
            return abort(401);
        }
        
        $profesors = \App\Profesori::get()->pluck('ime', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $fakultetis = \App\Fakulteti::get()->pluck('naziv', 'id');


        return view('admin.predmetis.create', compact('profesors', 'fakultetis'));
    }

    /**
     * Store a newly created Predmeti in storage.
     *
     * @param  \App\Http\Requests\StorePredmetisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePredmetisRequest $request)
    {
        if (! Gate::allows('predmeti_create')) {
            return abort(401);
        }
        $predmeti = Predmeti::create($request->all());
        $predmeti->fakulteti()->sync(array_filter((array)$request->input('fakulteti')));



        return redirect()->route('admin.predmetis.index');
    }


    /**
     * Show the form for editing Predmeti.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('predmeti_edit')) {
            return abort(401);
        }
        
        $profesors = \App\Profesori::get()->pluck('ime', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $fakultetis = \App\Fakulteti::get()->pluck('naziv', 'id');


        $predmeti = Predmeti::findOrFail($id);

        return view('admin.predmetis.edit', compact('predmeti', 'profesors', 'fakultetis'));
    }

    /**
     * Update Predmeti in storage.
     *
     * @param  \App\Http\Requests\UpdatePredmetisRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePredmetisRequest $request, $id)
    {
        if (! Gate::allows('predmeti_edit')) {
            return abort(401);
        }
        $predmeti = Predmeti::findOrFail($id);
        $predmeti->update($request->all());
        $predmeti->fakulteti()->sync(array_filter((array)$request->input('fakulteti')));



        return redirect()->route('admin.predmetis.index');
    }


    /**
     * Display Predmeti.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('predmeti_view')) {
            return abort(401);
        }
        
        $profesors = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $fakultetis = \App\Fakulteti::get()->pluck('naziv', 'id');
$ispitis = \App\Ispiti::where('predmet_id', $id)->get();$profesoris = \App\Profesori::whereHas('predmeti',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$studentis = \App\Studenti::whereHas('predmeti',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $predmeti = Predmeti::findOrFail($id);

        return view('admin.predmetis.show', compact('predmeti', 'ispitis', 'profesoris', 'studentis'));
    }


    /**
     * Remove Predmeti from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('predmeti_delete')) {
            return abort(401);
        }
        $predmeti = Predmeti::findOrFail($id);
        $predmeti->delete();

        return redirect()->route('admin.predmetis.index');
    }

    /**
     * Delete all selected Predmeti at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('predmeti_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Predmeti::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Predmeti from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('predmeti_delete')) {
            return abort(401);
        }
        $predmeti = Predmeti::onlyTrashed()->findOrFail($id);
        $predmeti->restore();

        return redirect()->route('admin.predmetis.index');
    }

    /**
     * Permanently delete Predmeti from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('predmeti_delete')) {
            return abort(401);
        }
        $predmeti = Predmeti::onlyTrashed()->findOrFail($id);
        $predmeti->forceDelete();

        return redirect()->route('admin.predmetis.index');
    }
}
