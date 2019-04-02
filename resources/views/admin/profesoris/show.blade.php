@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.profesori.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.profesori.fields.ime')</th>
                            <td field-key='ime'>{{ $profesori->ime }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.profesori.fields.prezime')</th>
                            <td field-key='prezime'>{{ $profesori->prezime }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.profesori.fields.zvanje')</th>
                            <td field-key='zvanje'>{{ $profesori->zvanje }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.profesori.fields.slika')</th>
                            <td field-key='slika'>@if($profesori->slika)<a href="{{ asset(env('UPLOAD_PATH').'/' . $profesori->slika) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $profesori->slika) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.profesori.fields.status')</th>
                            <td field-key='status'>{{ $profesori->status }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.profesori.fields.fakultet')</th>
                            <td field-key='fakultet'>
                                @foreach ($profesori->fakultet as $singleFakultet)
                                    <span class="label label-info label-many">{{ $singleFakultet->naziv }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.profesori.fields.predmeti')</th>
                            <td field-key='predmeti'>
                                @foreach ($profesori->predmeti as $singlePredmeti)
                                    <span class="label label-info label-many">{{ $singlePredmeti->naziv }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#ispiti" aria-controls="ispiti" role="tab" data-toggle="tab">Ispiti</a></li>
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.profesoris.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


