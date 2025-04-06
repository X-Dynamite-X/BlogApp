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
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
                <article
                    class="overflow-hidden rounded-xl bg-[#FDFDFC] shadow-lg transition-all duration-500 hover:scale-[1.02] hover:shadow-xl dark:bg-[#202020] dark:shadow-2xl cursor-pointer group">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://picsum.photos/400/300?random={{ $post->id }}" alt="Post image"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-4 right-4">
                            <span
                                class="rounded-full bg-blue-600 px-3 py-1 text-sm text-white transform transition-all duration-300 hover:scale-105 hover:bg-blue-700">{{ $post->category->name }}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3
                            class="mb-2 text-xl font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">
                            <a href="#">{{ $post->title }}</a>
                        </h3>
                        <p class="mb-4 text-gray-600 dark:text-gray-400  text-ellipsis  truncate">{{ $post->content }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center transform transition-all duration-300 hover:translate-x-2">
                                <img src="https://picsum.photos/32/32?random={{ $post->id }}" alt="Author"
                                    class="mr-3 h-8 w-8 rounded-full ring-2 ring-transparent hover:ring-blue-400 transition-all duration-300">
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $post->user->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">3 min read</p>
                                </div>
                            </div>
                            {{-- share and like  butoon --}}
                            <div class="flex items-center space-x-2 text-gray-500 dark:text-gray-400">
                                <button
                                    class="transform transition-all duration-300 hover:scale-125 hover:text-blue-600 dark:hover:text-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                                <button
                                    class="transform transition-all duration-300 hover:scale-125 hover:text-blue-600 dark:hover:text-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach

        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection



