@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.profesori.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.profesoris.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ime', trans('quickadmin.profesori.fields.ime').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('prezime', trans('quickadmin.profesori.fields.prezime').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('zvanje', trans('quickadmin.profesori.fields.zvanje').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('zvanje', old('zvanje'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('zvanje'))
                        <p class="help-block">
                            {{ $errors->first('zvanje') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('slika', trans('quickadmin.profesori.fields.slika').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('status', trans('quickadmin.profesori.fields.status').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('fakultet', trans('quickadmin.profesori.fields.fakultet').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('predmeti', trans('quickadmin.profesori.fields.predmeti').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-predmeti">
                        {{ trans('quickadmin.qa_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-predmeti">
                        {{ trans('quickadmin.qa_deselect_all') }}
                    </button>
                    {!! Form::select('predmeti[]', $predmetis, old('predmeti'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-predmeti' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('predmeti'))
                        <p class="help-block">
                            {{ $errors->first('predmeti') }}
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
        $("#selectbtn-fakultet").click(function(){
            $("#selectall-fakultet > option").prop("selected","selected");
            $("#selectall-fakultet").trigger("change");
        });
        $("#deselectbtn-fakultet").click(function(){
            $("#selectall-fakultet > option").prop("selected","");
            $("#selectall-fakultet").trigger("change");
        });
    </script>

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