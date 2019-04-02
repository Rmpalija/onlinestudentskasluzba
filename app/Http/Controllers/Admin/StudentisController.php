<?php

namespace App\Http\Controllers\Admin;

use App\Studenti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStudentisRequest;
use App\Http\Requests\Admin\UpdateStudentisRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class StudentisController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Studenti.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('studenti_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('studenti_delete')) {
                return abort(401);
            }
            $studentis = Studenti::onlyTrashed()->get();
        } else {
            $studentis = Studenti::all();
        }

        return view('admin.studentis.index', compact('studentis'));
    }

    /**
     * Show the form for creating new Studenti.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('studenti_create')) {
            return abort(401);
        }
        
        $predmetis = \App\Predmeti::get()->pluck('naziv', 'id');

        $fakultets = \App\Fakulteti::get()->pluck('naziv', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $enum_status = Studenti::$enum_status;
            
        return view('admin.studentis.create', compact('enum_status', 'predmetis', 'fakultets'));
    }

    /**
     * Store a newly created Studenti in storage.
     *
     * @param  \App\Http\Requests\StoreStudentisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentisRequest $request)
    {
        if (! Gate::allows('studenti_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $studenti = Studenti::create($request->all());
        $studenti->predmeti()->sync(array_filter((array)$request->input('predmeti')));



        return redirect()->route('admin.studentis.index');
    }


    /**
     * Show the form for editing Studenti.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('studenti_edit')) {
            return abort(401);
        }
        
        $predmetis = \App\Predmeti::get()->pluck('naziv', 'id');

        $fakultets = \App\Fakulteti::get()->pluck('naziv', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $enum_status = Studenti::$enum_status;
            
        $studenti = Studenti::findOrFail($id);

        return view('admin.studentis.edit', compact('studenti', 'enum_status', 'predmetis', 'fakultets'));
    }

    /**
     * Update Studenti in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentisRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentisRequest $request, $id)
    {
        if (! Gate::allows('studenti_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $studenti = Studenti::findOrFail($id);
        $studenti->update($request->all());
        $studenti->predmeti()->sync(array_filter((array)$request->input('predmeti')));



        return redirect()->route('admin.studentis.index');
    }


    /**
     * Display Studenti.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('studenti_view')) {
            return abort(401);
        }
        
        $predmetis = \App\Predmeti::get()->pluck('naziv', 'id');

        $fakultets = \App\Fakulteti::get()->pluck('naziv', 'id')->prepend(trans('quickadmin.qa_please_select'), '');$skolarinas = \App\Skolarina::where('student_id', $id)->get();

        $studenti = Studenti::findOrFail($id);

        return view('admin.studentis.show', compact('studenti', 'skolarinas'));
    }


    /**
     * Remove Studenti from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('studenti_delete')) {
            return abort(401);
        }
        $studenti = Studenti::findOrFail($id);
        $studenti->delete();

        return redirect()->route('admin.studentis.index');
    }

    /**
     * Delete all selected Studenti at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('studenti_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Studenti::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Studenti from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('studenti_delete')) {
            return abort(401);
        }
        $studenti = Studenti::onlyTrashed()->findOrFail($id);
        $studenti->restore();

        return redirect()->route('admin.studentis.index');
    }

    /**
     * Permanently delete Studenti from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('studenti_delete')) {
            return abort(401);
        }
        $studenti = Studenti::onlyTrashed()->findOrFail($id);
        $studenti->forceDelete();

        return redirect()->route('admin.studentis.index');
    }
}
