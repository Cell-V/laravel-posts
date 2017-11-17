<?php

namespace CellV\LaravelPosts\Http\Requests;

use Auth;
use CellV\LaravelPosts\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		$post = $this->post;

		return Auth::check() && $post && $post->user_id==$this->user()->getKey();//$this->user()->can('update', $post);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'title' => 'required',
			'body' => 'required',
		];
	}
}
