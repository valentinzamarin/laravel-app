<!-- resources/views/frontpage.blade.php -->
@extends('layouts.MainTemplate')

@section('title', 'Post Page')

@section('content')
    <div class="container mx-auto py-8 max-w-7xl">
        <header class="flex justify-between">
            <h1 class="text-3xl mb-6">
                {{ $post['post_title'] }}
            </h1>
            @if(  auth()->id() === $post['user_id'] )
                <div>
                    <a href="{{ url('/post/' . $post->id . '/edit') }}" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                        Edit Post
                    </a>
                </div>
            @endif

        </header>
        <p class="text-sm text-slate-500 mb-6">
            {{ $post->user->name }}
        </p>
        <hr class="block mb-12">
        {{ $post['post_content'] }}
        <hr class="block mb-12">
        @foreach ($post->tags as $tag)
            <a href="{{ url('/post/tags/' . $tag->name ) }}" class="block mb-4 underline text-blue-500">
                {{ $tag->name }}
            </a>
        @endforeach
    </div>
@endsection
