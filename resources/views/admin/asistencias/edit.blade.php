@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Asistencia del Trabajador')</h3>
    
    {!! Form::model($asistencia, ['method' => 'PUT', 'route' => ['admin.asistencias.update', $asistencia->id], 'files' => true,]) !!}

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
                    {!! Form::label('dias_vacaciones', trans('Vacaciones:'), ['class' => 'control-label']) !!}
                    {!! Form::text('dias_vacaciones', old('dias_vacaciones'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('dias_vacaciones'))
                        <p class="help-block">
                            {{ $errors->first('dias_vacaciones') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-5 form-group">
                    {!! Form::label('descanso_medico', trans('Descanso medico:'), ['class' => 'control-label']) !!}
                    {!! Form::text('descanso_medico', old('descanso_medico'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('descanso_medico'))
                        <p class="help-block">
                            {{ $errors->first('descanso_medico') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-9  form-group">
                    {!! Form::label('dias_pagados_asistencia', trans('Dias pagados Asistencia:'), ['class' => 'control-label']) !!}
                    {!! Form::text('dias_pagados_asistencia', old('dias_pagados_asistencia'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('dias_pagados_asistencia'))
                        <p class="help-block">
                            {{ $errors->first('dias_pagados_asistencia') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-4 form-group">
                    {!! Form::label('horas_extra_25', trans('Horas extra 25%:'), ['class' => 'control-label']) !!}
                    {!! Form::text('horas_extra_25', old('horas_extra_25'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('horas_extra_25'))
                        <p class="help-block">
                            {{ $errors->first('horas_extra_25') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-4 form-group">
                    {!! Form::label('horas_extra_35', trans('Horas extra 35%:'), ['class' => 'control-label']) !!}
                    {!! Form::text('horas_extra_35', old('horas_extra_35'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('horas_extra_35'))
                        <p class="help-block">
                            {{ $errors->first('horas_extra_35') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-4 form-group">
                    {!! Form::label('horas_extra_100', trans('Horas extra 100%:'), ['class' => 'control-label']) !!}
                    {!! Form::text('horas_extra_100', old('horas_extra_100'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('horas_extra_100'))
                        <p class="help-block">
                            {{ $errors->first('horas_extra_100') }}
                        </p>
                    @endif
                </div>
            </div>
            

            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

