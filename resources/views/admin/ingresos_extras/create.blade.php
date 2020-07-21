@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Añadir planilla de ingresos extras')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.ingresos_extras.store'], 'files' => true,]) !!}

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
                    {!! Form::label('bono', trans('Bono:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('bono', old('bono'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('bono'))
                        <p class="help-block">
                            {{ $errors->first('bono') }}
                        </p>
                    @endif
                </div>
            </div>  

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('bono_sueldo', trans('Bono sueldo:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('bono_sueldo', old('bono_sueldo'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('bono_sueldo'))
                        <p class="help-block">
                            {{ $errors->first('bono_sueldo') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('movilidad', trans('Movilidad:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('movilidad', old('movilidad'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('movilidad'))
                        <p class="help-block">
                            {{ $errors->first('movilidad') }}
                        </p>
                    @endif
                </div>
            </div>

            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

