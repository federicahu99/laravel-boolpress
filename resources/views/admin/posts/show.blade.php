@extends('layouts.app')

@section('content')

<div class="container">
    <header>
        <h1> {{ $post->title }} </h1>
    </header>
    <hr>
    <div class="clearfix">
        @if($post->image)
        <img src=" {{ $post->image }} " alt="" class="float-left p-2">
        @endif

        <p class="pt-5"> {{ $post->content }} </p>
        <p class="pt-5"> Category: @if($post->category) {{ $post->category->label }} 
        @endif </p>
        <div>
            <time>Created at: {{ $post->created_at }}</time> <br>
            <time>Updated at: {{ $post->updated_at }} </time>
            <p><strong> Author: </strong>
                @if($post->user) {{$post->user->name }} 
                @else Anonimus
                @endif 
            </p>

            @if(count($post->tags))
            <div>
                <strong> Tags: </strong>
                <span>
                    @foreach($post->tags as $tag)
                    {{ $tag->label}}
                    @endforeach
                </span>
            </div>
            @endif
        </div>
    </div>
    <footer class="d-flex align-items-center justify-content-end">
        <div>
            <a href=" {{ route('admin.posts.index') }} " class="btn btn-primary">
                <i class="fa-solid fa-door-open"></i> All posts
            </a>
            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning mr-1">
                <i class="fa-solid  btn-l fa-pen-to-square"></i> Edit
            </a>
        </div>
        <div>
            <form action="{{ route('admin.posts.destroy' , $post->id) }} " method='POST'>
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>
            </form>
            </a>
        </div>
    </footer>
</div>
@endsection