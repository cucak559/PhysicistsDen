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

Auth::routes();


//Article Routes
Route::get('/articles/all/{group?}', 'ArticleController@index');
Route::get('/articles/bytag/{tag}', 'TagController@index');
Route::get('/articles/archive', 'ArticleController@archive');


Route::get('/articles/create/{topic?}', 'ArticleController@create');

Route::get('/articles/show/{article}', 'ArticleController@show');
Route::get('/articles/edit/{article}', 'ArticleController@edit');

Route::post('/{topic}/articles/store', 'ArticleController@store');
Route::patch('/articles/{article}', 'ArticleController@update');
Route::delete('/articles/{article}', 'ArticleController@destroy');

Route::get('/articles/search', 'ArticleController@search');

Route::post('/articles/show/{article}/watch', 'ArticleWatcherController@store');
Route::delete('/articles/show/{article}/watch', 'ArticleWatcherController@destroy');



//Topic Routes
Route::get('/topics/all/{group?}', 'TopicController@index');
Route::get('/topics/create/{group?}', 'TopicController@create');
Route::get('/{topic}/show', 'TopicController@show');
Route::get('/{topic}/edit', 'TopicController@edit');

Route::post('/topics/store/{group?}', 'TopicController@store');
Route::patch('/{topic}/update', 'TopicController@update');
Route::delete('/{topic}/delete', 'TopicController@destroy');

//Comment Routes
Route::get('/comments/{comment}/edit', 'CommentController@edit');

Route::get('/articles/show/{article}/comments', 'CommentController@index');

Route::post('/articles/show/{article}/comments', 'CommentController@storeArticle');
Route::patch('/comments/{comment}/update', 'CommentController@update');
Route::delete('/comments/{comment}/delete', 'CommentController@destroy');

//Groupes Routes
Route::get('/groups', 'GroupController@index');
Route::get('/groups/{group}', 'GroupController@show');
Route::get('/groups/{group}/members', 'GroupController@members');
Route::get('/groups/{group}/aplicants', 'GroupController@aplicants');

Route::post('/groups', 'GroupController@store');
Route::post('/groups/{group}/invite/{aplicant}', 'GroupController@invite');
Route::delete('/groups/{group}', 'GroupController@delete');

Route::get('/{group}/aplicants', 'AplicantController@index');
Route::post('/{group}/aplicants', 'AplicantController@store');

//Rating Routes
Route::post('/{article}/like', 'LikeController@store');
Route::post('/{article}/dislike', 'DislikeController@store');

//Favourites Routes
Route::get('/favourites', 'FavouriteController@index');
Route::post('favourites/{article}', 'FavouriteController@store');
Route::delete('favourites/{article}', 'FavouriteController@destroy');

//User Routes
Route::get('/user/{user}', 'UserController@show');


//API Routes
Route::get('/api/users', 'Api\UsersController@index');
Route::get('/api/user/notifications', 'Api\UserNotificationsController@index');
Route::post('/api/users/{user}/avatar', 'Api\UserAvatarController@store');
Route::delete('/api/user/notifications/{notification}', 'Api\UserNotificationsController@destroy');





