@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Editar Trabajadores')</h3>
    
    {!! Form::model($worker, ['method' => 'PUT', 'route' => ['admin.workers.update', $worker->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

    <div class="panel-body">
        <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('job_title', trans('Cargo:').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('job_title[]', $job_titles, old('job_title'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('job_title'))
                        <p class="help-block">
                            {{ $errors->first('job_title') }}
                        </p>
                    @endif
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('area_worker', trans('Area:').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('area_worker[]', $area_workers, old('area_worker'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('area_worker'))
                        <p class="help-block">
                            {{ $errors->first('area_worker') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('subarea_worker', trans('Sub-Area:').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('subarea_worker[]', $subarea_workers, old('subarea_worker'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('subarea_worker'))
                        <p class="help-block">
                            {{ $errors->first('subarea_worker') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('pension', trans('Seguro Pension').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('pension[]', $pensions, old('pension'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pension'))
                        <p class="help-block">
                            {{ $errors->first('pension') }}
                        </p>
                    @endif
                </div>
            </div>


            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('nombre_del_trabajador', trans('nombre del trabajador').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre_del_trabajador', old('nombre_del_trabajador'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nombre_del_trabajador'))
                        <p class="help-block">
                            {{ $errors->first('nombre_del_trabajador') }}
                        </p>
                    @endif
                </div>
            </div>


            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('total_dias_pagado', trans('nTotal de dias pagados:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('total_dias_pagado', old('total_dias_pagado'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('total_dias_pagado'))
                        <p class="help-block">
                            {{ $errors->first('total_dias_pagado') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('documento_indentificacion', trans('Numero Documento:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('documento_indentificacion', old('documento_indentificacion'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('documento_indentificacion'))
                        <p class="help-block">
                            {{ $errors->first('documento_indentificacion') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('banco', trans('Banco:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('banco', old('banco'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('banco'))
                        <p class="help-block">
                            {{ $errors->first('banco') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('cussp', trans('CUSSP:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('cussp', old('cussp'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cussp'))
                        <p class="help-block">
                            {{ $errors->first('cussp') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('cuenta_sueldo', trans('Cuenta Sueldo:').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('cuenta_sueldo', old('cuenta_sueldo'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cuenta_sueldo'))
                        <p class="help-block">
                            {{ $errors->first('cuenta_sueldo') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('cuenta_interbancaria', trans('Cuenta Interbancaria:').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('cuenta_interbancaria', old('cuenta_interbancaria'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cuenta_interbancaria'))
                        <p class="help-block">
                            {{ $errors->first('cuenta_interbancaria') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('cuenta_viaticos', trans('Cuenta Viaticos:').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('cuenta_viaticos', old('cuenta_viaticos'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cuenta_viaticos'))
                        <p class="help-block">
                            {{ $errors->first('cuenta_viaticos') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('fecha_de_ingreso', trans('Fecha Ingreso:').'*', ['class' => 'control-label']) !!}
                    {!! Form::date('fecha_de_ingreso', old('fecha_de_ingreso'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('fecha_de_ingreso'))
                        <p class="help-block">
                            {{ $errors->first('fecha_de_ingreso') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('fecha_de_cese', trans('Fecha Cese:').'*', ['class' => 'control-label']) !!}
                    {!! Form::date('fecha_de_cese', old('fecha_de_cese'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('fecha_de_cese'))
                        <p class="help-block">
                            {{ $errors->first('fecha_de_cese') }}
                        </p>
                    @endif
                </div>
            </div>
        
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

