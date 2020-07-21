@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Ingreso del Trabajador')</h3>
    
    {!! Form::model($ingreso, ['method' => 'PUT', 'route' => ['admin.ingresos.update', $ingreso->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('worker_id', trans('Trabajador:').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('worker_id', $workers, old('worker_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('worker_id'))
                        <p class="help-block">
                            {{ $errors->first('worker_id') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-5 form-group">
                    {!! Form::label('bruto', trans('Bruto').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('bruto', old('bruto'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('bruto'))
                        <p class="help-bruto">
                            {{ $errors->first('bruto') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-9  form-group">
                    {!! Form::label('familiar', trans('Familiar').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('familiar', old('familiar'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('familiar'))
                        <p class="help-block">
                            {{ $errors->first('familiar') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-4 form-group">
                    {!! Form::label('remuneracion_variable', trans('Remuneracion_variable').'*', ['class' => 'control-label']) !!}
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

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

