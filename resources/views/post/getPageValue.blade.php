@foreach ($posts as $post)
    <article class="group relative flex h-[32rem] flex-col overflow-hidden rounded-2xl bg-white shadow-lg transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl dark:bg-[#202020] dark:shadow-2xl">
        {{-- Featured Tag (if post is featured) --}}
        @if($post->is_featured)
            <div class="absolute left-4 top-4 z-10">
                <span class="inline-flex items-center rounded-full bg-gradient-to-r from-blue-600 to-blue-700 px-3 py-1 text-sm font-medium text-white shadow-lg">
                    <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Featured
                </span>
            </div>
        @endif

        {{-- Image Section with Gradient Overlay --}}
        <div class="relative h-48 w-full overflow-hidden">
            <img src="{{ asset( "storage/".$post->image) }}" alt="{{ $post->title }}"
                class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                loading="lazy"
                 >
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

            {{-- Category Badge --}}
            <div class="absolute right-4 top-4">
                <a href="{{ route('post.catygory', $post->category->name) }}"
                    class="inline-flex items-center rounded-full bg-blue-600/90 px-3 py-1 text-sm font-medium text-white backdrop-blur-sm transition-all duration-300 hover:bg-blue-700 hover:shadow-lg">
                    {{ $post->category->name }}
                </a>
            </div>
        </div>

        {{-- Content Section --}}
        <div class="flex flex-1 flex-col p-6">
            {{-- Title --}}
            <h3 class="mb-3 h-14 text-xl font-bold text-gray-900 decoration-blue-600 decoration-2 transition-colors duration-300 group-hover:text-blue-600 dark:text-white dark:group-hover:text-blue-400 line-clamp-2">
                <a href="{{ route('post.show', $post) }}" class="hover:underline">
                    {{ $post->title }}
                </a>
            </h3>

            {{-- Content Preview --}}
            <p class="mb-4 h-12 text-gray-600 dark:text-gray-400 line-clamp-2">
                {{ $post->content }}
            </p>

            {{-- Author Info with Hover Effects --}}
            <a href="{{ route('users.posts', $post->user) }}"
               class="mb-4 flex h-12 items-center rounded-lg p-2 transition-colors duration-300 hover:bg-gray-50 dark:hover:bg-gray-800">
                <img src="{{ $post->user->image }}"
                     alt="{{ $post->user->name }}"
                     class="h-8 w-8 rounded-full object-cover ring-2 ring-transparent transition-all duration-300 group-hover:ring-blue-400"
                      >
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900 dark:text-white line-clamp-1">
                        {{ $post->user->name }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ $post->created_at->diffForHumans() }}
                    </p>
                </div>
            </a>

            {{-- Interaction Buttons with Enhanced Styling --}}
            <div class="mt-auto flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    {{-- Like Button --}}
                    <button class="like-btn group/btn flex items-center space-x-2 rounded-full px-3 py-1 transition-colors duration-300 hover:bg-blue-50 dark:hover:bg-blue-900/30"
                            id="like-btn-{{ $post->id }}"
                            data-is-active="{{ $post->actions->where('action', 'like')->where('user_id', auth()->id())->count() ? 'true' : 'false' }}"
                            data-post-id="{{ auth()->check() ? $post->id : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 transition-colors duration-300 {{ $post->actions->where('action', 'like')->where('user_id', auth()->id())->count() ? 'text-blue-600 dark:text-blue-400' : 'group-hover/btn:text-blue-600 dark:group-hover/btn:text-blue-400' }}"
                            fill="{{ $post->actions->where('action', 'like')->where('user_id', auth()->id())->count() ? 'currentColor' : 'none' }}"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                        </svg>
                        <span id="like-count-{{ $post->id }}"
                            class="text-sm font-medium {{ $post->actions->where('action', 'like')->where('user_id', auth()->id())->count() ? 'text-blue-600 dark:text-blue-400' : '' }}">
                            {{ $post->actions->where('action', 'like')->count() }}
                        </span>
                    </button>

                    {{-- Dislike Button --}}
                    <button class="dislike-btn group/btn flex items-center space-x-2 rounded-full px-3 py-1 transition-colors duration-300 hover:bg-red-50 dark:hover:bg-red-900/30"
                            id="dislike-btn-{{ $post->id }}"
                            data-is-active="{{ $post->actions->where('action', 'dislike')->where('user_id', auth()->id())->count() ? 'true' : 'false' }}"
                            data-post-id="{{ auth()->check() ? $post->id : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 transition-colors duration-300 {{ $post->actions->where('action', 'dislike')->where('user_id', auth()->id())->count() ? 'text-red-600 dark:text-red-400' : 'group-hover/btn:text-red-600 dark:group-hover/btn:text-red-400' }}"
                            fill="{{ $post->actions->where('action', 'dislike')->where('user_id', auth()->id())->count() ? 'currentColor' : 'none' }}"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                        </svg>
                        <span id="dislike-count-{{ $post->id }}"
                            class="text-sm font-medium {{ $post->actions->where('action', 'dislike')->where('user_id', auth()->id())->count() ? 'text-red-600 dark:text-red-400' : '' }}">
                            {{ $post->actions->where('action', 'dislike')->count() }}
                        </span>
                    </button>

                    {{-- View Counter with Enhanced Style --}}
                    <div class="flex items-center space-x-2 rounded-full px-3 py-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5 text-gray-500 dark:text-gray-400"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ $post->views()->sum('view') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endforeach

