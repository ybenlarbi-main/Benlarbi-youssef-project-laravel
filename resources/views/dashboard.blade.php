{{-- Modern Dashboard --}}
<x-app-layout>
    <x-reddit-layout>
        <!-- Create Post Quick Box -->
        <div class="card card-elevated">
            <div class="card-body">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    </div>
                    <a href="{{ route('posts.create') }}" class="flex-1 form-input bg-neutral-50 hover:bg-neutral-100 transition-colors rounded-full px-4 py-2 text-neutral-500 text-sm cursor-pointer">
                        What's on your mind?
                    </a>
                    <button class="p-2 text-neutral-500 hover:bg-neutral-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </button>
                    <a href="{{ route('ai-posts.create') }}" class="btn-ai btn-sm" title="AI Generate">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                        AI
                    </a>
                </div>
            </div>
        </div>

        <!-- Feed Sorting -->
        <div class="card">
            <div class="card-body-sm">
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-neutral-700">Sort by:</span>
                    <div class="flex space-x-1">
                        <button class="nav-link nav-link-active">Hot</button>
                        <button class="nav-link">New</button>
                        <button class="nav-link">Top</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Posts Feed -->
        @php
            $recentPosts = auth()->user()->posts()->with(['likes', 'comments', 'user'])->latest()->take(5)->get();
        @endphp

        @if($recentPosts->count() > 0)
            @foreach($recentPosts as $post)
                <div class="card card-elevated hover:shadow-large transition-all duration-300">
                    <div class="card-body">
                        <!-- Post Header -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">{{ strtoupper(substr($post->user->name, 0, 1)) }}</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-neutral-900">{{ $post->user->name }}</p>
                                    <p class="text-sm text-neutral-500">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @if($post->is_ai_generated)
                                <span class="badge badge-ai">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                    </svg>
                                    AI Generated
                                </span>
                            @endif
                        </div>

                        <!-- Post Content -->
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-neutral-900 mb-2">{{ $post->title }}</h3>
                            @if($post->content)
                                <div class="text-neutral-700 leading-relaxed">
                                    <p>{{ Str::limit($post->content, 300) }}</p>
                                    @if(strlen($post->content) > 300)
                                        <button class="text-brand-600 text-sm hover:underline mt-2 font-medium">Read more</button>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- Post Actions -->
                        <div class="flex items-center justify-between pt-4 border-t border-neutral-200">
                            <div class="flex items-center space-x-6">
                                <button class="like-button flex items-center space-x-2 text-neutral-600 hover:text-red-500 transition-colors" data-post-id="{{ $post->id }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $post->likes()->count() }}</span>
                                </button>
                                <button class="flex items-center space-x-2 text-neutral-600 hover:text-brand-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $post->comments()->count() }}</span>
                                </button>
                                <button class="flex items-center space-x-2 text-neutral-600 hover:text-brand-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                                    </svg>
                                    <span class="text-sm font-medium">Share</span>
                                </button>
                            </div>
                            <button class="text-neutral-600 hover:text-brand-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <!-- Empty State -->
            <div class="card text-center">
                <div class="card-body-lg">
                    <div class="w-20 h-20 bg-gradient-to-br from-neutral-100 to-neutral-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-neutral-900 mb-3">Welcome to Social Network!</h3>
                    <p class="text-neutral-600 mb-8 max-w-md mx-auto">Start by creating your first post to share with the community and connect with others.</p>
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="{{ route('posts.create') }}" class="btn-primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Create Post
                        </a>
                        <a href="{{ route('ai-posts.create') }}" class="btn-ai">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            AI Generate
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </x-reddit-layout>
</x-app-layout>
