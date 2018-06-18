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