@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Hero Section -->
        <div class="mb-12 text-center transform transition-transform duration-300 hover:scale-105">
            <h1 class="mb-4 text-4xl font-bold text-gray-900 dark:text-white">Welcome to Our Blog</h1>
            <p class="mx-auto max-w-2xl text-lg text-gray-600 dark:text-gray-400">Discover stories, thinking, and expertise
                from writers on any topic.</p>
        </div>

        <!-- Featured Post -->
        <div
            class="mb-12 overflow-hidden rounded-2xl bg-[#FDFDFC] shadow-lg transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl dark:bg-[#202020] dark:shadow-2xl cursor-pointer">
            <div class="relative h-96">
                <img src="https://picsum.photos/1200/800" alt="Featured post"
                    class="h-full w-full object-cover transition-transform duration-500 hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-0 p-8 transform transition-all duration-300">
                    <span
                        class="mb-2 inline-block rounded-full bg-blue-600 px-3 py-1 text-sm text-white hover:bg-blue-700 transition-colors duration-300">Featured</span>
                    <h2 class="mb-4 text-3xl font-bold text-white hover:text-blue-200 transition-colors duration-300">The
                        Future of Web Development</h2>
                    <p class="mb-4 text-gray-200">Explore the latest trends and technologies shaping the future of web
                        development.</p>
                    <div class="flex items-center transform transition-transform duration-300 hover:translate-x-2">
                        <img src="https://picsum.photos/32/32" alt="Author"
                            class="mr-4 h-8 w-8 rounded-full ring-2 ring-transparent hover:ring-blue-400 transition-all duration-300">
                        <div>
                            <p class="text-sm font-medium text-white">John Doe</p>
                            <p class="text-sm text-gray-300">5 min read • June 1, 2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Posts Grid -->
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 articlesPage">
            @include('post.getPageValue', ['posts' => $posts])

        </div>
        <div class="mt-12 flex justify-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection


