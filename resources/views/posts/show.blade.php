@extends('layouts.app')

@section('content')
<div class="bg-white px-6 py-32 lg:px-8">
    <div class="mx-auto max-w-3xl text-base/7 text-gray-700">
      <h1 class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">{{ $post->title }}</h1>
      <p class="mt-6 text-xl/8">{{ $post->description }}</p>
      <img class="aspect-video rounded-xl bg-gray-50 object-cover mt-10" src="{{ $post->image }}" alt="{{ $post->title }}">
      <div class="mt-16 max-w-2xl">
        <p class="mt-6">{{ $post->body }}</p>
      </div>
      <div class="mt-16 font-bold">
        <a href="">{{ $post->author->name }}</a>
      </div>
    </div>
  </div>

  <h3 class="text-2xl font-semibold mb-6 text-center">Leave a Comment</h3>

<form id="comment-form" method="POST" action="{{ route('comment', $post) }}" class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
  @csrf
  <input id="name" required type="text" name="name" 
    placeholder="Your name" 
    value="{{ old('name') }}"
    class="w-full mb-3 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
  >
  @error('name') 
    <p class="text-red-600 mb-3 text-sm">{{ $message }}</p> 
  @enderror

  <textarea id="body" required name="body" 
    placeholder="Your comment" 
    class="w-full mb-3 px-4 py-2 border border-gray-300 rounded h-28 resize-none focus:outline-none focus:ring-2 focus:ring-indigo-500"
  >{{ old('body') }}</textarea>
  @error('body') 
    <p class="text-red-600 mb-3 text-sm">{{ $message }}</p> 
  @enderror

  <button type="submit" class="w-full bg-indigo-600 hover: text-black font-semibold py-2 rounded transition">
    Submit
  </button>
</form>

<h3 class="text-2xl font-semibold mt-12 mb-6 text-center">Comments</h3>

<div class="max-w-xl mx-auto">
  @forelse ($comments as $comment)
    <div class="comment mb-6 p-4 border border-gray-200 rounded shadow-sm bg-white">
      <p class="mb-1">
        <strong class="text-indigo-700">{{ $comment->name }}</strong> 
        <small class="text-gray-500 ml-2">{{ $comment->created_at->diffForHumans() }}</small>
      </p>
      <p class="mb-3 text-gray-700 whitespace-pre-line">{{ $comment->body }}</p>

      
      <form 
        method="POST" 
        action="{{ route('comment.delete', $comment) }}" 
        onsubmit="return confirm('Are you sure you want to delete this comment?');" 
        style="display:inline;"
      >
        @csrf
        @method('DELETE')
        <button 
          type="submit" 
          class="text-red-600 hover:text-red-800 font-semibold transition"
        >
          Delete
        </button>
      </form>
    </div>
  @empty
    <p class="text-center text-gray-500">No comments yet.</p>
  @endforelse
</div>
@endsection
