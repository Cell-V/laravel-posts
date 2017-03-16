<?php namespace CellV\LaravelPosts\Traits;

trait hasPostsTrait {
	/*
	 * Relationships
	 */

	public function posts() {
		return $this->hasMany('CellV\LaravelPosts\Models\Post');
	}

}
