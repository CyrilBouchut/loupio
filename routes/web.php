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

Route::get('/', function () {
    return view('welcome');
});
    Route::get('tiers', 'TiersController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Utilisateur
Route::get('users', 'UsersController@index');
Route::get('newUser', 'UsersController@new');
Route::post('editUser/{id}', 'UsersController@postEdit')->where('id', '[0-9]+');
Route::get('editUser/{id}', 'UsersController@getEdit')->where('id', '[0-9]+');
//Exercices
Route::get('exercice/{type}', 'ExerciceController@getExercice');
Route::post('exercice/{type}', 'ExerciceController@postExercice');

//listeQuestions
Route::get('listeQuestions', 'QuestionsController@index');
Route::get('newQuestions', 'QuestionsController@new');
Route::post('editQuestions/{id}', 'QuestionsController@postEdit')->where('id', '[0-9]+');
Route::get('editQuestions/{id}', 'QuestionsController@getEdit')->where('id', '[0-9]+');

/*Route::get('file-upload', 'FileUploadController@fileUpload')->name('file.upload');

Route::post('file-upload', 'FileUploadController@fileUploadPost')->name('file.upload.post');*/



