@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.predmeti.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.predmeti.fields.naziv')</th>
                            <td field-key='naziv'>{{ $predmeti->naziv }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.predmeti.fields.profesor')</th>
                            <td field-key='profesor'>{{ $predmeti->profesor->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.predmeti.fields.semestar')</th>
                            <td field-key='semestar'>{{ $predmeti->semestar }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.predmeti.fields.fakulteti')</th>
                            <td field-key='fakulteti'>
                                @foreach ($predmeti->fakulteti as $singleFakulteti)
                                    <span class="label label-info label-many">{{ $singleFakulteti->naziv }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#ispiti" aria-controls="ispiti" role="tab" data-toggle="tab">Ispiti</a></li>
<li role="presentation" class=""><a href="#profesori" aria-controls="profesori" role="tab" data-toggle="tab">Profesori</a></li>
<li role="presentation" class=""><a href="#studenti" aria-controls="studenti" role="tab" data-toggle="tab">Studenti</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="ispiti">
<table class="table table-bordered table-striped {{ count($ispitis) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.ispiti.fields.kalendarski-naziv')</th>
                        <th>@lang('quickadmin.ispiti.fields.fakultet')</th>
                        <th>@lang('quickadmin.ispiti.fields.profesor')</th>
                        <th>@lang('quickadmin.ispiti.fields.predmet')</th>
                        <th>@lang('quickadmin.ispiti.fields.datum-izvrsavanja')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($ispitis) > 0)
            @foreach ($ispitis as $ispiti)
                <tr data-entry-id="{{ $ispiti->id }}">
                    <td field-key='kalendarski_naziv'>{{ $ispiti->kalendarski_naziv }}</td>
                                <td field-key='fakultet'>
                                    @foreach ($ispiti->fakultet as $singleFakultet)
                                        <span class="label label-info label-many">{{ $singleFakultet->naziv }}</span>
                                    @endforeach
                                </td>
                                <td field-key='profesor'>{{ $ispiti->profesor->ime ?? '' }}</td>
                                <td field-key='predmet'>{{ $ispiti->predmet->naziv ?? '' }}</td>
                                <td field-key='datum_izvrsavanja'>{{ $ispiti->datum_izvrsavanja }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('ispiti_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.ispitis.restore', $ispiti->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('ispiti_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.ispitis.perma_del', $ispiti->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('ispiti_view')
                                    <a href="{{ route('admin.ispitis.show',[$ispiti->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('ispiti_edit')
                                    <a href="{{ route('admin.ispitis.edit',[$ispiti->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('ispiti_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.ispitis.destroy', $ispiti->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="profesori">
<table class="table table-bordered table-striped {{ count($profesoris) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.profesori.fields.ime')</th>
                        <th>@lang('quickadmin.profesori.fields.prezime')</th>
                        <th>@lang('quickadmin.profesori.fields.zvanje')</th>
                        <th>@lang('quickadmin.profesori.fields.slika')</th>
                        <th>@lang('quickadmin.profesori.fields.status')</th>
                        <th>@lang('quickadmin.profesori.fields.fakultet')</th>
                        <th>@lang('quickadmin.profesori.fields.predmeti')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($profesoris) > 0)
            @foreach ($profesoris as $profesori)
                <tr data-entry-id="{{ $profesori->id }}">
                    <td field-key='ime'>{{ $profesori->ime }}</td>
                                <td field-key='prezime'>{{ $profesori->prezime }}</td>
                                <td field-key='zvanje'>{{ $profesori->zvanje }}</td>
                                <td field-key='slika'>@if($profesori->slika)<a href="{{ asset(env('UPLOAD_PATH').'/' . $profesori->slika) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $profesori->slika) }}"/></a>@endif</td>
                                <td field-key='status'>{{ $profesori->status }}</td>
                                <td field-key='fakultet'>
                                    @foreach ($profesori->fakultet as $singleFakultet)
                                        <span class="label label-info label-many">{{ $singleFakultet->naziv }}</span>
                                    @endforeach
                                </td>
                                <td field-key='predmeti'>
                                    @foreach ($profesori->predmeti as $singlePredmeti)
                                        <span class="label label-info label-many">{{ $singlePredmeti->naziv }}</span>
                                    @endforeach
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('profesori_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.profesoris.restore', $profesori->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('profesori_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.profesoris.perma_del', $profesori->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('profesori_view')
                                    <a href="{{ route('admin.profesoris.show',[$profesori->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('profesori_edit')
                                    <a href="{{ route('admin.profesoris.edit',[$profesori->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('profesori_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.profesoris.destroy', $profesori->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="studenti">
<table class="table table-bordered table-striped {{ count($studentis) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.studenti.fields.ime')</th>
                        <th>@lang('quickadmin.studenti.fields.prezime')</th>
                        <th>@lang('quickadmin.studenti.fields.jmb')</th>
                        <th>@lang('quickadmin.studenti.fields.index')</th>
                        <th>@lang('quickadmin.studenti.fields.status')</th>
                        <th>@lang('quickadmin.studenti.fields.slika')</th>
                        <th>@lang('quickadmin.studenti.fields.predmeti')</th>
                        <th>@lang('quickadmin.studenti.fields.fakultet')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($studentis) > 0)
            @foreach ($studentis as $studenti)
                <tr data-entry-id="{{ $studenti->id }}">
                    <td field-key='ime'>{{ $studenti->ime }}</td>
                                <td field-key='prezime'>{{ $studenti->prezime }}</td>
                                <td field-key='jmb'>{{ $studenti->jmb }}</td>
                                <td field-key='index'>{{ $studenti->index }}</td>
                                <td field-key='status'>{{ $studenti->status }}</td>
                                <td field-key='slika'>@if($studenti->slika)<a href="{{ asset(env('UPLOAD_PATH').'/' . $studenti->slika) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $studenti->slika) }}"/></a>@endif</td>
                                <td field-key='predmeti'>
                                    @foreach ($studenti->predmeti as $singlePredmeti)
                                        <span class="label label-info label-many">{{ $singlePredmeti->naziv }}</span>
                                    @endforeach
                                </td>
                                <td field-key='fakultet'>{{ $studenti->fakultet->naziv ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('studenti_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.studentis.restore', $studenti->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('studenti_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.studentis.perma_del', $studenti->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('studenti_view')
                                    <a href="{{ route('admin.studentis.show',[$studenti->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('studenti_edit')
                                    <a href="{{ route('admin.studentis.edit',[$studenti->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('studenti_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.studentis.destroy', $studenti->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="13">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.predmetis.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


