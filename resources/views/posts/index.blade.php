@extends('layouts.app')

@section('content')
<div class="bg-white py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl">Blog page</h2>
      </div>
      <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
       @forelse($posts as $post)
            <x-blog.post :post="$post" />
        @empty
            <p class="text-center col-span-3 text-gray-500">No posts found.</p>
        @endforelse
      </div>
      
      <section id="authors">
        @foreach ($authorsWithPublishedPosts as $author)
            <p>{{ $author->name }}</p>
        @endforeach
      </section>
      
      <div class="mt-16">
        {{ $posts->links() }}
      </div>
    </div>
  </div>
@endsection
