<!-- resources/views/frontpage.blade.php -->
@extends('layouts.MainTemplate')

@section('title', 'Добавить пост')

@section('content')

    <div class="container mx-auto py-8 max-w-7xl">
        <h1 class="text-3xl">
            Create New Post
        </h1>
        <form action="/create-post" method="POST">
            @csrf
            <div class="mb-5">
                <label for="post_title"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" id="post_title" name="post_title"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Post Title.." required/>
            </div>
            <div class="mb-5">
                <label for="post_content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Your message
                </label>
                <textarea id="post_content" name="post_content" rows="4"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          placeholder="Leave a comment..."></textarea>
            </div>
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Create Post
            </button>

        </form>
    </div>

@endsection
