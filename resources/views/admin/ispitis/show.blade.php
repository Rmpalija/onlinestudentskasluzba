@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.ispiti.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.ispiti.fields.kalendarski-naziv')</th>
                            <td field-key='kalendarski_naziv'>{{ $ispiti->kalendarski_naziv }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.ispiti.fields.fakultet')</th>
                            <td field-key='fakultet'>
                                @foreach ($ispiti->fakultet as $singleFakultet)
                                    <span class="label label-info label-many">{{ $singleFakultet->naziv }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.ispiti.fields.profesor')</th>
                            <td field-key='profesor'>{{ $ispiti->profesor->ime ?? '' }}</td>
<td field-key='status'>{{ isset($ispiti->profesor) ? $ispiti->profesor->status : '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.ispiti.fields.predmet')</th>
                            <td field-key='predmet'>{{ $ispiti->predmet->naziv ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.ispiti.fields.datum-izvrsavanja')</th>
                            <td field-key='datum_izvrsavanja'>{{ $ispiti->datum_izvrsavanja }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.ispitis.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
@stop
