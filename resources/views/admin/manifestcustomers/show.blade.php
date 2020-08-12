@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Cliente')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">

                        <tr>
                             <th>@lang('Nombre')</th>
                            <td field-key='nombre'>{{ $manifestcustomer->name }}</td>
                        </tr>

                        <tr>
                             <th>@lang('Email')</th>
                            <td field-key='ruc'>{{ $users->first()->email }}</td>
                        </tr>

                        <tr>
                             <th>@lang('Ruc')</th>
                            <td field-key='ruc'>{{ $manifestcustomer->ruc }}</td>
                        </tr>

                        <tr>
                             <th>@lang('Contacto:')</th>
                            <td field-key='contact_name'>{{ $manifestcustomer->contact_name }}</td>
                        </tr>
                        <tr>
                             <th>@lang('Telefono:')</th>
                            <td field-key='contact_name'>{{ $manifestcustomer->contact_phone }}</td>
                        </tr>

                    </table>
                </div>
            </div><!-- Nav tabs -->


            <p>&nbsp;</p>

            <a href="{{ route('admin.manifestcustomers.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
