@extends('layouts.app')
@section('title', 'Edit Post - ' . $post->title)

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-gray-500 md:ml-2 dark:text-gray-400">Edit Post</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Header Section with Preview -->
            <div class="mb-8 bg-white dark:bg-[#202020] rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Edit Post</h1>
                        <p class="text-gray-600 dark:text-gray-400">Last updated: {{ $post->updated_at->diffForHumans() }}
                        </p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('post.show', $post) }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Preview
                        </a>
                    </div>
                </div>
            </div>

            <!-- Post Form -->
            <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title Input -->
                <div class="bg-white dark:bg-[#202020] rounded-xl shadow-sm p-6">
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Post
                            Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                            required
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 transition-colors"
                            placeholder="Enter your post title">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Content Input with Preview -->
                <div class="bg-white dark:bg-[#202020] rounded-xl shadow-sm p-6">
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Post
                            Content</label>
                        <div class="flex space-x-4">
                            <div class="flex-1">
                                <textarea id="content" name="content" required rows="12"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 transition-colors"
                                    placeholder="Write your post content here...">{{ old('content', $post->content) }}</textarea>
                            </div>
                            <div class="flex-1 p-4 border rounded-lg dark:border-gray-600">
                                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Preview</h3>
                                <div id="content-preview" class="prose dark:prose-invert max-w-none">
                                    {{ old('content', $post->content) }}
                                </div>
                            </div>
                        </div>
                        @error('content')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image Section -->
                <div class="bg-white dark:bg-[#202020] rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Post Image</h2>

                    <!-- Current Image Preview -->
                    @if ($post->image)
                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current Image</h3>
                            <div class="relative group rounded-lg overflow-hidden aspect-video">
                                <div class="absolute inset-0">
                                    <img src="{{ $post->image }}" loading="lazy" alt="{{ $post->title }}"
                                        id="current-image"
                                        class="w-full h-full object-contain bg-gray-100 dark:bg-gray-800">
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-sm">
                                        <div class="text-center">
                                            <span class="text-white text-sm bg-black bg-opacity-50 px-3 py-1 rounded-full">
                                                Current post image
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Image Upload -->
                    <div class="relative">
                        <input type="file" name="image" id="image-upload" class="hidden" accept="image/*">
                        <label for="image-upload"
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                    <span class="font-semibold">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or GIF (MAX. 2MB)</p>
                            </div>
                        </label>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Category Selection -->
                <div class="bg-white dark:bg-[#202020] rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Category</h2>
                    <select name="category_id" required
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 transition-colors">
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center bg-white dark:bg-[#202020] rounded-xl shadow-sm p-6">
                    <button type="button"
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors delete-btn">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete Post
                    </button>

                    <div class="flex space-x-4">
                        <button type="button" onclick="window.history.back()"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Cancel
                        </button>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors update-btn">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Update Post
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-opacity-50 transition-opacity"></div>
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="bg-white dark:dark:bg-[#202020] rounded-lg max-w-md w-full transform transition-all">
                <div class="p-6">
                    <div class="flex items-center justify-center mb-4">
                        <div class="h-12 w-12 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center">
                            <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium text-center text-gray-900 dark:text-white mb-4">
                        Delete Post
                    </h3>
                    <p class="text-center text-gray-500 dark:text-gray-400 mb-6">
                        Are you sure you want to delete "{{ $post->title }}"? This action cannot be undone.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <button type="button" id="cancelDelete"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                            Cancel
                        </button>
                        <button type="button" id="confirmDelete" data-url="{{ route('post.destroy', $post) }}"
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Delete Post
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
