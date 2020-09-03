<?php

use App\Comment;
use App\User;
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

Route::get('/', 'TopController@index');

Route::post('/top-10-comments', 'TopController@top10comments')
    ->name('top10comments');

Route::post('/top-n-Comments', 'TopController@topNComments')
    ->name('topNComments');

Route::post('/owners-by-comment-author', 'TopController@ownersByCommentAuthor')
    ->name('ownersByCommentAuthor');

Route::get('/binary', 'BinaryController@index');
Route::get('/binary/convert', 'BinaryController@convert')->name('binary.convert');
