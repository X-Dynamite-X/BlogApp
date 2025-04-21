@extends('layouts.app')
@section('title', $post->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <article class="max-w-4xl mx-auto bg-[#FDFDFC] dark:bg-[#202020] rounded-2xl shadow-lg overflow-hidden">
        <!-- Header Section -->
        <div class="relative h-[60vh] overflow-hidden">
            <!-- Add Edit Button - Only visible to post owner -->
            @if(auth()->check() && auth()->id() === $post->user_id)
            <div class="absolute top-4 right-4 z-10">
                <a href="{{ route('post.edit', $post) }}"
                   class="inline-flex items-center px-4 py-2 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm
                          rounded-lg shadow-lg hover:bg-white dark:hover:bg-gray-800 transition-all duration-300
                          text-gray-700 dark:text-gray-200 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5 mr-2"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Post
                </a>
            </div>
            @endif

            <img src="https://picsum.photos/1200/800?random={{ $post->id }}"
                 alt="{{ $post->title }}"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-0 p-8 w-full">
                <!-- Category Badge -->
                <a href="{{ route('post.catygory', $post->category->name) }}"
                    class="inline-block mb-4 px-4 py-1.5 rounded-full bg-blue-600 text-sm font-medium text-white hover:bg-blue-700 transition-colors duration-300">
                    {{ $post->category->name }}
                </a>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $post->title }}</h1>

                <!-- Author Info -->
                <div class="flex items-center">
                    <img src="https://picsum.photos/32/32?random={{ $post->user->id }}"
                         alt="{{ $post->user->name }}"
                         class="h-12 w-12 rounded-full ring-2 ring-white/50 mr-4">
                    <div>
                        <p class="text-lg font-medium text-white">{{ $post->user->name }}</p>
                        <div class="flex items-center text-sm text-gray-300">
                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ ceil(str_word_count($post->content) / 200) }} min read</span>
                            @if($post->updated_at != $post->created_at)
                            <span class="mx-2">•</span>
                            <span>Edited {{ $post->updated_at->diffForHumans() }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="p-8">
            <!-- Content -->
            <div class="prose prose-lg dark:prose-invert max-w-none mb-8 leading-relaxed">
                {!! nl2br(e($post->content)) !!}
            </div>

            <!-- Interaction Stats -->
            <div class="flex items-center justify-between border-t dark:border-gray-700 pt-6">
                <div class="flex items-center space-x-6">
                    <!-- Like Button -->
                    <button class="like-btn flex items-center space-x-2 group"
                            data-post-id="{{ auth()->check()? $post->id :'' }}"
                            data-is-active="{{ $post->actions->where('action', 'like')->where('user_id', auth()->id())->count() ? 'true' : 'false'}}"
                            id="like-btn-{{ $post->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6 transition-colors duration-300 {{ $post->actions->where('action', 'like')->where('user_id', auth()->id())->first() ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400' }}"
                             fill="{{ $post->actions->where('action', 'like')->where('user_id', auth()->id())->first() ? 'currentColor' : 'none' }}"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                        </svg>
                        <span id="like-count-{{ $post->id }}"
                              class="text-gray-600 dark:text-gray-300">
                            {{ $post->actions->where('action', 'like')->count() }}
                        </span>
                    </button>

                    <!-- Dislike Button -->
                    <button class="dislike-btn flex items-center space-x-2 group"
                            data-post-id="{{ auth()->check()? $post->id :'' }}"
                            data-is-active="{{ $post->actions->where('action', 'dislike')->where('user_id', auth()->id())->count() ? 'true' : 'false'}}"
                            id="dislike-btn-{{ $post->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6 transition-colors duration-300 {{ $post->actions->where('action', 'dislike')->where('user_id', auth()->id())->first() ? 'text-red-600 dark:text-red-400' : 'text-gray-500 dark:text-gray-400 group-hover:text-red-600 dark:group-hover:text-red-400' }}"
                             fill="{{ $post->actions->where('action', 'dislike')->where('user_id', auth()->id())->first() ? 'currentColor' : 'none' }}"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                        </svg>
                        <span id="dislike-count-{{ $post->id }}"
                              class="text-gray-600 dark:text-gray-300">
                            {{ $post->actions->where('action', 'dislike')->count() }}
                        </span>
                    </button>

                    <!-- View Counter -->
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6 text-gray-500 dark:text-gray-400"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">{{ $post->views->sum('view') }}</span>
                    </div>
                </div>

                <!-- Share Button -->
                <button class="text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400
                               transition-colors duration-300 transform hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                </button>
            </div>
        </div>
    </article>

    <!-- Related Posts -->
    <div class="max-w-4xl mx-auto mt-16">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Related Posts</h2>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($post->category->posts->where('id', '!=', $post->id)->take(3) as $relatedPost)
                <article class="overflow-hidden rounded-xl bg-[#FDFDFC] shadow-lg transition-all duration-500
                              hover:scale-[1.02] hover:shadow-xl dark:bg-[#202020] dark:shadow-2xl cursor-pointer group">
                    <a href="{{ route('post.show', $relatedPost) }}" class="block">
                        <div class="relative h-48 overflow-hidden">
                            <img src="https://picsum.photos/400/300?random={{ $relatedPost->id }}"
                                 alt="{{ $relatedPost->title }}"
                                 class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute top-4 right-4">
                                <span class="rounded-full bg-blue-600 px-3 py-1 text-sm text-white transform
                                           transition-all duration-300 hover:scale-105 hover:bg-blue-700">
                                    {{ $relatedPost->category->name }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white group-hover:text-blue-600
                                       dark:group-hover:text-blue-400 transition-colors duration-300">
                                {{ $relatedPost->title }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 line-clamp-2">
                                {{ $relatedPost->content }}
                            </p>
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/32/32?random={{ $relatedPost->user->id }}"
                                         alt="{{ $relatedPost->user->name }}"
                                         class="h-8 w-8 rounded-full mr-3">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $relatedPost->user->name }}
                                    </span>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $relatedPost->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</div>
@endsection




