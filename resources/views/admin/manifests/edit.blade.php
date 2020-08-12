@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Documento a editar')</h3>
    
    {!! Form::model($manifest, ['method' => 'PUT', 'route' => ['admin.manifests.update', $manifest->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                    <div class="col-xs-12 form-group">
                        {!! Form::label('code', trans('Fecha de recojo').'*', ['class' => 'control-label']) !!}
                        {!! Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('code'))
                            <p class="help-block">
                                {{ $errors->first('code') }}
                            </p>
                        @endif
                    </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_typedocument', trans('Tipo de documento:').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('id_typedocument', $document_type, old('id_typedocument'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_typedocument'))
                        <p class="help-block">
                            {{ $errors->first('id_typedocument') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                        {!! Form::label('id_customer', trans('Cliente:').'*', ['class' => 'control-label']) !!}
                        {!! Form::select('id_customer', $manifestcustomer, old('id_customer'), ['class' => 'form-control select2', 'required' => '']) !!}
                        <p class="help-block"></p>
                    @if($errors->has('id_customer'))
                        <p class="help-block">
                            {{ $errors->first('id_customer') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                        {!! Form::label('id_customer_addresses', trans('Dirección:').'*', ['class' => 'control-label']) !!}
                        {!! Form::select('id_customer_addresses', ['class' => 'form-control select2', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                    <div class="col-xs-12 form-group">
                        {!! Form::label('pick_date', trans('Fecha de recojo').'*', ['class' => 'control-label']) !!}
                        {!! Form::date('pick_date', old('pick_date'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('pick_date'))
                            <p class="help-block">
                                {{ $errors->first('pick_date') }}
                            </p>
                        @endif
                    </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('attached', trans('Archivo adjunto').'*', ['class' => 'control-label']) !!}
                    {!! Form::hidden('attached', old('attached')) !!}
                    {!! Form::file('attached', ['class' => 'form-control', 'required' => '']) !!}
                    {!! Form::hidden('attached_max_size', 2) !!}
                    <p class="help-block"></p>
                    @if($errors->has('attached'))
                        <p class="help-block">
                            {{ $errors->first('attached') }}
                        </p>
                    @endif
                </div>
            </div> 
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
    <script type="text/javascript">

    jQuery(document).ready(function ()
    {
 
            jQuery('select[name="id_customer"]').on('change',function(){
                
               var countryID = jQuery(this).val();
               window.alert(countryID);
               if(countryID)
               {
                  jQuery.ajax({
                     url : 'dropdownlist/getstate/' +countryID,
                     type : "GET",
                     dataType : "json",
                     
                     success:function(data)
                     {
                        jQuery('select[name="id_customer_addresses"]').empty();
                        
                        jQuery.each(data, function(key,value){
                            
                            $('select[name="id_customer_addresses"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     },
                     
                  });
               }
               else
               {
                  $('select[name="id_customer_addresses"]').empty();
               }
            });
    });
</script>
     </div>
        <head>

</head>
 
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

