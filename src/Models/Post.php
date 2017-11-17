<?php

namespace CellV\LaravelPosts\Models;

use Dimsav\Translatable\Translatable;

// use Cviebrock\EloquentTaggable\Taggable;
// use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Tags\HasTags;
use ThyagoBrejao\Commentable\Traits\Commentable;

class Post extends Model {
	use HasTags;
	use LogsActivity;
	use Commentable;

	// use Taggable;
	use Translatable;

	public $translatedAttributes = ['title', 'body'];
	
	protected $fillable = [
		// 'title',
		// 'body',
		'tags',
		// 'online',
	];

	// LogsActivity properties
	protected static $logAttributes = ['title', 'body'];

	/*
		 * Relationships
	*/

	public function user() {
		return $this->belongsTo('App\User');
	}
}
