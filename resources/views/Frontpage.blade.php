<!-- resources/views/frontpage.blade.php -->
@extends('layouts.MainTemplate')

@section('title', 'Главная страница')

@section('content')
    <div class="container mx-auto py-8 max-w-7xl">
        <h1 class="text-3xl mb-12">
            Main Page
        </h1>
        <div class="grid grid-cols-3 gap-4">
            @foreach( $posts as $post )
                @include('components.Post', ['post' => $post])
            @endforeach
        </div>
    </div>
@endsection
