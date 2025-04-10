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
                                class="rounded-full bg-blue-600 px-3 py-1 text-sm text-white transform transition-all duration-300 hover:scale-105 hover:bg-blue-700">
                                <a href="{{ route('post.catygory',  $post->category->name) }}" class="hover:text-blue-200 transition-colors duration-300">
                                    {{ $post->category->name }}
                                </a></span>
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
                            <div class="flex items-center space-x-3 text-gray-500 dark:text-gray-400">
                                {{-- Like Button --}}
                                <button
                                    {{-- onclick="handleLike({{ $post->id }})" --}}
                                    class="flex like-btn items-center space-x-1 transform transition-all duration-300 hover:scale-110 hover:text-blue-600 dark:hover:text-blue-400"
                                    id="like-btn-{{ $post->id }}"
                                 data-post-id="{{ $post->id }}"

                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                    </svg>
                                    <span id="like-count-{{ $post->id }}">{{ $post->actions->where('action', 'like')->count()  }}</span>
                                </button>


                                {{-- Dislike Button --}}
                                <button
                                    {{-- onclick="handleDislike({{ $post->id }})" --}}
                                    class="dislike-btn flex items-center space-x-1 transform transition-all duration-300 hover:scale-110 hover:text-red-600 dark:hover:text-red-400"
                                    id="dislike-btn-{{ $post->id }}"
                                 data-post-id="{{ $post->id }}"

                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                    </svg>
                                    <span id="dislike-count-{{ $post->id }}">{{ $post->actions->where('action', 'dislike')->count()  }}</span>
                                </button>

                                {{-- View Counter --}}
                                <button class="flex items-center space-x-1 view-btn"
                                 {{-- onclick="handleView({{ $post->id }})" --}}
                                 data-post-id="{{ $post->id }}"

                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span id="view-count-{{ $post->id }}">{{ $post->view }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach

        </div>
        <div class="mt-12 flex justify-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection


