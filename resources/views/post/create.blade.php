@extends('layouts.app')
@section('title', 'Create Post')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Create New Post</h1>
            <p class="text-gray-600 dark:text-gray-400">Share your thoughts and ideas with the community</p>
        </div>

        <!-- Post Form -->
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Title Input -->
            <div class="bg-white dark:bg-[#202020] rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Post Title</h2>
                <input type="text"
                       name="title"
                       required
                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800"
                       placeholder="Enter your post title">
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content Input -->
            <div class="bg-white dark:bg-[#202020] rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Post Content</h2>
                <textarea name="content"
                          required
                          rows="8"
                          class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800"
                          placeholder="Write your post content here..."></textarea>
                @error('content')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload -->
            <div class="bg-white dark:bg-[#202020] rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Post Image</h2>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col w-full h-32 border-2 border-dashed rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800">
                        <div class="flex flex-col items-center justify-center pt-7">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="pt-1 text-sm tracking-wider text-gray-400">Upload image</p>
                        </div>
                        <input type="file" name="image" class="opacity-0"/>
                    </label>
                </div>
                @error('image')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category Selection -->
            <div class="bg-white dark:bg-[#202020] rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Select Category</h2>
                <select name="category_id"
                        required
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800">
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4">
                <button type="button"
                        onclick="window.history.back()"
                        class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    Cancel
                </button>
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Create Post
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

