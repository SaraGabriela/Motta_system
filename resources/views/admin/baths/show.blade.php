@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Baño')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">

                        <tr>
                             <th>@lang('Codigo Baño')</th>
                            <td field-key='code_qr'>{{ $bath->code_qr }}</td>
                        </tr>
                        <tr>
                             <th>@lang('Compañia')</th>
                            <td field-key='company'>{{ $bath->company }}</td>
                        </tr>
                        <div class="title m-b-md">
                        <th>@lang('Codigo QR')</th>
                        <td field-key='condigo_qr'><img src='data:image/png;base64, {!! base64_encode(QrCode::format("png")->size(200)->generate("$bath->code_qr")) !!} '></td>                        
                       
                        </div>
                    </table>
                </div>
            </div><!-- Nav tabs -->


            <p>&nbsp;</p>

            <a href="{{ route('admin.baths.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
