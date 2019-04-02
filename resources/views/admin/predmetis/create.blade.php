@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.predmeti.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.predmetis.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('naziv', trans('quickadmin.predmeti.fields.naziv').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('naziv', old('naziv'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('naziv'))
                        <p class="help-block">
                            {{ $errors->first('naziv') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('profesor_id', trans('quickadmin.predmeti.fields.profesor').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('semestar', trans('quickadmin.predmeti.fields.semestar').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('semestar', old('semestar'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('semestar'))
                        <p class="help-block">
                            {{ $errors->first('semestar') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('fakulteti', trans('quickadmin.predmeti.fields.fakulteti').'*', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-fakulteti">
                        {{ trans('quickadmin.qa_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-fakulteti">
                        {{ trans('quickadmin.qa_deselect_all') }}
                    </button>
                    {!! Form::select('fakulteti[]', $fakultetis, old('fakulteti'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-fakulteti' , 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('fakulteti'))
                        <p class="help-block">
                            {{ $errors->first('fakulteti') }}
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
        $("#selectbtn-fakulteti").click(function(){
            $("#selectall-fakulteti > option").prop("selected","selected");
            $("#selectall-fakulteti").trigger("change");
        });
        $("#deselectbtn-fakulteti").click(function(){
            $("#selectall-fakulteti > option").prop("selected","");
            $("#selectall-fakulteti").trigger("change");
        });
    </script>
@stop