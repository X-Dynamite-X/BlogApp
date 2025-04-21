@extends('layouts.app')
@section('title', auth()->user()->name)
@section('content')

<div class="container mx-auto px-4 py-8">
    <!-- Profile Header -->
    <div class="mb-12 bg-white dark:bg-[#202020] rounded-2xl shadow-lg overflow-hidden">
        <!-- Cover Image & Profile Info -->
        <div class="relative h-48 bg-gradient-to-r from-blue-500 to-purple-600">
            <div class="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-black/60 to-transparent">
                <div class="flex items-end space-x-6">
                    <div class="relative group">
                        <img
                            src="{{ auth()->user()->image }}"
                            alt="Profile picture"
                            class="w-24 h-24 rounded-full border-4 border-white dark:border-gray-800 object-cover shadow-lg"
                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=7F9CF5&background=EBF4FF'"
                        >
                        <label for="profile-image" class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-full opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </label>
                        <input type="file" id="profile-image" class="hidden" accept="image/*">
                    </div>
                    <div class="pb-2">
                        <h1 class="text-3xl font-bold text-white mb-1">{{ auth()->user()->name }}</h1>
                        <div class="flex items-center space-x-4 text-gray-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"></path>
                                </svg>
                                <span class="font-semibold">{{ $posts->total() }}</span>
                                <span class="ml-1">{{ Str::plural('Article', $posts->total()) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Stats & Actions -->
        <div class="p-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <!-- Stats -->
                <div class="flex flex-wrap items-center gap-6 text-sm">
                    <div class="flex items-center text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Member since {{ auth()->user()->created_at->format('F Y') }}
                    </div>
                    <div class="flex items-center text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        {{ number_format($user->views()->sum('view')) }} Total Views
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('post.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        New Article
                    </a>
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Articles Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Your Articles
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-2">
                    Manage and view your published articles
                </p>
            </div>
        </div>
    </div>

    <!-- Articles Grid -->
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 articlesPage">
        @include('post.getPageValue', ['posts' => $posts])
    </div>

    <!-- Pagination -->
    <div class="mt-12 flex justify-center">
        {{ $posts->links() }}
    </div>
</div>

@endsection

