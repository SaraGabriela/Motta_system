@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Seguro pensiones')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">

                        <tr>
                             <th>@lang('Nombre:')</th>
                            <td field-key='nombre'>{{ $pension->nombre }}</td>
                        </tr>

                        <tr>
                             <th>@lang('Fecha:')</th>
                            <td field-key='fecha'>{{ $pension->fecha }}</td>
                        </tr>

                        <tr>
                             <th>@lang('Obligatorio:')</th>
                            <td field-key='obligatorio'>{{ $pension->obligatorio }}%</td>
                        </tr>

                        <tr>
                             <th>@lang('Seguro:')</th>
                            <td field-key='seguro'>{{ $pension->seguro }}%</td>
                        </tr>

                        <tr>
                             <th>@lang('Variable:')</th>
                            <td field-key='variable'>{{ $pension->variable }}%</td>
                        </tr>

                        <tr>
                             <th>@lang('Estado:')</th>
                            <td field-key='estado'>{{ $pension->estado or 'off'}}</td>
                        </tr>

                    </table>
                </div>
            </div><!-- Nav tabs -->


            <p>&nbsp;</p>

            <a href="{{ route('admin.pensions.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
