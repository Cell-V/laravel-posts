<?php

namespace CellV\LaravelPosts\Models;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model {
	public $timestamps = false;
	protected $fillable = [
		'title',
		'body',
		// 'online',
	];
}
