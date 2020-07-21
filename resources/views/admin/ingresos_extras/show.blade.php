@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Ingreso Extra del Trabajador')</h3>

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
                            <td field-key='property'>{{ $ingresos_extra->created_at or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Trabajador:')</th>
                            <td field-key='user'>{{ $ingresos_extra->worker->nombre_del_trabajador or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Bono:')</th>
                            <td field-key='user'>{{ $ingresos_extra->bono or '0' }}</td>
                        </tr>

                        <tr>
                            <th>@lang('Bono sueldo:')</th>
                            <td field-key='user'>{{ $ingresos_extra->bono_sueldo or '0' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Movilidad:')</th>
                            <td field-key='user'>{{ $ingresos_extra->movilidad or '0' }}</td>
                        </tr>   
                    </table>
                </div>
            </div>
            <p>&nbsp;</p>
            <a href="{{ route('admin.ingresos_extras.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
