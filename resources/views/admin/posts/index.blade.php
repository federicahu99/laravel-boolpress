@extends('layouts.app');

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@section('content')

@section('title')
<header class="container">
    <div class="d-flex justify-content-between align-items-center">
        <div class=>
            <h2>Post</h2>
        </div>
        <div>
            <a href=" {{ route('admin.posts.create') }} " class="btn btn-success my-2">
                <i class="fa-regular fa-square-plus mr-1"></i>Crea post
            </a>
        </div>
</header>
@endsection


<table class="table container">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titolo</th>
            <th scope="col">User</th>
            <th scope="col">Category</th>
            <th scope="col">Data creazione</th>
            <th scope="col">Data modifica</th>
            <th>Btn</th>
        </tr>
    </thead>
    <tbody>

        @forelse($posts as $post)
        <tr>
            <th scope="row"> {{ $post->id }} </th>
            <td> {{ $post->title }} </td>
            <td> 
                @if ($post->user)
                {{ $post->user->name }}
                @else anonimo
                @endif 
            </td>
            <td>@if($post->category) {{ $post->category->label }} 
                @else Nessuna
                @endif 
             </td>
            <td> {{ $post->created_at}} </td>
            <td> {{ $post->updated_at}} </td>
            <td class="d-flex align-items-start">
                <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-sm btn-primary mr-1">
                    <i class="fa-solid fa-eye"></i> View
                </a>
                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-warning mr-1">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
                <form action="{{ route('admin.posts.destroy' , $post->id) }}" method='POST'>
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm mr-1" type="submit">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <th>Nessun Post trovato</th>
        </tr>
        @endforelse



    </tbody>
</table>
</div>

@endsection