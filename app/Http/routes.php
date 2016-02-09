<?php

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth.admin'], function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('words', 'WordController');
    Route::resource('lessons', 'LessonController');
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('categories', 'CategoryController', ['only' => ['index']]);
    Route::resource('words', 'WordController', ['only' => ['index']]);
    Route::resource('lessons', 'LessonController');
    Route::resource('lesson_words', 'LessonWordController');
    Route::get('/exam', [
        'as' => 'exam',
        'uses' => 'LessonWordController@index',
    ]);
    Route::post('/exam', [
        'as' => 'exam',
        'uses' => 'LessonWordController@update',
    ]);
    Route::get('/result/{id}', 'LessonWordController@show');

    Route::get('/', ['as' => 'home', 'uses' => 'UserController@index']);
    Route::get('/home', ['as' => 'home', 'uses' => 'UserController@index']);

    Route::get('/activities', ['as' => 'activities', 'uses' => 'UserController@activities']);

    Route::get('/change-password', ['as' => 'users.change.password', 'uses' => 'UserController@changePassword']);
    Route::patch('/update-password', ['as' => 'users.update.password', 'uses' => 'UserController@updatePassword']);

    Route::get('/users/list', ['as' => 'users.list', 'uses' => 'UserController@listUsers']);
    Route::get('/follow/{id}', ['as' => 'user.follow', 'uses' => 'UserController@followUser']);
    Route::get('/unfollow/{id}', ['as' => 'user.unfollow', 'uses' => 'UserController@unFollowUser']);

    Route::get('/users/edit', ['as' => 'users.edit', 'uses' => 'UserController@edit']);
    Route::patch('/users/update', ['as' => 'users.update', 'uses' => 'UserController@update']);

    Route::get('/users/show/{id}', 'UserController@show');

});
