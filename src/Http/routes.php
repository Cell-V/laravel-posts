<?php

/*
 * Posts Routes
 */

Route::get('user/posts', function () {
	dd('user.post');
})->name('user.post');

Route::get('post/{slug}', '\CellV\LaravelPosts\Http\Controllers\PostsController@showBySlug')->name('post.showBySlug');
Route::resource('post', '\CellV\LaravelPosts\Http\Controllers\PostsController', ['parameters' => [
	'post' => 'id',
]]);
