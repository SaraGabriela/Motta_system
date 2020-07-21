@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Añadir planilla de descuento')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.descuentos.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('worker_id', trans('Trabajador:').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('worker_id', $workers, old('worker_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('worker_id'))
                        <p class="help-block">
                            {{ $errors->first('worker_id') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('tardanzas', trans('Tardanzas:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('tardanzas', old('tardanzas'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('tardanzas'))
                        <p class="help-block">
                            {{ $errors->first('tardanzas') }}
                        </p>
                    @endif
                </div>
            </div>  

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('faltas', trans('Faltas:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('faltas', old('faltas'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('faltas'))
                        <p class="help-block">
                            {{ $errors->first('faltas') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('descuento_judicial', trans('Descuento judicial:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('descuento_judicial', old('descuento_judicial'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('descuento_judicial'))
                        <p class="help-block">
                            {{ $errors->first('descuento_judicial') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('descuento_varios', trans('Descuento varios:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('descuento_varios', old('descuento_varios'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('descuento_varios'))
                        <p class="help-block">
                            {{ $errors->first('descuento_varios') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('descuentos', trans('Descuentos:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('descuentos', old('descuentos'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('descuentos'))
                        <p class="help-block">
                            {{ $errors->first('descuentos') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('adelantos', trans('Adelantos:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('adelantos', old('adelantos'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('adelantos'))
                        <p class="help-block">
                            {{ $errors->first('adelantos') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

