@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Ingreso del Trabajador')</h3>

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
                            <td field-key='property'>{{ $ingreso->created_at or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Trabajador:')</th>
                            <td field-key='user'>{{ $ingreso->worker->nombre_del_trabajador or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Remuneración bruta:')</th>
                            <td field-key='user'>{{ $ingreso->bruto or '' }}</td>
                        </tr>

                        <tr>
                            <th>@lang('Remuneración mensual:')</th>
                            <td field-key='user'>
                                <?php
                                if ($ingreso->worker->total_dias_pagado > 15) {
                                    if (30 - $ingreso->worker->total_dias_pagado == 30) {

                                        echo $ingreso->bruto/30*$ingreso->worker->total_dias_pagado; 
                                    }else{
                                        echo $ingreso->bruto-$ingreso->bruto/30*(30-$ingreso->worker->total_dias_pagado);
                                    }
                                }else{
                                    echo $ingreso->bruto/30*$ingreso->worker->total_dias_pagado;
                                }
                            ?>
                            </td>
                        </tr>

                        <tr>
                            <th>@lang('Asignación familiar:')</th>
                            <td field-key='user'>{{ $ingreso->familiar or '0' }}</td>
                        </tr>   

                        <tr>
                            <th>@lang('Remuneración variable:')</th>
                            <td field-key='user'>{{ $ingreso->remuneracion_variable or '0' }}</td>
                        </tr>  

                        <tr>
                            <th>@lang('Bonificación:')</th>
                            <td field-key='user'>{{ $ingreso->bonificacion or '0' }}</td>
                        </tr>  


                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.ingresos.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
