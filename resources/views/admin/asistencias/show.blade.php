@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Asistencia del Trabajador')</h3>

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
                            <td field-key='property'>{{ $asistencia->created_at or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Trabajador:')</th>
                            <td field-key='nombre_del_trabajador'>{{ $asistencia->worker->nombre_del_trabajador or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Dias de vacaciones:')</th>
                            <td field-key='dias_vacaciones'>{{ $asistencia->dias_vacaciones or '0' }}</td>
                        </tr>

                        <tr>
                            <th>@lang('Descanso medico:')</th>
                            <td field-key='descanso_medico'>{{ $asistencia->descanso_medico or '0' }}</td>
                        </tr>


                        <tr>
                            <th>@lang('Horas extra 25%:')</th>
                            <td field-key='horas_extra_25'>{{ $asistencia->horas_extra_25 or '0' }}</td>
                        </tr>  

                        <tr>
                            <th>@lang('Horas extra 35%:')</th>
                            <td field-key='horas_extra_35'>{{ $asistencia->horas_extra_35 or '0' }}</td>
                        </tr>  

                        <tr>
                            <th>@lang('Horas extra 100%:')</th>
                            <td field-key='horas_extra_100'>{{ $asistencia->horas_extra_100 or '0' }}</td>
                        </tr>  


                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.asistencias.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
