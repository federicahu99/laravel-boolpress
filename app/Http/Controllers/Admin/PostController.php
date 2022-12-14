<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Mail\PostPublicationMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();;
        return view('admin.posts.create', compact('post', 'categories', 'tags',));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:50|unique:posts',
            'content' => 'required|string',
            'image' => 'nullable',
            'category_id' => 'required|exists:categories,id', // !!!!
        ], [
            'title.required' => 'The title is required',
            'title.unique' => '$request->title already exsist',
            'title.min' => 'The title must be at least 5 characters long',
            'title.max' => 'The title can\'t be longer than 50 characters',
            'title.required' => 'the title is required',
            'content.required' => 'Content is required',
            'image.mimes' => 'the file has to be in jpg, png or jpeg',
            'image.image' => 'the uploaded file is not an image',
            'category_id.exists' => 'Select a valid category'
        ]);

        $data = $request->all();
        $post = new Post();
        $post->fill($data); // !!!! 
        $post->category_id = $data['category_id'];
        $post->slug = Str::slug($post->title, '-');
        $post->user_id = Auth::id(); // id utente autenticato

        if (array_key_exists('image', $data)) {
            $linkImg = Storage::put('post_imgs', $data['image'] );
            $post->image = $linkImg;
        };

        $post->save();

        if (array_key_exists('tags', $data)) $post->tags()->attach($data['tags']); // tag in arrivo da create

        // mail of confirmation of publication
        $mail= new PostPublicationMail($post);
        $user_mail = Auth::user()->email;
        Mail::to($user_mail)->send($mail); 

        return redirect()->route('admin.posts.show', $post)->with('message', 'Post created succesfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.show', compact('post', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $selected_tags = $post->tags->pluck('id')->toArray();
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'selected_tags'));
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
        $request->validate([
            'title' => 'required|string|min:5|max:50',
            'content' => 'required|string',
            'image' => 'nullable',
            'category_id' => 'required|exists:categories,id',
        ], [
            'title.required' => 'The title is required',
            'title.min' => 'The title must be at least 5 characters long',
            'title.max' => 'The title can\'t be longer than 50 characters',
            'title.required' => 'the title is required',
            'content.required' => 'Content is required',
            'image.mimes' => 'the file has to be in jpg, png or jpeg',
            'image.image' => 'the uploaded file is not an image',
            'category_id.exists' => 'Select a valid category'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title, '-');
        $post->update($data); // fill and save
        $category_id = $data['category_id'];
        $post->category_id = $category_id;

        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        if (array_key_exists('image', $data)) {
            if ($post->image) Storage::delete($post->image);
            $linkImg = Storage::put('post_imgs', $data['image'] );
            $post->image = $linkImg;
        };
        $post->update($data);

        return redirect()->route('admin.posts.show', $post)->with('message', 'The post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->image) Storage::delete($post->image);

        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', 'The post has been deleted');
    }
}
