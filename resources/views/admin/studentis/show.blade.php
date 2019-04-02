@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.studenti.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.studenti.fields.ime')</th>
                            <td field-key='ime'>{{ $studenti->ime }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.studenti.fields.prezime')</th>
                            <td field-key='prezime'>{{ $studenti->prezime }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.studenti.fields.jmb')</th>
                            <td field-key='jmb'>{{ $studenti->jmb }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.studenti.fields.index')</th>
                            <td field-key='index'>{{ $studenti->index }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.studenti.fields.status')</th>
                            <td field-key='status'>{{ $studenti->status }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.studenti.fields.slika')</th>
                            <td field-key='slika'>@if($studenti->slika)<a href="{{ asset(env('UPLOAD_PATH').'/' . $studenti->slika) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $studenti->slika) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.studenti.fields.predmeti')</th>
                            <td field-key='predmeti'>
                                @foreach ($studenti->predmeti as $singlePredmeti)
                                    <span class="label label-info label-many">{{ $singlePredmeti->naziv }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.studenti.fields.fakultet')</th>
                            <td field-key='fakultet'>{{ $studenti->fakultet->naziv ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#skolarina" aria-controls="skolarina" role="tab" data-toggle="tab">Skolarina</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="skolarina">
<table class="table table-bordered table-striped {{ count($skolarinas) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.skolarina.fields.student')</th>
                        <th>@lang('quickadmin.skolarina.fields.semestar')</th>
                        <th>@lang('quickadmin.skolarina.fields.uplata')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($skolarinas) > 0)
            @foreach ($skolarinas as $skolarina)
                <tr data-entry-id="{{ $skolarina->id }}">
                    <td field-key='student'>{{ $skolarina->student->ime ?? '' }}</td>
                                <td field-key='semestar'>{{ $skolarina->semestar }}</td>
                                <td field-key='uplata'>{{ $skolarina->uplata }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('skolarina_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.skolarinas.restore', $skolarina->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('skolarina_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.skolarinas.perma_del', $skolarina->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('skolarina_view')
                                    <a href="{{ route('admin.skolarinas.show',[$skolarina->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('skolarina_edit')
                                    <a href="{{ route('admin.skolarinas.edit',[$skolarina->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('skolarina_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.skolarinas.destroy', $skolarina->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.studentis.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


