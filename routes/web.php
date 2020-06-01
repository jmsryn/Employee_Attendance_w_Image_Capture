<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/timein', 'TimesheetController@timein');
Route::get('/timeout', 'TimesheetController@timeout');
Route::get('/capture', 'TimesheetController@index');
Route::post('/capture', 'TimesheetController@idnum_check');
Route::get('/capture/select/{id}', 'TimesheetController@capture_select');
Route::get('/capture/timein/{id}', 'TimesheetController@timein');
Route::post('/capture/timein', 'TimesheetController@timein_store');
// Route::get('/capture/timeout', 'TimesheetController@index');

// Route::get('/superadminadd', 'SuperAdminPageController@superadminadd');
// Route::post('/superadminadd', 'SuperAdminPageController@store');


Route::group(['middleware' => ['auth', 'user']], function() {
    ###EmployeeSide
    Route::get('/dashboard', 'EmployeePageController@dashboard');
    Route::get('/leave', 'EmployeePageController@leave');
    Route::post('/leave', 'EmployeePageController@leave_store');
    Route::get('/under', 'EmployeePageController@under');
    Route::post('/under', 'EmployeePageController@under_store');
    Route::get('/over', 'EmployeePageController@over');
    Route::post('/over', 'EmployeePageController@over_store');
    Route::get('/notification', 'EmployeePageController@notification');
    Route::post('/notification/{type}/{id}', 'EmployeePageController@notif_update');
    Route::get('/archive', 'EmployeePageController@archive');
    Route::get('/archive/{emp_id}/{id}', 'EmployeePageController@archive_view');
    
    ###Supadmin
    Route::get('/superadmindashboard', 'SuperAdminPageController@superadmindashboard');
    Route::get('/superadminprofile/{emp_id}', 'SuperAdminPageController@superadminprofile');
    Route::post('/superadminprofile', 'SuperAdminPageController@emp_profile_update');
    Route::get('/superadmintime/{id}', 'SuperAdminPageController@superadmintime');
    Route::post('/superadmintime', 'SuperAdminPageController@update_timesheet');
    Route::get('/superadminadd', 'SuperAdminPageController@superadminadd');
    Route::post('/superadminadd', 'SuperAdminPageController@store');
    Route::get('/superadminapp/{id}', 'SuperAdminPageController@superadminapp');
    Route::get('/superadminviewapp', 'SuperAdminPageController@superadminviewapp');
    Route::get('/leave_view/{emp_id}/{leave_id}', 'SuperAdminPageController@leave_view');
    Route::post('/leave_view', 'SuperAdminPageController@update_leave');
    Route::get('/overtime_view/{emp_id}/{overtime_id}', 'SuperAdminPageController@overtime_view');
    Route::post('/overtime_view', 'SuperAdminPageController@update_overtime');
    Route::get('/undertime_view/{emp_id}/{undertime_id}', 'SuperAdminPageController@undertime_view');
    Route::post('/undertime_view', 'SuperAdminPageController@update_undertime');
    
    ###Admin
    Route::get('/admindashboard', 'AdminPageController@index');
    Route::get('/admintime/{id}', 'AdminPageController@admintime');
    Route::post('/admintime', 'AdminPageController@update_timesheet');
    Route::get('/adminapp/{id}', 'AdminPageController@adminapp');
    Route::get('/admin/leave_view/{emp_id}/{leave_id}', 'AdminPageController@leave_view');
    Route::post('/admin/leave_view', 'AdminPageController@update_leave');
    Route::get('/admin/undertime_view/{emp_id}/{undertime_id}', 'AdminPageController@undertime_view');
    Route::post('/admin/undertime_view', 'AdminPageController@update_undertime');
    Route::get('/admin/overtime_view/{emp_id}/{overtime_id}', 'AdminPageController@overtime_view');
    Route::post('/admin/overtime_view', 'AdminPageController@update_overtime');
    Route::get('/admin/application_leave', 'AdminPageController@app_leave');
    Route::get('/admin/application_leave/view/{emp_id}/{leave_id}', 'AdminPageController@app_leave_respond');
    Route::post('/admin/application_leave', 'AdminPageController@leave_update');
    Route::get('/admin/application_undertime', 'AdminPageController@app_under');
    Route::get('/admin/application_undertime/view/{emp_id}/{undertime_id}', 'AdminPageController@app_under_respond');
    Route::post('/admin/application_undertime', 'AdminPageController@under_update');
    Route::get('/admin/application_overtime', 'AdminPageController@app_over');
    Route::get('/admin/application_overtime/view/{emp_id}/{overtime_id}', 'AdminPageController@app_over_respond');
    Route::post('/admin/application_overtime', 'AdminPageController@over_update');
});