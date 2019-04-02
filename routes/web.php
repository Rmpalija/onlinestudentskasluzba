<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('auth.login');
Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
Route::post('register', 'Auth\RegisterController@register')->name('auth.register');

Route::group(['middleware' => ['auth', 'approved'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/calendar', 'Admin\SystemCalendarController@index'); 
  
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('ispitis', 'Admin\IspitisController');
    Route::post('ispitis_mass_destroy', ['uses' => 'Admin\IspitisController@massDestroy', 'as' => 'ispitis.mass_destroy']);
    Route::post('ispitis_restore/{id}', ['uses' => 'Admin\IspitisController@restore', 'as' => 'ispitis.restore']);
    Route::delete('ispitis_perma_del/{id}', ['uses' => 'Admin\IspitisController@perma_del', 'as' => 'ispitis.perma_del']);
    Route::resource('fakultetis', 'Admin\FakultetisController');
    Route::post('fakultetis_mass_destroy', ['uses' => 'Admin\FakultetisController@massDestroy', 'as' => 'fakultetis.mass_destroy']);
    Route::post('fakultetis_restore/{id}', ['uses' => 'Admin\FakultetisController@restore', 'as' => 'fakultetis.restore']);
    Route::delete('fakultetis_perma_del/{id}', ['uses' => 'Admin\FakultetisController@perma_del', 'as' => 'fakultetis.perma_del']);
    Route::resource('predmetis', 'Admin\PredmetisController');
    Route::post('predmetis_mass_destroy', ['uses' => 'Admin\PredmetisController@massDestroy', 'as' => 'predmetis.mass_destroy']);
    Route::post('predmetis_restore/{id}', ['uses' => 'Admin\PredmetisController@restore', 'as' => 'predmetis.restore']);
    Route::delete('predmetis_perma_del/{id}', ['uses' => 'Admin\PredmetisController@perma_del', 'as' => 'predmetis.perma_del']);
    Route::resource('profesoris', 'Admin\ProfesorisController');
    Route::post('profesoris_mass_destroy', ['uses' => 'Admin\ProfesorisController@massDestroy', 'as' => 'profesoris.mass_destroy']);
    Route::post('profesoris_restore/{id}', ['uses' => 'Admin\ProfesorisController@restore', 'as' => 'profesoris.restore']);
    Route::delete('profesoris_perma_del/{id}', ['uses' => 'Admin\ProfesorisController@perma_del', 'as' => 'profesoris.perma_del']);
    Route::resource('studentis', 'Admin\StudentisController');
    Route::post('studentis_mass_destroy', ['uses' => 'Admin\StudentisController@massDestroy', 'as' => 'studentis.mass_destroy']);
    Route::post('studentis_restore/{id}', ['uses' => 'Admin\StudentisController@restore', 'as' => 'studentis.restore']);
    Route::delete('studentis_perma_del/{id}', ['uses' => 'Admin\StudentisController@perma_del', 'as' => 'studentis.perma_del']);
    Route::resource('skolarinas', 'Admin\SkolarinasController');
    Route::post('skolarinas_mass_destroy', ['uses' => 'Admin\SkolarinasController@massDestroy', 'as' => 'skolarinas.mass_destroy']);
    Route::post('skolarinas_restore/{id}', ['uses' => 'Admin\SkolarinasController@restore', 'as' => 'skolarinas.restore']);
    Route::delete('skolarinas_perma_del/{id}', ['uses' => 'Admin\SkolarinasController@perma_del', 'as' => 'skolarinas.perma_del']);



 
});
