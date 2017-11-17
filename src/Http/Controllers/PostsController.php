<?php

namespace CellV\LaravelPosts\Http\Controllers;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Auth;
use CellV\LaravelPosts\Http\Requests\StorePostRequest;
use CellV\LaravelPosts\Http\Requests\UpdatePostRequest;
use CellV\LaravelPosts\Models\Post;
use Gate;
use Illuminate\Http\Request;

class PostsController extends Controller {

	use SEOToolsTrait;

	public function __construct() {
		$this->middleware('web');

		Gate::define('update-post', function ($user, $post) {
			debug($user, $post);
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

		$this->seo()->setTitle('Posts');
		$this->seo()->setDescription('This is my posts page description');
		$this->seo()->opengraph()->setUrl(request()->getUri());
		$this->seo()->opengraph()->addProperty('type', 'articles');
		$this->seo()->twitter()->setSite('@LuizVinicius73');

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
		// dump($request->tags);
		// dump($request->get('tags'));
		// dump($request->only(['title', 'body']));
		// dump($request->get('tags'));
		// dump($request->has('online'));
		// dd(__FILE__ . ' - ' . __LINE__);
		// $post = new Post;

		// $post->title = $request->title;
		// $post->body = $request->body;

		try {
			$post = Post::create($request->only(['title', 'body']));
		} catch (Exception $e) {
			if ($request->ajax()) {
				return response()->json(['error' => $e]);
			}
			return abort(500);
		}

		// if ($request->has('online')) $post->online = $request->online;

		$post->slug = str_slug($request->title);

		$post->user()->associate(Auth::user());

		$post->save();

		// add tags
		// $tags = explode(',', $request->tags);

		// if (count($tags)) {
		// 	$post->attachTag($tags);
		// }

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
	 * @param  int  $post
	 * @return \Illuminate\Http\Response
	 */
	private function showPost(Post $post) {
		// dd(get_class($this) . '->showPost(Post $post)', $post);
		if (!$post) {
			return abort(404);
		}

		$this->seo()->setTitle('Post: ' . $post->title);
		$this->seo()->setDescription('This is my post description: ' . $post->body);
		$this->seo()->opengraph()->setUrl(request()->getUri());
		$this->seo()->opengraph()->addProperty('type', 'articles');
		$this->seo()->twitter()->setSite('@LuizVinicius73');

		return view('LaravelPosts::show')
			->with('post', $post)
		;
	}

	public function showBySlug(String $slug) {
		// dd(get_class($this) . '->showBySlug(String $slug)', $slug);
		$post = Post::where('slug', $slug)->first();
		return $this->showPost($post);
	}

	public function show(Post $post) {
		// dd(get_class($this) . '->show(Post $post)', $post);
		// $post = Post::find($post);
		//   dd(get_class($this).'->show()');
		setlocale(LC_TIME, 'it_IT');
		// Carbon::setLocale(config('app.locale'));
		return $this->showPost($post);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $post
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Post $post) {
		// dd(get_class($this).'->edit()');
		return view('LaravelPosts::edit')
			->with('post', $post);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $post
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdatePostRequest $request, Post $post) {
		// dd(get_class($this) . '->update(StorePostRequest $request, Post $post)', $request, $post);
		// $post = Post::findOrFail($post);

		if (Gate::denies('update-post', $post)) {
			abort(403);
		}
		// Update Post...
		$post->update($request->only('title', 'body'));

		// dump($request->tags);

		// dd(__FILE__ . ' - ' . __LINE__);
		// add tags
		// dump($request->tags);
		// dump($request->get('tags'));
		// dump($request->get('tags')[0]);
		// dump($request->tags[0]);
		// dump(explode(',', $request->tags));
		// dump(implode(',', $request->tags));
		// dd(__FILE__ . ' - ' . __LINE__);
		// $post->syncTags(implode(',', $request->tags));
		$tags = explode(',', $request->tags);

		if (count($tags)) {
			$post->syncTags($tags);
		}
		// $post->attachTags($request->tags);
		// $post->attachTags(implode(',', $request->tags));

		return $this->showPost($post);
		// dd(get_class($this) . '->update()');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $post
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($post) {
		dd(get_class($this) . '->destroy()');
	}
}
