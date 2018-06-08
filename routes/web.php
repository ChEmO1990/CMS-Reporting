<?php

use App\Models\Report;
use App\Models\AccessReport;

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

Auth::routes();
Route::resource('/', 'Dashboard\DashboardController');
Route::resource('users', 'Users\UserController');
Route::resource('reports', 'Reports\ReportController');
Route::resource('access', 'Access\AccessController');
Route::resource('roles', 'Roles\RoleController');
Route::resource('permissions', 'Permissions\PermissionController');
Route::resource('departaments', 'Departaments\DepartamentController');


Route::get('foo', function () {
	$ids = AccessReport::where('role_id', 161)->pluck('report_id');

	$items = Report::whereIn('report_id', $ids)->get() //Get collection
	->sort() //Sort the result
	->all();

	$single_titles = Report::whereIn('report_id', $ids)->get() //Get collection
	->pluck('departament') //I only need the departament column
	->unique() //Remove duplicate items
	->sort() //Sort the result
	->all();


		$result = Report::where('report_id', $items[1]->report_id)
		->where('departament', 'Human Resources')
		->get();

		var_dump($result);
	
});