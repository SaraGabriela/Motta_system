@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Dirección del Cliente')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('Fecha de creación:')</th>
                            <td field-key='property'>{{ $customer_address->created_at or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Cliente:')</th>
                            <td field-key='nombre_del_trabajador'>{{ $customer_address->manifestcustomer->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Dirección:')</th>
                            <td field-key='dias_vacaciones'>{{ $customer_address->name_address or '0' }}</td>
                        </tr>

                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.customer_addresses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
