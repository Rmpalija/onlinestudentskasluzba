@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.studenti.title')</h3>
    @can('studenti_create')
    <p>
        <a href="{{ route('admin.studentis.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('studenti_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.studentis.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.studentis.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($studentis) > 0 ? 'datatable' : '' }} @can('studenti_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('studenti_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('studenti_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

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
@stop

@section('javascript') 
    <script>
        @can('studenti_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.studentis.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection