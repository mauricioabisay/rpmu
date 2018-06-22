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

Route::get('/', function () {
    return view('welcome');
});

//CRUD User
Route::get('users', 'AdminController@indexUser');

Route::get('users/create', 'AdminController@createUser');
Route::post('users', 'AdminController@storeUser');

Route::get('users/{user}/edit', 'AdminController@editUser');
Route::put('users/{user}', 'AdminController@updateUser');

Route::delete('users/{user}', 'AdminController@destroyUser');


Route::resource('researches', 'ResearchController');

Route::resources([
	'subjects' => 'SubjectController',
	'faculties' => 'FacultyController',
	'degrees' => 'DegreeController',
	'participants' => 'ParticipantController'
]);


//For JS

Route::get('api/subjects', function() {
	return App\Subject::whereRaw("title LIKE '%".request()->get('string')."%'")->get();
});

Route::get('api/participants', function() {
	return App\Participant::whereRaw("name LIKE '%".request()->get('string')."%' or id LIKE '".request()->get('string')."%'")->get();
});
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/admin', 'HomeController@index')->name('admin');
Route::get('admin', 'HomeController@index');
Route::post('admin', 'HomeController@login');
Route::post('logout', 'HomeController@logout');