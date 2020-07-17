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

use Illuminate\Support\Facades\Auth;


Route::get('/', "QuestionsController@index");

Auth::routes(['verify' => true]);

Route::middleware('verified')->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');
//questions
    Route::resource('questions' ,'QuestionsController')->except('show' , 'index');

//answers
    Route::resource('questions.answers', "AnswersController")->except(['show' , 'create']);
//accept-best-answer
    Route::post('/answers/{answer}/accept', "AcceptAnswer")->name('answers.accept');
//favorites
    Route::post('/questions/{question}/favorites', "FavoritesController@store")->name('questions.favorite');
//delete-favorites
    Route::delete('/questions/{question}/favorites', "FavoritesController@destroy")->name('questions.unfavorite');
//vote-question
    Route::post('/questions/{question}/vote', "VoteQuestionController");
//vote-answer
    Route::post('/answers/{answer}/vote', "VoteAnswersController");
});

//show-question
Route::get('/questions/{slug}', "QuestionsController@show")->name('questions.show');
Route::get('/questions' ,'QuestionsController@index')->name('questions.index');
