@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.ispiti.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.ispitis.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('kalendarski_naziv', trans('quickadmin.ispiti.fields.kalendarski-naziv').'', ['class' => 'control-label']) !!}
                    {!! Form::text('kalendarski_naziv', old('kalendarski_naziv'), ['class' => 'form-control', 'placeholder' => 'Unesite naziv kako zelite da se ispit prikaze na studentskom kalendaru']) !!}
                    <p class="help-block">Unesite naziv kako zelite da se ispit prikaze na studentskom kalendaru</p>
                    @if($errors->has('kalendarski_naziv'))
                        <p class="help-block">
                            {{ $errors->first('kalendarski_naziv') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('fakultet', trans('quickadmin.ispiti.fields.fakultet').'*', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-fakultet">
                        {{ trans('quickadmin.qa_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-fakultet">
                        {{ trans('quickadmin.qa_deselect_all') }}
                    </button>
                    {!! Form::select('fakultet[]', $fakultets, old('fakultet'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-fakultet' , 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('fakultet'))
                        <p class="help-block">
                            {{ $errors->first('fakultet') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('profesor_id', trans('quickadmin.ispiti.fields.profesor').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('profesor_id', $profesors, old('profesor_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('profesor_id'))
                        <p class="help-block">
                            {{ $errors->first('profesor_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('predmet_id', trans('quickadmin.ispiti.fields.predmet').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('predmet_id', $predmets, old('predmet_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('predmet_id'))
                        <p class="help-block">
                            {{ $errors->first('predmet_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('datum_izvrsavanja', trans('quickadmin.ispiti.fields.datum-izvrsavanja').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('datum_izvrsavanja', old('datum_izvrsavanja'), ['class' => 'form-control datetime', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('datum_izvrsavanja'))
                        <p class="help-block">
                            {{ $errors->first('datum_izvrsavanja') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
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
            
    <script>
        $("#selectbtn-fakultet").click(function(){
            $("#selectall-fakultet > option").prop("selected","selected");
            $("#selectall-fakultet").trigger("change");
        });
        $("#deselectbtn-fakultet").click(function(){
            $("#selectall-fakultet > option").prop("selected","");
            $("#selectall-fakultet").trigger("change");
        });
    </script>
@stop