<?php

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

Route::resource('roles', 'Roles\RoleController');

Route::resource('permissions', 'Permissions\PermissionController');

Route::resource('posts', 'PostController');