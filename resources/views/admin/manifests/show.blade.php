@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Documento')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('Tipo de documento:')</th>
                            <td field-key='document_type'>{{$manifest->document_type->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Cliente:')</th>
                            <td field-key='manifestcustomer'>{{ $manifest->manifestcustomer->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Fecha de recojo:')</th>
                            <td field-key='pick_date'>{{ $manifest->pick_date or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Adjunto:')</th>
                            <td field-key='attached'>@if($manifest->attached)<a href="{{ asset(env('UPLOAD_PATH').'/' . $manifest->attached) }}" target="_blank">Descargar</a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.manifests.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
