<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>email inviata con successo</div>
    <h1>{{$post->title}}</h1>
    <p> Content: {{$post->content}}</p>
    @if($post->category)
    <p> Category: {{$post->category->label}}</p>
    @else <p> Nessuna categoria </p> 
    @endif   
    <p> Date of creation: {{$post->created_at}}</p>
    @if($post->category)
    @forelse($post->tags as $tag)
        <ul>
            <li>{{ $tag->label}}</li>
        </ul>
    @else <p> Nessun tag selezionato </p> 
    @endif 
</body>
</html>

