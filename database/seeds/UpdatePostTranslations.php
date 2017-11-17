<?php

use CellV\LaravelPosts\Models\Post;
use Illuminate\Database\Seeder;

class UpdatePostTranslations extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$missingTranslationPosts = CellV\LaravelPosts\Models\Post::doesntHave('translations')->get();
		$missingTranslationPosts->map(function ($post) {
			return $post->update(['body' => $post->getOriginal('body'), 'title' => $post->getOriginal('title')]);
		});
	}
}
