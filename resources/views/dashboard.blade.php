{{-- Reddit-inspired Dashboard --}}
<x-app-layout>
    <x-reddit-layout>
        <!-- Create Post Quick Box -->
        <div class="reddit-card">
            <div class="p-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-reddit-orange rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    </div>
                    <a href="{{ route('posts.create') }}" class="flex-1 bg-neutral-100 hover:bg-neutral-200 transition-colors rounded-full px-4 py-2 text-neutral-500 text-sm">
                        Create Post
                    </a>
                    <button class="p-2 text-neutral-500 hover:bg-neutral-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </button>
                    <a href="{{ route('ai-posts.create') }}" class="p-2 text-purple-500 hover:bg-purple-50 rounded-lg transition-colors" title="AI Generate">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Feed Sorting -->
        <div class="reddit-card">
            <div class="p-3">
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-neutral-700">Sort by:</span>
                    <div class="flex space-x-1">
                        <button class="reddit-sort-tab reddit-sort-active">Hot</button>
                        <button class="reddit-sort-tab">New</button>
                        <button class="reddit-sort-tab">Top</button>
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
                <div class="reddit-post">
                    <!-- Voting Column -->
                    <div class="reddit-vote-column">
                        <button class="reddit-vote-btn reddit-upvote">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <span class="reddit-vote-count">{{ $post->likes()->count() }}</span>
                        <button class="reddit-vote-btn reddit-downvote">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Post Content -->
                    <div class="reddit-post-content">
                        <div class="reddit-post-meta">
                            <span class="text-xs text-neutral-500">
                                Posted by u/{{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}
                                @if($post->is_ai_generated)
                                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                        </svg>
                                        AI
                                    </span>
                                @endif
                            </span>
                        </div>

                        <h3 class="reddit-post-title">{{ $post->title }}</h3>

                        @if($post->content)
                            <div class="reddit-post-body">
                                <p>{{ Str::limit($post->content, 300) }}</p>
                                @if(strlen($post->content) > 300)
                                    <button class="text-reddit-blue text-sm hover:underline mt-2">Read more</button>
                                @endif
                            </div>
                        @endif

                        <!-- Post Actions -->
                        <div class="reddit-post-actions">
                            <button class="reddit-action-btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                {{ $post->comments()->count() }} Comments
                            </button>
                            <button class="reddit-action-btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                                </svg>
                                Share
                            </button>
                            <button class="reddit-action-btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                                Save
                            </button>
                            <button class="reddit-action-btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <!-- Empty State -->
            <div class="reddit-card">
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-neutral-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-neutral-800 mb-2">Welcome to Social Network!</h3>
                    <p class="text-neutral-600 mb-6">Start by creating your first post to share with the community.</p>
                    <div class="space-x-3">
                        <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-reddit-orange hover:bg-orange-600 text-white font-medium rounded-full transition-colors">
                            Create Post
                        </a>
                        <a href="{{ route('ai-posts.create') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-full transition-colors">
                            AI Generate
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </x-reddit-layout>
</x-app-layout>
