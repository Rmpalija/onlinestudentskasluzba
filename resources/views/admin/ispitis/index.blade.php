@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.ispiti.title')</h3>
    @can('ispiti_create')
    <p>
        <a href="{{ route('admin.ispitis.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('ispiti_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.ispitis.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.ispitis.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($ispitis) > 0 ? 'datatable' : '' }} @can('ispiti_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('ispiti_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.ispiti.fields.kalendarski-naziv')</th>
                        <th>@lang('quickadmin.ispiti.fields.fakultet')</th>
                        <th>@lang('quickadmin.ispiti.fields.profesor')</th>
                        <th>@lang('quickadmin.profesori.fields.status')</th>
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
                                @can('ispiti_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='kalendarski_naziv'>{{ $ispiti->kalendarski_naziv }}</td>
                                <td field-key='fakultet'>
                                    @foreach ($ispiti->fakultet as $singleFakultet)
                                        <span class="label label-info label-many">{{ $singleFakultet->naziv }}</span>
                                    @endforeach
                                </td>
                                <td field-key='profesor'>{{ $ispiti->profesor->ime ?? '' }}</td>
<td field-key='status'>{{ isset($ispiti->profesor) ? $ispiti->profesor->status : '' }}</td>
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
@stop

@section('javascript') 
    <script>
        @can('ispiti_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.ispitis.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection