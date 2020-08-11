<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

$this->get('invitation/{invitation_token}', 'Auth\RegisterController@processInvitation')->name('auth.invitation');

Route::group(['middleware' => ['auth', 'check_invitation'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

    Route::resource('baths', 'Admin\BathsController');
    Route::post('baths_mass_destroy', ['uses' => 'Admin\BathsController@massDestroy', 'as' => 'baths.mass_destroy']);
    Route::post('baths_restore/{id}', ['uses' => 'Admin\BathsController@restore', 'as' => 'baths.restore']);
    Route::delete('baths_perma_del/{id}', ['uses' => 'Admin\BathsController@perma_del', 'as' => 'baths.perma_del']);
    
    Route::resource('area_workers', 'Admin\Area_workersController');
    Route::post('area_workers_mass_destroy', ['uses' => 'Admin\Area_workersController@massDestroy', 'as' => 'area_workers.mass_destroy']);
    Route::post('area_workers_restore/{id}', ['uses' => 'Admin\Area_workersController@restore', 'as' => 'area_workers.restore']);
    Route::delete('area_workers_perma_del/{id}', ['uses' => 'Admin\Area_workersController@perma_del', 'as' => 'area_workers.perma_del']);
    
    Route::resource('subarea_workers', 'Admin\Subarea_workersController');
    Route::post('subarea_workers_mass_destroy', ['uses' => 'Admin\Subarea_workersController@massDestroy', 'as' => 'subarea_workers.mass_destroy']);
    Route::post('subarea_workers_restore/{id}', ['uses' => 'Admin\Subarea_workersController@restore', 'as' => 'subarea_workers.restore']);
    Route::delete('subarea_workers_perma_del/{id}', ['uses' => 'Admin\Subarea_workersController@perma_del', 'as' => 'subarea_workers.perma_del']);

    Route::resource('subarea_area_workers', 'Admin\Subarea_area_workersController');
    Route::post('subarea_area_workers_mass_destroy', ['uses' => 'Admin\Subarea_area_workersController@massDestroy', 'as' => 'subarea_area_workers.mass_destroy']);
    Route::post('subarea_area_workers_restore/{id}', ['uses' => 'Admin\Subarea_area_workersController@restore', 'as' => 'subarea_area_workers.restore']);
    Route::delete('subarea_area_workers_perma_del/{id}', ['uses' => 'Admin\Subarea_area_workersController@perma_del', 'as' => 'subarea_area_workers.perma_del']);

    Route::resource('bathsusers', 'Admin\BathsusersController');
    Route::post('bathsusers_mass_destroy', ['uses' => 'Admin\BathsusersController@massDestroy', 'as' => 'bathsusers.mass_destroy']);
    Route::post('bathsusers_restore/{id}', ['uses' => 'Admin\BathsusersController@restore', 'as' => 'bathsusers.restore']);
    Route::delete('bathsusers_perma_del/{id}', ['uses' => 'Admin\BathsusersController@perma_del', 'as' => 'bathsusers.perma_del']);
    
    Route::resource('employees', 'Admin\EmployeesController');
    Route::post('employees_mass_destroy', ['uses' => 'Admin\EmployeesController@massDestroy', 'as' => 'employees.mass_destroy']);
    Route::post('employees_restore/{id}', ['uses' => 'Admin\EmployeesController@restore', 'as' => 'employees.restore']);
    Route::delete('employees_perma_del/{id}', ['uses' => 'Admin\EmployeesController@perma_del', 'as' => 'employees.perma_del']);
    
    Route::resource('job_titles', 'Admin\Job_titlesController');
    Route::post('job_titles_mass_destroy', ['uses' => 'Admin\Job_titlesController@massDestroy', 'as' => 'job_titles.mass_destroy']);
    Route::post('job_titles_restore/{id}', ['uses' => 'Admin\Job_titlesController@restore', 'as' => 'job_titles.restore']);
    Route::delete('job_titles_perma_del/{id}', ['uses' => 'Admin\Job_titlesController@perma_del', 'as' => 'job_titles.perma_del']);

    Route::resource('workers', 'Admin\WorkersController');
    Route::post('workers_mass_destroy', ['uses' => 'Admin\WorkersController@massDestroy', 'as' => 'workers.mass_destroy']);
    Route::post('workers_restore/{id}', ['uses' => 'Admin\WorkersController@restore', 'as' => 'workers.restore']);
    Route::delete('workers_perma_del/{id}', ['uses' => 'Admin\WorkersController@perma_del', 'as' => 'workers.perma_del']);

    Route::resource('pensions', 'Admin\PensionsController');
    Route::post('pensions_mass_destroy', ['uses' => 'Admin\PensionsController@massDestroy', 'as' => 'pensions.mass_destroy']);
    Route::post('pensions_restore/{id}', ['uses' => 'Admin\PensionsController@restore', 'as' => 'pensions.restore']);
    Route::delete('pensions_perma_del/{id}', ['uses' => 'Admin\PensionsController@perma_del', 'as' => 'pensions.perma_del']);

    Route::resource('ingresos', 'Admin\IngresosController');
    Route::post('ingresos_mass_destroy', ['uses' => 'Admin\IngresosController@massDestroy', 'as' => 'ingresos.mass_destroy']);
    Route::post('ingresos_restore/{id}', ['uses' => 'Admin\IngresosController@restore', 'as' => 'ingresos.restore']);
    Route::delete('ingresos_perma_del/{id}', ['uses' => 'Admin\IngresosController@perma_del', 'as' => 'ingresos.perma_del']);
    
    Route::resource('asistencias', 'Admin\AsistenciasController');
    Route::post('asistencias_mass_destroy', ['uses' => 'Admin\AsistenciasController@massDestroy', 'as' => 'asistencias.mass_destroy']);
    Route::post('asistencias_restore/{id}', ['uses' => 'Admin\AsistenciasController@restore', 'as' => 'asistencias.restore']);
    Route::delete('asistencias_perma_del/{id}', ['uses' => 'Admin\AsistenciasController@perma_del', 'as' => 'asistencias.perma_del']);

    Route::resource('descuentos', 'Admin\DescuentosController');
    Route::post('descuentos_mass_destroy', ['uses' => 'Admin\DescuentosController@massDestroy', 'as' => 'descuentos.mass_destroy']);
    Route::post('descuentos_restore/{id}', ['uses' => 'Admin\DescuentosController@restore', 'as' => 'descuentos.restore']);
    Route::delete('descuentos_perma_del/{id}', ['uses' => 'Admin\DescuentosController@perma_del', 'as' => 'descuentos.perma_del']);

    Route::resource('ingresos_extras', 'Admin\Ingresos_extrasController');
    Route::post('ingresos_extras_mass_destroy', ['uses' => 'Admin\Ingresos_extrasController@massDestroy', 'as' => 'ingresos_extras.mass_destroy']);
    Route::post('ingresos_extras_restore/{id}', ['uses' => 'Admin\Ingresos_extrasController@restore', 'as' => 'ingresos_extras.restore']);
    Route::delete('ingresos_extras_perma_del/{id}', ['uses' => 'Admin\Ingresos_extrasController@perma_del', 'as' => 'ingresos_extras.perma_del']);

    Route::resource('manifests', 'Admin\ManifestsController');
    Route::post('manifests_mass_destroy', ['uses' => 'Admin\ManifestsController@massDestroy', 'as' => 'manifests.mass_destroy']);
    Route::post('manifests_restore/{id}', ['uses' => 'Admin\ManifestsController@restore', 'as' => 'manifests.restore']);
    Route::delete('manifests_perma_del/{id}', ['uses' => 'Admin\ManifestsController@perma_del', 'as' => 'manifests.perma_del']);

    Route::resource('customer_addresses', 'Admin\Customer_addressesController');
    Route::post('customer_addresses_mass_destroy', ['uses' => 'Admin\Customer_addressesController@massDestroy', 'as' => 'customer_addresses.mass_destroy']);
    Route::post('customer_addresses_restore/{id}', ['uses' => 'Admin\Customer_addressesController@restore', 'as' => 'customer_addresses.restore']);
    Route::delete('customer_addresses_perma_del/{id}', ['uses' => 'Admin\Customer_addressesController@perma_del', 'as' => 'customer_addresses.perma_del']);

    Route::resource('manifestcustomers', 'Admin\ManifestCustomersController');
    Route::post('manifestcustomers_mass_destroy', ['uses' => 'Admin\ManifestCustomersController@massDestroy', 'as' => 'manifestcustomers.mass_destroy']);
    Route::post('manifestcustomers_restore/{id}', ['uses' => 'Admin\ManifestCustomersController@restore', 'as' => 'manifestcustomers.restore']);
    Route::delete('manifestcustomers_perma_del/{id}', ['uses' => 'Admin\ManifestCustomersController@perma_del', 'as' => 'manifestcustomers.perma_del']);

    Route::resource('document_types', 'Admin\Document_typesController');
    Route::post('document_types_mass_destroy', ['uses' => 'Admin\Document_typesController@massDestroy', 'as' => 'document_types.mass_destroy']);
    Route::post('document_types_restore/{id}', ['uses' => 'Admin\Document_typesController@restore', 'as' => 'document_types.restore']);
    Route::delete('document_types_perma_del/{id}', ['uses' => 'Admin\Document_typesController@perma_del', 'as' => 'document_types.perma_del']);

    Route::resource('sectors', 'Admin\SectorsController');
    Route::post('sectors_mass_destroy', ['uses' => 'Admin\SectorsController@massDestroy', 'as' => 'sectors.mass_destroy']);
    Route::post('sectors_restore/{id}', ['uses' => 'Admin\SectorsController@restore', 'as' => 'sectors.restore']);
    Route::delete('sectors_perma_del/{id}', ['uses' => 'Admin\SectorsController@perma_del', 'as' => 'sectors.perma_del']);
    
    Route::resource('tenants', 'Admin\TenantsController');
});
