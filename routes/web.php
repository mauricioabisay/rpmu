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

Route::get('/', 'HomeController@home')->name('home');

Route::get('/research/{research?}', 'HomeController@research')->name('research');

Route::get('/researcher/{researcher?}', 'HomeController@researcher')->name('researcher');

Route::get('/faculty/{faculty?}', 'HomeController@faculty')->name('faculty');

Route::get('/degree/{degree?}', 'HomeController@degree')->name('degree');

Route::get('researches', 'ResearchController@index');
Route::get('subjects', 'SubjectController@index');
Route::get('faculties', 'FacultyController@index');
Route::get('degrees', 'DegreeController@index');
Route::get('participants', 'ParticipantController@index');

Route::group(
	[
		'prefix' => 'admin',
		'middleware' => 'user-role',
	], 
	function() {
		Route::resources([
			'users' => 'UserController',
			'researches' => 'ResearchController',
			'subjects' => 'SubjectController',
			'faculties' => 'FacultyController',
			'degrees' => 'DegreeController',
			'participants' => 'ParticipantController',
		]);
	}
);

//For JS

Route::get('api/subjects', function() {
	return App\Subject::whereRaw("title LIKE '%".request()->get('string')."%'")->get();
});

Route::get('api/participants', function() {
	return App\Participant::whereRaw("name LIKE '%".request()->get('string')."%' or id LIKE '".request()->get('string')."%'")->get();
});
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/admin', 'HomeController@index')->name('admin');
Route::get('admin', 'HomeController@index');
Route::post('admin', 'HomeController@login');
Route::post('logout', 'HomeController@logout');