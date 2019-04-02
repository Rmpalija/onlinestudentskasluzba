@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.skolarina.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.skolarinas.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('student_id', trans('quickadmin.skolarina.fields.student').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('student_id', $students, old('student_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('student_id'))
                        <p class="help-block">
                            {{ $errors->first('student_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('semestar', trans('quickadmin.skolarina.fields.semestar').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('uplata', trans('quickadmin.skolarina.fields.uplata').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('uplata', old('uplata'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('uplata'))
                        <p class="help-block">
                            {{ $errors->first('uplata') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

