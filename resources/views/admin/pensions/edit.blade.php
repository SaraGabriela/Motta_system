@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Editar Seguro Pensiones')</h3>
    
    {!! Form::model($pension, ['method' => 'PUT', 'route' => ['admin.pensions.update', $pension->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nombre', trans('Nombre').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nombre'))
                        <p class="help-block">
                            {{ $errors->first('nombre') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('fecha', trans('Fecha').'*', ['class' => 'control-label']) !!}
                    {!! Form::date('fecha', old('fecha'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('fecha'))
                        <p class="help-block">
                            {{ $errors->first('fecha') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('obligatorio', trans('Obligatorio').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('obligatorio', old('obligatorio'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('obligatorio'))
                        <p class="help-block">
                            {{ $errors->first('obligatorio') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('seguro', trans('Seguro:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('seguro', old('seguro'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('seguro'))
                        <p class="help-block">
                            {{ $errors->first('seguro') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('variable', trans('Variable').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('variable', old('variable'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('variable'))
                        <p class="help-block">
                            {{ $errors->first('variable') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('estado', trans('Estado').'*', ['class' => 'control-label']) !!}
                    {!! Form::checkbox('estado', old('estado'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('estado'))
                        <p class="help-block">
                            {{ $errors->first('estado') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

