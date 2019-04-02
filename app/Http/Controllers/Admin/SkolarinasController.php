<?php

namespace App\Http\Controllers\Admin;

use App\Skolarina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSkolarinasRequest;
use App\Http\Requests\Admin\UpdateSkolarinasRequest;

class SkolarinasController extends Controller
{
    /**
     * Display a listing of Skolarina.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('skolarina_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('skolarina_delete')) {
                return abort(401);
            }
            $skolarinas = Skolarina::onlyTrashed()->get();
        } else {
            $skolarinas = Skolarina::all();
        }

        return view('admin.skolarinas.index', compact('skolarinas'));
    }

    /**
     * Show the form for creating new Skolarina.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('skolarina_create')) {
            return abort(401);
        }
        
        $students = \App\Studenti::get()->pluck('ime', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.skolarinas.create', compact('students'));
    }

    /**
     * Store a newly created Skolarina in storage.
     *
     * @param  \App\Http\Requests\StoreSkolarinasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkolarinasRequest $request)
    {
        if (! Gate::allows('skolarina_create')) {
            return abort(401);
        }
        $skolarina = Skolarina::create($request->all());



        return redirect()->route('admin.skolarinas.index');
    }


    /**
     * Show the form for editing Skolarina.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('skolarina_edit')) {
            return abort(401);
        }
        
        $students = \App\Studenti::get()->pluck('ime', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $skolarina = Skolarina::findOrFail($id);

        return view('admin.skolarinas.edit', compact('skolarina', 'students'));
    }

    /**
     * Update Skolarina in storage.
     *
     * @param  \App\Http\Requests\UpdateSkolarinasRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSkolarinasRequest $request, $id)
    {
        if (! Gate::allows('skolarina_edit')) {
            return abort(401);
        }
        $skolarina = Skolarina::findOrFail($id);
        $skolarina->update($request->all());



        return redirect()->route('admin.skolarinas.index');
    }


    /**
     * Display Skolarina.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('skolarina_view')) {
            return abort(401);
        }
        $skolarina = Skolarina::findOrFail($id);

        return view('admin.skolarinas.show', compact('skolarina'));
    }


    /**
     * Remove Skolarina from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('skolarina_delete')) {
            return abort(401);
        }
        $skolarina = Skolarina::findOrFail($id);
        $skolarina->delete();

        return redirect()->route('admin.skolarinas.index');
    }

    /**
     * Delete all selected Skolarina at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('skolarina_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Skolarina::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Skolarina from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('skolarina_delete')) {
            return abort(401);
        }
        $skolarina = Skolarina::onlyTrashed()->findOrFail($id);
        $skolarina->restore();

        return redirect()->route('admin.skolarinas.index');
    }

    /**
     * Permanently delete Skolarina from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('skolarina_delete')) {
            return abort(401);
        }
        $skolarina = Skolarina::onlyTrashed()->findOrFail($id);
        $skolarina->forceDelete();

        return redirect()->route('admin.skolarinas.index');
    }
}
