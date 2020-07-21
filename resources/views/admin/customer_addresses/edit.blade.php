@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Dirección del Cliente')</h3>
    
    {!! Form::model($customer_address, ['method' => 'PUT', 'route' => ['admin.customer_addresses.update', $customer_address->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('id_customers', trans('Cliente:').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('id_customers', $manifestcustomer, old('id_customers'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_customers'))
                        <p class="help-block">
                            {{ $errors->first('id_customers') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-5 form-group">
                    {!! Form::label('name_address', trans('Dirección:'), ['class' => 'control-label']) !!}
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

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

