@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Trabajador')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">

                        <tr>
                            <th>@lang('Nombre Trabajador:')</th>
                            <td field-key='code_qr'>{{ $worker->nombre_del_trabajador}}</td>
                        </tr>

                        <tr>
                             <th>@lang('Numero Documento:')</th>
                            <td field-key='company'>{{ $worker->documento_indentificacion }}</td>
                        </tr>
                        
                        <tr>
                             <th>@lang('Total de dias pagados:')</th>
                            <td field-key='company'>{{ $worker->total_dias_pagado }}</td>
                        </tr>

                        <tr>
                             <th>@lang('Banco:')</th>
                            <td field-key='company'>{{ $worker->banco }}</td>
                        </tr>
                        <tr>
                             <th>@lang('CUSSP:')</th>
                            <td field-key='company'>{{ $worker->cussp }}</td>
                        </tr>
                        <tr>
                             <th>@lang('Cuenta Sueldo:')</th>
                            <td field-key='company'>{{ $worker->cuenta_sueldo }}</td>
                        </tr>
                        <tr>
                             <th>@lang('Cuenta Interbancaria:')</th>
                            <td field-key='company'>{{ $worker->cuenta_interbancaria }}</td>
                        </tr>
                        <tr>
                             <th>@lang('Cuenta Viaticos:')</th>
                            <td field-key='company'>{{ $worker->cuenta_viaticos }}</td>
                        </tr>
                        <tr>
                             <th>@lang('Fecha Ingreso:')</th>
                            <td field-key='company'>{{ $worker->fecha_de_ingreso }}</td>
                        </tr>
                        <tr>
                             <th>@lang('Fecha Cese:')</th>
                            <td field-key='company'>{{ $worker->fecha_de_cese }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->


            <p>&nbsp;</p>

            <a href="{{ route('admin.workers.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
