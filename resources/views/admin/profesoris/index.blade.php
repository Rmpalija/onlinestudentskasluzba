@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.profesori.title')</h3>
    @can('profesori_create')
    <p>
        <a href="{{ route('admin.profesoris.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('profesori_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.profesoris.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.profesoris.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($profesoris) > 0 ? 'datatable' : '' }} @can('profesori_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('profesori_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('profesori_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

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
    </div>
@stop

@section('javascript') 
    <script>
        @can('profesori_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.profesoris.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection