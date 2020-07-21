@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('permission_access')
                <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('Permisos')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('Roles')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('Usuarios')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('administrador')

                <li class="{{ $request->segment(2) == 'bath' ? 'active' : '' }}">
                    <a href="{{ route('admin.baths.index') }}">
                        <i class="fa fa-gears"></i>
                        <span class="title">@lang('Baños')</span>
                    </a>
                </li>
                
                <li class="{{ $request->segment(2) == 'employee' ? 'active' : '' }}">
                    <a href="{{ route('admin.employees.index') }}">
                        <i class="fa fa-gears"></i>
                        <span class="title">@lang('Empleados')</span>
                    </a>
                </li>



            @endcan
            
            @can('publico')

            <li class="{{ $request->segment(2) == 'bathsusers' ? 'active' : '' }}">
                <a href="{{ route('admin.bathsusers.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('Baños Atendidos')</span>
                </a>
            </li>

            @endcan


            @can('planilla')

            <li class="{{ $request->segment(2) == 'workers' ? 'active' : '' }}">
                <a href="{{ route('admin.workers.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('Trabajadores')</span>
                </a>
            </li>

            @endcan

            @can('planilla')
            <li class="{{ $request->segment(2) == 'job_titles' ? 'active' : '' }}">
                <a href="{{ route('admin.job_titles.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('Cargo Trabajador')</span>
                </a>
            </li>

            @endcan
            
            @can('planilla')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('Area / Sub-Area')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('planilla')
                <li class="{{ $request->segment(2) == 'area_workers' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.area_workers.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('Area Trabajo')
                            </span>
                        </a>
                    </li>
                @endcan

                @can('planilla')
                <li class="{{ $request->segment(2) == 'subarea_workers' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.subarea_workers.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('Sub Area Trabajo')
                            </span>
                        </a>
                    </li>
                @endcan

                </ul>
            </li>
            @endcan




            @can('planilla')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('Seguros')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                

                @can('planilla')
                <li class="{{ $request->segment(2) == 'pensions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.pensions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('Pensiones')
                            </span>
                        </a>
                    </li>
                @endcan

                </ul>
            </li>
            @endcan


            @can('planilla')
            <li class="{{ $request->segment(2) == 'ingresos' ? 'active' : '' }}">
                <a href="{{ route('admin.ingresos.index') }}">
                    <i class="fa fa-gears"></i> 
                    <span class="title">@lang('Ingresos Trabajadores')</span>
                </a>
            </li>
            @endcan

            @can('planilla')
            <li class="{{ $request->segment(2) == 'asistencias' ? 'active' : '' }}">
                <a href="{{ route('admin.asistencias.index') }}">
                    <i class="fa fa-gears"></i> 
                    <span class="title">@lang('Asistencia Trabajadores')</span>
                </a>
            </li>
            @endcan

            @can('planilla')
            <li class="{{ $request->segment(2) == 'descuentos' ? 'active' : '' }}">
                <a href="{{ route('admin.descuentos.index') }}">
                    <i class="fa fa-gears"></i> 
                    <span class="title">@lang('Descuentos Trabajadores')</span>
                </a>
            </li>
            @endcan

            @can('planilla')
            <li class="{{ $request->segment(2) == 'ingresos_extras' ? 'active' : '' }}">
                <a href="{{ route('admin.ingresos_extras.index') }}">
                    <i class="fa fa-gears"></i> 
                    <span class="title">@lang('Ingresos Extra Trabajadores')</span>
                </a>
            </li>
            @endcan

            @can('administrador')
                <li class="{{ $request->segment(2) == 'customer_addresses' ? 'active' : '' }}">
                    <a href="{{ route('admin.customer_addresses.index') }}">
                        <i class="fa fa-gears"></i> 
                        <span class="title">@lang('Direcciones')</span>
                    </a>
                </li>
        
                <li class="{{ $request->segment(2) == 'manifestcustomer' ? 'active' : '' }}">
                    <a href="{{ route('admin.manifestcustomers.index') }}">
                        <i class="fa fa-gears"></i>
                        <span class="title">@lang('Clientes')</span>
                    </a>
                </li>
                
                <li class="{{ $request->segment(2) == 'document_type' ? 'active' : '' }}">
                    <a href="{{ route('admin.document_types.index') }}">
                        <i class="fa fa-gears"></i>
                        <span class="title">@lang('Tipo de Documento')</span>
                    </a>
                </li>

            @endcan

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

