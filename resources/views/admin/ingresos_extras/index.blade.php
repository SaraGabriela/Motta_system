@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Ingresos Extras Contrables')</h3>
    @can('planilla')
    <p>
        <a href="{{ route('admin.ingresos_extras.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.ingresos_extras.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.ingresos_extras.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>

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
            <table class="table table-bordered table-striped {{ count($ingresos_extras) > 0 ? 'datatable' : '' }} @can('planilla') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('planilla')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('Fecha')</th>
                        <th>@lang('Nombre')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($ingresos_extras) > 0)
                        @foreach ($ingresos_extras as $ingresos_extra)
                            <tr data-entry-id="{{ $ingresos_extra->id }}">
                                @can('planilla')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan


                                 <td field-key='name'>{{ $ingresos_extra->created_at }}</td>
                                 <td field-key='name'>{{ $ingresos_extra->worker->nombre_del_trabajador }}</td>

                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.ingresos_extras.restore', $ingresos_extra->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.ingresos_extras.perma_del', $ingresos_extra->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('planilla')
                                    <a href="{{ route('admin.ingresos_extras.show',[$ingresos_extra->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('planilla')
                                    <a href="{{ route('admin.ingresos_extras.edit',[$ingresos_extra->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('planilla')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.ingresos_extras.destroy', $ingresos_extra->id])) !!}
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
        @can('planilla')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.ingresos_extras.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection