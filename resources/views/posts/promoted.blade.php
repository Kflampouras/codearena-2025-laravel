@extends('layouts.app')

@section('content')
    <h1>Promoted Posts</h1>

    @foreach($promotedPosts as $post)
        <div>
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->description }}</p>
        </div>
    @endforeach
@endsection