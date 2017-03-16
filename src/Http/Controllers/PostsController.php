<?php

namespace CellV\LaravelPosts\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use CellV\LaravelPosts\Http\Requests\StorePostRequest;
use CellV\LaravelPosts\Models\Post;
use Gate;
use Illuminate\Http\Request;

class PostsController extends Controller {

	public function __construct() {
		$this->middleware('web');

		Gate::define('update-post', function ($user, $post) {
			// dump($user, $post);
			// if (!$user) {
			// 	if (!Auth::check()) {
			// 		return false;
			// 	}
			// 	$user = Auth::user();
			// }
			// if ($post->user !== $user) {
			// 	return false;
			// }
			return $user->id == $post->user_id;
			// return true;
		});
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		// dd(get_class($this).'->index()');
		$posts = Post::all();
		return view('LaravelPosts::index')
			->with('posts', $posts)
		;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		// dd(get_class($this).'->create()');
		return view('LaravelPosts::create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StorePostRequest $request) {
		// dump($request->input());
		// dump($request->has('online'));
		// dd(get_class($this).'->store()');
		// $post = new Post;

		// $post->title = $request->title;
		// $post->body = $request->body;

		try {
			$post = Post::create($request->only(['title', 'body']));
		} catch (Exception $e) {
			if ($request->isAjax()) {
				return response()->json(['error' => $e]);
			}
			return abort(500);
		}

		// if ($request->has('online')) $post->online = $request->online;

		$post->slug = str_slug($request->title);

		$post->user()->associate(Auth::user());

		$post->save();

		// add tags
		$post->tags($request->tags);

		// foreach (array_flatten(config('translatable.locales')) as $locale) {
		//     $post->translateOrNew($locale)->title = "{$request->title} {$locale}";
		//     $post->translateOrNew($locale)->body = "{$request->body} {$locale}";
		// }

		$post->save();

		return $this->index();
		// dump($post);
		//
		// dd(get_class($this).'->store()');
		return response()->redirectTo('home');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	private function showPost(Post $post) {
		// dd(get_class($this) . '->showPost(Post $post)', $post);
		if (!$post) {
			return abort(404);
		}
		return view('LaravelPosts::show')
			->with('post', $post)
		;
	}

	public function showBySlug(String $slug) {
		$post = Post::where('slug', $slug)->first();
		return $this->showPost($post);
	}

	public function show(Post $id) {
		// dd(get_class($this) . '->show(Post $id)', $id);
		// $post = Post::find($id);
		//   dd(get_class($this).'->show()');
		setlocale(LC_TIME, 'it_IT');
		// Carbon::setLocale(config('app.locale'));
		return $this->showPost($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Post $id) {
		// dd(get_class($this).'->edit()');
		return view('LaravelPosts::edit')
			->with('post', $id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(StorePostRequest $request, Post $id) {
		// dd(get_class($this) . '->update(StorePostRequest $request, Post $id)', $request, $id);
		// $post = Post::findOrFail($id);

		if (Gate::denies('update-post', $id)) {
			abort(403);
		}
		// Update Post...
		$id->update($request->all());
		return $this->showPost($id);
		dd(get_class($this) . '->update()');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		dd(get_class($this) . '->destroy()');
	}
}
