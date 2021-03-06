<?php

/*
 * Posts Routes
 */
Route::get('user/posts', function () {
	dd('user.post');
})->name('user.post');

Route::get('post/s/{slug}', '\CellV\LaravelPosts\Http\Controllers\PostsController@showBySlug')
	->where('name', '[A-Za-z]+')
	->name('post.showBySlug');

Route::resource('post', '\CellV\LaravelPosts\Http\Controllers\PostsController', ['parameters' => [
	// 'post' => 'id',
]]);
