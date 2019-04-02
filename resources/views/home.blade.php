@extends('layouts.app')

@section('content')
    <div class="row">
         <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Novi Predmeti</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('quickadmin.predmeti.fields.naziv')</th> 
                            <th> @lang('quickadmin.predmeti.fields.semestar')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($predmetis as $predmeti)
                            <tr>
                               
                                <td>{{ $predmeti->naziv }} </td> 
                                <td>{{ $predmeti->semestar }} </td> 
                                <td>

                                    @can('predmeti_view')
                                    <a href="{{ route('admin.predmetis.show',[$predmeti->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan

                                    @can('predmeti_edit')
                                    <a href="{{ route('admin.predmetis.edit',[$predmeti->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan

                                    @can('predmeti_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.predmetis.destroy', $predmeti->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Zakazani ispiti</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('quickadmin.ispiti.fields.kalendarski-naziv')</th> 
                            <th> @lang('quickadmin.ispiti.fields.datum-izvrsavanja')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($ispitis as $ispiti)
                            <tr>
                               
                                <td>{{ $ispiti->kalendarski_naziv }} </td> 
                                <td>{{ $ispiti->datum_izvrsavanja }} </td> 
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
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Novi profesori</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            <th> @lang('quickadmin.profesori.fields.zvanje')</th>
                            <th> @lang('quickadmin.profesori.fields.ime')</th> 
                            <th> @lang('quickadmin.profesori.fields.prezime')</th>
                            <th> @lang('quickadmin.profesori.fields.status')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($profesoris as $profesori)
                            <tr>
                                <td>{{ $profesori->zvanje }} </td>
                                <td>{{ $profesori->ime }} </td> 
                                <td>{{ $profesori->prezime }} </td>
                                <td>{{ $profesori->status }} </td> 
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
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>


    </div>
@endsection

