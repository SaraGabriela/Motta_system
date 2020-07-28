@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Añadir documento')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.manifests.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>

        <div class="panel-body">

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_typedocument', trans('Tipo de documento:').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('id_typedocument', $document_type, old('id_typedocument'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_typedocument'))
                        <p class="help-block">
                            {{ $errors->first('id_typedocument') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_customer', trans('Cliente:').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('id_customer', $manifestcustomer, old('id_customer'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_customer'))
                        <p class="help-block">
                            {{ $errors->first('id_customer') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                    <div class="col-xs-12 form-group">
                        {!! Form::label('pick_date', trans('Fecha de recojo').'*', ['class' => 'control-label']) !!}
                        {!! Form::date('pick_date', old('pick_date'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('pick_date'))
                            <p class="help-block">
                                {{ $errors->first('pick_date') }}
                            </p>
                        @endif
                    </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('attached', trans('Archivo adjunto').'*', ['class' => 'control-label']) !!}
                    {!! Form::hidden('attached', old('attached')) !!}
                    {!! Form::file('attached', ['class' => 'form-control', 'required' => '']) !!}
                    {!! Form::hidden('attached_max_size', 2) !!}
                    <p class="help-block"></p>
                    @if($errors->has('attached'))
                        <p class="help-block">
                            {{ $errors->first('attached') }}
                        </p>
                    @endif
                </div>
            </div> 

        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

