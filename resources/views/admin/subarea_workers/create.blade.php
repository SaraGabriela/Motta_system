@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Crear Sub Area Trabajo')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.subarea_workers.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
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
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

