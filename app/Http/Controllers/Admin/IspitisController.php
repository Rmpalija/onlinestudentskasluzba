<?php

namespace App\Http\Controllers\Admin;

use App\Ispiti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIspitisRequest;
use App\Http\Requests\Admin\UpdateIspitisRequest;

class IspitisController extends Controller
{
    /**
     * Display a listing of Ispiti.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('ispiti_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('ispiti_delete')) {
                return abort(401);
            }
            $ispitis = Ispiti::onlyTrashed()->get();
        } else {
            $ispitis = Ispiti::all();
        }

        return view('admin.ispitis.index', compact('ispitis'));
    }

    /**
     * Show the form for creating new Ispiti.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('ispiti_create')) {
            return abort(401);
        }
        
        $fakultets = \App\Fakulteti::get()->pluck('naziv', 'id');

        $profesors = \App\Profesori::get()->pluck('ime', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $predmets = \App\Predmeti::get()->pluck('naziv', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.ispitis.create', compact('fakultets', 'profesors', 'predmets'));
    }

    /**
     * Store a newly created Ispiti in storage.
     *
     * @param  \App\Http\Requests\StoreIspitisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIspitisRequest $request)
    {
        if (! Gate::allows('ispiti_create')) {
            return abort(401);
        }
        $ispiti = Ispiti::create($request->all());
        $ispiti->fakultet()->sync(array_filter((array)$request->input('fakultet')));



        return redirect()->route('admin.ispitis.index');
    }


    /**
     * Show the form for editing Ispiti.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('ispiti_edit')) {
            return abort(401);
        }
        
        $fakultets = \App\Fakulteti::get()->pluck('naziv', 'id');

        $profesors = \App\Profesori::get()->pluck('ime', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $predmets = \App\Predmeti::get()->pluck('naziv', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $ispiti = Ispiti::findOrFail($id);

        return view('admin.ispitis.edit', compact('ispiti', 'fakultets', 'profesors', 'predmets'));
    }

    /**
     * Update Ispiti in storage.
     *
     * @param  \App\Http\Requests\UpdateIspitisRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIspitisRequest $request, $id)
    {
        if (! Gate::allows('ispiti_edit')) {
            return abort(401);
        }
        $ispiti = Ispiti::findOrFail($id);
        $ispiti->update($request->all());
        $ispiti->fakultet()->sync(array_filter((array)$request->input('fakultet')));



        return redirect()->route('admin.ispitis.index');
    }


    /**
     * Display Ispiti.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('ispiti_view')) {
            return abort(401);
        }
        $ispiti = Ispiti::findOrFail($id);

        return view('admin.ispitis.show', compact('ispiti'));
    }


    /**
     * Remove Ispiti from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('ispiti_delete')) {
            return abort(401);
        }
        $ispiti = Ispiti::findOrFail($id);
        $ispiti->delete();

        return redirect()->route('admin.ispitis.index');
    }

    /**
     * Delete all selected Ispiti at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('ispiti_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Ispiti::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Ispiti from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('ispiti_delete')) {
            return abort(401);
        }
        $ispiti = Ispiti::onlyTrashed()->findOrFail($id);
        $ispiti->restore();

        return redirect()->route('admin.ispitis.index');
    }

    /**
     * Permanently delete Ispiti from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('ispiti_delete')) {
            return abort(401);
        }
        $ispiti = Ispiti::onlyTrashed()->findOrFail($id);
        $ispiti->forceDelete();

        return redirect()->route('admin.ispitis.index');
    }
}
