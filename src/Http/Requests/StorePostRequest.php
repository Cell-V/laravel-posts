<?php

namespace CellV\LaravelPosts\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {

		// $input = $this->input();
		// $input['tags'] = explode(',', $this->input('tags'));
		// dump('$this->input()', $this->input());
		// $this->replace($input);
		// dump('$this->input()', $this->input());
		return [
			'title' => 'required',
			'body' => 'required',
		];
	}
}
