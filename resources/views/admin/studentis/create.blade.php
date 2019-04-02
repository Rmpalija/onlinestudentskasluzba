@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.studenti.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.studentis.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ime', trans('quickadmin.studenti.fields.ime').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('ime', old('ime'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ime'))
                        <p class="help-block">
                            {{ $errors->first('ime') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('prezime', trans('quickadmin.studenti.fields.prezime').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('prezime', old('prezime'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('prezime'))
                        <p class="help-block">
                            {{ $errors->first('prezime') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('jmb', trans('quickadmin.studenti.fields.jmb').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('jmb', old('jmb'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('jmb'))
                        <p class="help-block">
                            {{ $errors->first('jmb') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('index', trans('quickadmin.studenti.fields.index').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('index', old('index'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('index'))
                        <p class="help-block">
                            {{ $errors->first('index') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('status', trans('quickadmin.studenti.fields.status').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('slika', trans('quickadmin.studenti.fields.slika').'', ['class' => 'control-label']) !!}
                    {!! Form::file('slika', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('slika_max_size', 2) !!}
                    {!! Form::hidden('slika_max_width', 4096) !!}
                    {!! Form::hidden('slika_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('slika'))
                        <p class="help-block">
                            {{ $errors->first('slika') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('predmeti', trans('quickadmin.studenti.fields.predmeti').'*', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-predmeti">
                        {{ trans('quickadmin.qa_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-predmeti">
                        {{ trans('quickadmin.qa_deselect_all') }}
                    </button>
                    {!! Form::select('predmeti[]', $predmetis, old('predmeti'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-predmeti' , 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('predmeti'))
                        <p class="help-block">
                            {{ $errors->first('predmeti') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('fakultet_id', trans('quickadmin.studenti.fields.fakultet').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('fakultet_id', $fakultets, old('fakultet_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('fakultet_id'))
                        <p class="help-block">
                            {{ $errors->first('fakultet_id') }}
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

    <script>
        $("#selectbtn-predmeti").click(function(){
            $("#selectall-predmeti > option").prop("selected","selected");
            $("#selectall-predmeti").trigger("change");
        });
        $("#deselectbtn-predmeti").click(function(){
            $("#selectall-predmeti > option").prop("selected","");
            $("#selectall-predmeti").trigger("change");
        });
    </script>
@stop