@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Añadir dirección a cliente')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.customer_addresses.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_customers', trans('Cliente:').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('id_customers', $manifestcustomer, old('id_customers'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_customers'))
                        <p class="help-block">
                            {{ $errors->first('id_customers') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('name_address', trans('Dirección:').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name_address', old('name_address'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name_address'))
                        <p class="help-block">
                            {{ $errors->first('name_address') }}
                        </p>
                    @endif
                </div>
            </div>  

        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

