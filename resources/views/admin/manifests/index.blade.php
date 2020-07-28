@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Documentos')</h3>
    @can('manifiestos')
    <p>
        <a href="{{ route('admin.manifests.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan
    @can('manifiestos')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.manifests.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.manifests.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
            
        </div>

        <form action="" method="GET">
            <div class="row input-daterange">
                <div class="col-md-4">
                    <input type="date" name="from" class="form-control" placeholder="from"/>
                </div>
                <div class="col-md-4">
                    <input type="date" name="to" class="form-control" placeholder="to"/>
                </div>
                <div class="col-md-4">
                    <button type="submit" name="filter" id="filter" class="btn btn-primary">Buscar</button>

                </div>
            </div>
        </form>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($manifests) > 0 ? 'datatable' : '' }} @can('manifiestos') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('manifiestos')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan
                        <th>@lang('Tipo de Documento')</th>
                        <th>@lang('Cliente')</th>
                        <th>@lang('Fecha de recojo')</th>
                        <th>@lang('Adjunto')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($manifests) > 0)
                        @foreach ($manifests as $manifest)
                            <tr data-entry-id="{{ $manifest->id }}">
                                @can('manifiestos')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan
                                 <td field-key='document_type'>{{ $manifest->document_typesname}}</td>
                                 <td field-key='manifestcustomer'>{{ $manifest->manifest_customersname }}</td>
                                 <td field-key='pick_date'>{{ $manifest->pick_date }}</td>
                                 <td field-key='attached'>@if($manifest->attached)<a href="{{ asset(env('UPLOAD_PATH').'/' . $manifest->attached) }}" target="_blank">Descargar</a>@endif</td>

                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.manifests.restore', $manifest->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.manifests.perma_del', $manifest->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('manifiestos_cliente')
                                    <a href="{{ route('admin.manifests.show',[$manifest->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('manifiestos')
                                    <a href="{{ route('admin.manifests.edit',[$manifest->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('manifiestos')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.manifests.destroy', $manifest->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('manifiestos')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.manifests.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection