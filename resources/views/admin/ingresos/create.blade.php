@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Añadir planilla de ingreso')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.ingresos.store'], 'files' => true,]) !!}

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
                    {!! Form::label('bruto', trans('Bruto:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('bruto', old('bruto'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('bruto'))
                        <p class="help-block">
                            {{ $errors->first('bruto') }}
                        </p>
                    @endif
                </div>
            </div>  

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('familiar', trans('Familiar:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('familiar', old('familiar'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('familiar'))
                        <p class="help-block">
                            {{ $errors->first('familiar') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('remuneracion_variable', trans('Remuneracion Variable:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('remuneracion_variable', old('remuneracion_variable'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('remuneracion_variable'))
                        <p class="help-block">
                            {{ $errors->first('remuneracion_variable') }}
                        </p>
                    @endif
                </div>
            </div>

            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

