<?php

namespace App\Http\Controllers\Admin;

use App\Fakulteti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFakultetisRequest;
use App\Http\Requests\Admin\UpdateFakultetisRequest;

class FakultetisController extends Controller
{
    /**
     * Display a listing of Fakulteti.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('fakulteti_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('fakulteti_delete')) {
                return abort(401);
            }
            $fakultetis = Fakulteti::onlyTrashed()->get();
        } else {
            $fakultetis = Fakulteti::all();
        }

        return view('admin.fakultetis.index', compact('fakultetis'));
    }

    /**
     * Show the form for creating new Fakulteti.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('fakulteti_create')) {
            return abort(401);
        }
        return view('admin.fakultetis.create');
    }

    /**
     * Store a newly created Fakulteti in storage.
     *
     * @param  \App\Http\Requests\StoreFakultetisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFakultetisRequest $request)
    {
        if (! Gate::allows('fakulteti_create')) {
            return abort(401);
        }
        $fakulteti = Fakulteti::create($request->all());



        return redirect()->route('admin.fakultetis.index');
    }


    /**
     * Show the form for editing Fakulteti.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('fakulteti_edit')) {
            return abort(401);
        }
        $fakulteti = Fakulteti::findOrFail($id);

        return view('admin.fakultetis.edit', compact('fakulteti'));
    }

    /**
     * Update Fakulteti in storage.
     *
     * @param  \App\Http\Requests\UpdateFakultetisRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFakultetisRequest $request, $id)
    {
        if (! Gate::allows('fakulteti_edit')) {
            return abort(401);
        }
        $fakulteti = Fakulteti::findOrFail($id);
        $fakulteti->update($request->all());



        return redirect()->route('admin.fakultetis.index');
    }


    /**
     * Display Fakulteti.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('fakulteti_view')) {
            return abort(401);
        }
        $ispitis = \App\Ispiti::whereHas('fakultet',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$predmetis = \App\Predmeti::whereHas('fakulteti',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$profesoris = \App\Profesori::whereHas('fakultet',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$studentis = \App\Studenti::where('fakultet_id', $id)->get();

        $fakulteti = Fakulteti::findOrFail($id);

        return view('admin.fakultetis.show', compact('fakulteti', 'ispitis', 'predmetis', 'profesoris', 'studentis'));
    }


    /**
     * Remove Fakulteti from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('fakulteti_delete')) {
            return abort(401);
        }
        $fakulteti = Fakulteti::findOrFail($id);
        $fakulteti->delete();

        return redirect()->route('admin.fakultetis.index');
    }

    /**
     * Delete all selected Fakulteti at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('fakulteti_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Fakulteti::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Fakulteti from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('fakulteti_delete')) {
            return abort(401);
        }
        $fakulteti = Fakulteti::onlyTrashed()->findOrFail($id);
        $fakulteti->restore();

        return redirect()->route('admin.fakultetis.index');
    }

    /**
     * Permanently delete Fakulteti from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('fakulteti_delete')) {
            return abort(401);
        }
        $fakulteti = Fakulteti::onlyTrashed()->findOrFail($id);
        $fakulteti->forceDelete();

        return redirect()->route('admin.fakultetis.index');
    }
}
