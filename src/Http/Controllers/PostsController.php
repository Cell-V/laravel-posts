<?php

namespace CellV\LaravelPosts\Http\Controllers;

use Illuminate\Http\Request;
use CellV\LaravelPosts\Http\Requests\StorePostRequest;
use CellV\LaravelPosts\Models\Post;

class PostsController extends \App\Http\Controllers\Controller
{

  public function __construct()
  {
      $this->middleware('web');
  }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(get_class($this).'->index()');
        $posts = Post::all();
        return view('LaravelPosts::index')
        ->with('posts',$posts)
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(get_class($this).'->create()');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // dump($request->input());
        // dump($request->has('online'));
        // dd(get_class($this).'->store()');
        $post = new Post;

        $post->title = $request->title;
        $post->body = $request->body;

        // if ($request->has('online')) $post->online = $request->online;

        $post->slug = str_slug($request->title);

        $post->save();

        // add tags
        // $post->tag($request->tags);

        foreach (array_flatten(config('translatable.locales')) as $locale) {
            $post->translateOrNew($locale)->title = "{$request->title} {$locale}";
            $post->translateOrNew($locale)->body = "{$request->body} {$locale}";
        }

        $post->save();

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
    public function showPost(Post $post)
    {
      if (!$post) {
        return abort(404);
      }
      return view('LaravelPosts::show')
      ->with('post',$post)
      ;
    }
    public function show($id)
    {
      dump($id);
      dump(gettype($id));
      dump(intval($id));
      if (!intval($id)) {
        dump('s');
        $post = Post::where('slug',$id)->first();
      }
      switch (gettype($id)) {
        case 'string':
          $post = Post::find($id);
          break;

        case 'integer':
          # code...
          break;

        default:
          # code...
          break;
      }

      dd($post);
        dd(get_class($this).'->show()');

        return $this->showPost();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd(get_class($this).'->edit()');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd(get_class($this).'->update()');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(get_class($this).'->destroy()');
    }
}
