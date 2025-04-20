@extends('layouts.app')
@section('title', $user->name)
@section('content')

    <div class="container mx-auto px-4 py-8">
        <!-- User Profile Header -->
        <div class="mb-12 bg-white dark:bg-[#202020] rounded-2xl shadow-lg overflow-hidden">
            <!-- Cover Image & Profile Info -->
            <div class="relative h-48 bg-gradient-to-r from-blue-500 to-purple-600">
                <div class="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-black/60 to-transparent">
                    <div class="flex items-end space-x-6">
                        <img 
                            src="{{ $user->image }}" 
                            alt="{{ $user->name }}'s profile picture"
                            class="w-24 h-24 rounded-full border-4 border-white dark:border-gray-800 object-cover shadow-lg"
                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF'"
                        >
                        <div class="pb-2">
                            <h1 class="text-3xl font-bold text-white mb-1">{{ $user->name }}</h1>
                            <div class="flex items-center space-x-4 text-gray-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"></path>
                                    </svg>
                                    <span class="font-semibold">{{ $user->posts->count() }}</span>
                                    <span class="ml-1">{{ Str::plural('Article', $user->posts->count()) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Stats & Info -->
            <div class="p-6">
                <div class="flex flex-wrap items-center gap-6 text-sm">
                    <!-- Join Date -->
                    <div class="flex items-center text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Joined {{ $user->created_at->format('F Y') }}
                    </div>

                    <!-- Total Views -->
                    <div class="flex items-center text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        {{ number_format($user->views->sum('view')) }} Total Views
                    </div>
                </div>
            </div>
        </div>

        <!-- Posts Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Latest Articles
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">
                        Explore {{ $user->name }}'s published articles
                    </p>
                </div>
                <!-- Sort Options (Optional) -->
                <div class="flex items-center space-x-2">
                    <select class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 text-sm">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="popular">Most Popular</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Posts Grid -->
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 articlesPage">
            @include('post.getPageValue', ['posts' => $posts])
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center pagination-wrapper">
            {{ $posts->links() }}
        </div>
    </div>

@endsection


