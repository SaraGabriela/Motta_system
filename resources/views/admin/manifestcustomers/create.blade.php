@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Crear Cliente')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.manifestcustomers.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_sector', trans('Sector:').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('id_sector', $sector, old('id_sector'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_sector'))
                        <p class="help-block">
                            {{ $errors->first('id_sector') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('Nombre').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ruc', trans('Ruc').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('ruc', old('ruc'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ruc'))
                        <p class="help-block">
                            {{ $errors->first('ruc') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('contact_name', trans('Nombre Contacto:'), ['class' => 'control-label']) !!}
                    {!! Form::text('contact_name', old('contact_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('contact_name'))
                        <p class="help-block">
                            {{ $errors->first('contact_name') }}
                        </p>
                    @endif
                </div>
            </div>   
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('contact_phone', trans('Nombre telefono:'), ['class' => 'control-label']) !!}
                    {!! Form::text('contact_phone', old('contact_phone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('contact_phone'))
                        <p class="help-block">
                            {{ $errors->first('contact_phone') }}
                        </p>
                    @endif
                </div>
            </div>   

        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop