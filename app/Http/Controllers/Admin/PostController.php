<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use aggiunti
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewMail;
// models
use App\Post;
use App\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $user = Auth::user();

        return view('admin.posts.index', compact('posts', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Faker $faker)
    {
        // if(!Auth::check()) {
        //   abort('404');
        // }

        $request->validate($this->validationData());
        $data = $request->all();

        $new_post = new Post();
        $new_post->title = $data['title'];
        $new_post->user_id = Auth::id();
        $new_post->content = $data['content'];

        if (isset($data['image'])) {
          // upload e salvataggio file immagine
          $path = $request->file('image')->store('images', 'public');
          $img_faker = $faker->imageUrl(320, 240);
          if (isset($path)) {
            $new_post->image = $path;
          } else {
            $new_post->image = $img_faker;
          }
        }

        $new_post->save();

        Mail::to($new_post->user->email)->send(new SendNewMail);

        return redirect()->route('admin.posts.show', $new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate($this->validationData());
        $data = $request->all();

        if (isset($data['image'])){
          $path = $request->file('image')->store('images', 'public');
          $post->image = $path;
        } else {
          $post->image = '';
        }

        $post->update();

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }

    public function validationData() {
      return [
        'title' => 'required|max:255',
        'content' => 'required',
        'image' => 'image'
      ];
    }
}
