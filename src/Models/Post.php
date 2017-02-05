<?php

namespace CellV\LaravelPosts\Models;

use Illuminate\Database\Eloquent\Model;

// use Cviebrock\EloquentTaggable\Taggable;
// use Cviebrock\EloquentSluggable\Sluggable;
// use Dimsav\Translatable\Translatable;

use Spatie\Tags\HasTags;

class Post extends Model
{
  use HasTags;
    // use Taggable;
    // use Translatable;

    // public $translatedAttributes = ['title', 'body'];
    //
    // protected $fillable = [
    //   // 'title',
    //   // 'body'
    //   'online'
    // ];


}
