@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.fakulteti.title')</h3>
    
    {!! Form::model($fakulteti, ['method' => 'PUT', 'route' => ['admin.fakultetis.update', $fakulteti->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('naziv', trans('quickadmin.fakulteti.fields.naziv').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('naziv', old('naziv'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('naziv'))
                        <p class="help-block">
                            {{ $errors->first('naziv') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
