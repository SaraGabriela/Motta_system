@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Baño')</h3>

    <div class="panel panel-default">
        
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-3">
                    <table class="table table-bordered table-striped">

                        <tr>
                             <th>@lang('Nombre:')</th>
                            <td field-key='nombre'>{{ $area_worker->nombre }}</td>
                        </tr>


                    </table>
                </div>
            </div><!-- Nav tabs -->

            <p>&nbsp;</p>

            <a href="{{ route('admin.area_workers.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
        



    </div>
@stop
