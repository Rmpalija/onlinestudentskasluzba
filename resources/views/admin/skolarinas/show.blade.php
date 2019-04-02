@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.skolarina.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.skolarina.fields.student')</th>
                            <td field-key='student'>{{ $skolarina->student->ime ?? '' }}</td>
<td field-key='jmb'>{{ isset($skolarina->student) ? $skolarina->student->jmb : '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.skolarina.fields.semestar')</th>
                            <td field-key='semestar'>{{ $skolarina->semestar }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.skolarina.fields.uplata')</th>
                            <td field-key='uplata'>{{ $skolarina->uplata }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.skolarinas.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


