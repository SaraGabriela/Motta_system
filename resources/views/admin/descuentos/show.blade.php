@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Descuento del Trabajador')</h3>

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
                            <td field-key='property'>{{ $descuento->created_at or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Trabajador:')</th>
                            <td field-key='user'>{{ $descuento->worker->nombre_del_trabajador or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('tardanzas:')</th>
                            <td field-key='user'>{{ $descuento->tardanzas or '' }}</td>
                        </tr>

                        <tr>
                            <th>@lang('faltas:')</th>
                            <td field-key='user'>{{ $descuento->faltas or '' }}</td>
                        </tr>

                        <tr>
                            <th>@lang('descuento_judicial:')</th>
                            <td field-key='user'>{{ $descuento->descuento_judicial or '0' }}</td>
                        </tr>   

                        <tr>
                            <th>@lang('descuento_varios:')</th>
                            <td field-key='user'>{{ $descuento->descuento_varios or '0' }}</td>
                        </tr>  

                        <tr>
                            <th>@lang('descuentos:')</th>
                            <td field-key='user'>{{ $descuento->descuentos or '0' }}</td>
                        </tr>  

                        <tr>
                            <th>@lang('adelantos:')</th>
                            <td field-key='user'>{{ $descuento->adelantos or '0' }}</td>
                        </tr>  


                    </table>
                </div>
            </div>
            <p>&nbsp;</p>

            <a href="{{ route('admin.descuentos.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
