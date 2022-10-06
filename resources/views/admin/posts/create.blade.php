@extends('layouts.app')

@section('title')
    <div class="container">
        <h1>Crea post:</h1>
    </div>
@endsection
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li> {{ $error }} </li>
        @endforeach
    </ul>
</div>
@endif 

@section('content')
<div class="container">

    <hr>
    <div class="d-flex align-content-center">
            <form action=" {{ route('admin.posts.store') }} " method="POST" class="row" >

                @csrf
                <div class="form-group col-12">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value=" {{ old('title', $post->title ) }} " minlength="5" maxlength="50">
                    <small id="title" class="form-text text-muted">Must be longer than 5 letters anche shorter than 50!</small>
                </div>
             
                <div class="input-group col-12 mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Category</label>
                    </div>
                    <select class="custom-select" id="category_id" name="category_id">
                        <option selected>Categoria...</option>
                            @foreach($categories as $category)
                            <option @if( old('category_id')) selected @endif
                            value="{{ $category->id }}"> {{ $category->label }}</option>
                            @endforeach
                    </select>
                </div>
                    

                <div class="form-group col-12">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content"> {{ old('content',  $post->content) }} </textarea>
                    <small id="title" class="form-text text-muted">You must write any content</small>
                </div>
                <div class="form-group col-10">
                    <label for="image">Image</label>
                    <input type="url" class="form-control" id="image" name="image" value=" {{ old('image',  $post->image) }} ">
                    <small id="image" class="form-text text-muted">Copy the image's url here.</small>
                </div>
                <div class="form-group col-2">
                    <img src="{{ $post->image ?? 'https://storage.googleapis.com/proudcity/mebanenc/uploads/2021/03/placeholder-image-300x225.png'}}" alt="preview of image" id="preview" class="img-fluid">
                </div>
                
                    {{-- checkbox --}}
                @if(count($tags))
                <div class="form-group col-12">
                    <h3>Tags</h3>
                    @foreach($tags as $tag)
                        <input type="checkbox" 
                        id="tag-{{$tag->label}}" 
                        name="tags[]" 
                        value="{{$tag->id}}"
                        @if(in_array($tag->id, old('tags', [] ))) checked @endif>
                        <label for="tag-{{$tag->label}}" class="mr-3">{{ $tag->label }}</label>
                    @endforeach
                </div>
                @endif
                <div>
                    <a href=" {{ route('admin.posts.index') }} " class="btn btn-primary mr-1">
                        <i class="fa-solid fa-door-open"></i> All posts
                    </a>
                </div>
                <div>
                    <input type="submit" value="Submit" class="btn btn-success">
                </div>
            </form>
    </div>
</div>
@endsection

