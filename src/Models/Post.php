<?php

namespace CellV\LaravelPosts\Models;

use Illuminate\Database\Eloquent\Model;

// use Cviebrock\EloquentTaggable\Taggable;
// use Cviebrock\EloquentSluggable\Sluggable;
// use Dimsav\Translatable\Translatable;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Tags\HasTags;

class Post extends Model {
	use HasTags;
	use LogsActivity;

	// use Taggable;
	// use Translatable;

	// public $translatedAttributes = ['title', 'body'];
	//
	protected $fillable = [
		'title',
		'body',
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
