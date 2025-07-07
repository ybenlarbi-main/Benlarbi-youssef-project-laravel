{{-- Reddit-inspired Three Column Layout Component --}}
<div class="bg-reddit-bg min-h-screen">
    <div class="max-w-screen-xl mx-auto px-4 py-6 grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- Left Sidebar - Navigation and Communities -->
        <div class="lg:col-span-3 space-y-4">
            <!-- User Profile Card -->
            <div class="reddit-card">
                <div class="relative bg-gradient-to-r from-reddit-orange to-orange-500 h-12 rounded-t-lg"></div>
                <div class="p-4 -mt-6 relative">
                    <div class="w-16 h-16 bg-reddit-orange rounded-full border-4 border-white flex items-center justify-center mb-3">
                        <span class="text-white font-bold text-xl">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    </div>
                    <h3 class="font-bold text-neutral-900 text-lg">{{ auth()->user()->name }}</h3>
                    <p class="text-neutral-600 text-sm mb-4">{{ auth()->user()->email }}</p>

                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <div class="font-bold text-lg text-neutral-900">{{ auth()->user()->posts()->count() }}</div>
                            <div class="text-xs text-neutral-600">Posts</div>
                        </div>
                        <div>
                            <div class="font-bold text-lg text-neutral-900">{{ auth()->user()->getAllConnections()->count() }}</div>
                            <div class="text-xs text-neutral-600">Connections</div>
                        </div>
                        <div>
                            @php
                                $totalLikes = auth()->user()->posts()->withCount('likes')->get()->sum('likes_count');
                            @endphp
                            <div class="font-bold text-lg text-neutral-900">{{ $totalLikes }}</div>
                            <div class="text-xs text-neutral-600">Karma</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <div class="reddit-card">
                <div class="p-4">
                    <nav class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="reddit-nav-item {{ request()->routeIs('dashboard') ? 'reddit-nav-active' : '' }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                            </svg>
                            Home
                        </a>
                        <a href="{{ route('posts.index') }}" class="reddit-nav-item {{ request()->routeIs('posts.index') ? 'reddit-nav-active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            All Posts
                        </a>
                        <a href="{{ route('posts.create') }}" class="reddit-nav-item {{ request()->routeIs('posts.create') ? 'reddit-nav-active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Create Post
                        </a>
                        <a href="{{ route('ai-posts.create') }}" class="reddit-nav-item {{ request()->routeIs('ai-posts.create') ? 'reddit-nav-active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            AI Generate
                        </a>
                        <a href="{{ route('invitations.index') }}" class="reddit-nav-item {{ request()->routeIs('invitations.*') ? 'reddit-nav-active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Network
                            @if(auth()->user()->receivedInvitations()->where('status', 'pending')->count() > 0)
                                <span class="ml-auto bg-reddit-orange text-white text-xs px-2 py-0.5 rounded-full">{{ auth()->user()->receivedInvitations()->where('status', 'pending')->count() }}</span>
                            @endif
                        </a>
                        <a href="{{ route('notifications.index') }}" class="reddit-nav-item {{ request()->routeIs('notifications.*') ? 'reddit-nav-active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 2v20l6-6h8a2 2 0 002-2V4a2 2 0 00-2-2H4z"/>
                            </svg>
                            Notifications
                            @php
                                $unreadNotificationCount = auth()->user()->notifications()->whereNull('read_at')->count();
                            @endphp
                            @if($unreadNotificationCount > 0)
                                <span class="ml-auto bg-reddit-blue text-white text-xs px-2 py-0.5 rounded-full">{{ $unreadNotificationCount }}</span>
                            @endif
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="reddit-card">
                <div class="p-4">
                    <h4 class="font-bold text-neutral-900 mb-3">Your Activity</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-neutral-600">Posts this week</span>
                            @php $recentPostsCount = auth()->user()->posts()->where('created_at', '>=', now()->subDays(7))->count(); @endphp
                            <span class="font-bold text-reddit-orange">{{ $recentPostsCount }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-neutral-600">AI Generated</span>
                            <span class="font-bold text-purple-600">{{ auth()->user()->posts()->where('is_ai_generated', true)->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-neutral-600">Total Karma</span>
                            <span class="font-bold text-green-600">{{ $totalLikes }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="lg:col-span-6 space-y-4">
            {{ $slot }}
        </div>

        <!-- Right Sidebar - Trending and Info -->
        <div class="lg:col-span-3 space-y-4">
            <!-- About Community Card -->
            <div class="reddit-card">
                <div class="p-4">
                    <h4 class="font-bold text-neutral-900 mb-3">About this community</h4>
                    <p class="text-sm text-neutral-600 mb-4">A place to share ideas, connect with others, and grow together. Join conversations and discover new perspectives.</p>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-neutral-600">Members</span>
                            <span class="font-bold">{{ \App\Models\User::count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-neutral-600">Posts</span>
                            <span class="font-bold">{{ \App\Models\Post::count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-neutral-600">Created</span>
                            <span class="font-bold">{{ now()->format('M Y') }}</span>
                        </div>
                    </div>
                    <a href="{{ route('posts.create') }}" class="w-full mt-4 bg-reddit-orange hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-full text-sm text-center block transition-colors">
                        Create Post
                    </a>
                </div>
            </div>

            <!-- Trending Posts -->
            @php
                $trendingPosts = \App\Models\Post::withCount('likes')
                    ->orderBy('likes_count', 'desc')
                    ->where('created_at', '>=', now()->subDays(30))
                    ->take(5)
                    ->get();
            @endphp
            @if($trendingPosts->count() > 0)
                <div class="reddit-card">
                    <div class="p-4">
                        <h4 class="font-bold text-neutral-900 mb-3">Trending Posts</h4>
                        <div class="space-y-3">
                            @foreach($trendingPosts as $index => $post)
                                <div class="flex items-start space-x-3">
                                    <div class="w-6 h-6 bg-neutral-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-xs font-bold text-neutral-600">{{ $index + 1 }}</span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-neutral-800 line-clamp-2">{{ $post->title }}</p>
                                        <div class="flex items-center space-x-2 mt-1 text-xs text-neutral-500">
                                            <span>{{ $post->likes_count }} upvotes</span>
                                            <span>•</span>
                                            <span>{{ $post->comments_count ?? 0 }} comments</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="reddit-card">
                <div class="p-4">
                    <h4 class="font-bold text-neutral-900 mb-3">Quick Actions</h4>
                    <div class="space-y-2">
                        <a href="{{ route('ai-posts.create') }}" class="w-full bg-purple-50 hover:bg-purple-100 text-purple-700 font-medium py-2 px-4 rounded-lg text-sm text-center block transition-colors border border-purple-200">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                                <span>AI Generate Post</span>
                            </div>
                        </a>
                        <a href="{{ route('invitations.create') }}" class="w-full bg-green-50 hover:bg-green-100 text-green-700 font-medium py-2 px-4 rounded-lg text-sm text-center block transition-colors border border-green-200">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                                <span>Invite Friends</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Stats -->
            <div class="reddit-card">
                <div class="p-4">
                    <h4 class="font-bold text-neutral-900 mb-3">Your Stats</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-neutral-600">Post Karma</span>
                            <span class="font-bold text-reddit-orange">{{ $totalLikes }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-neutral-600">Comment Karma</span>
                            @php
                                $commentKarma = auth()->user()->posts()->withCount('comments')->get()->sum('comments_count');
                            @endphp
                            <span class="font-bold text-blue-600">{{ $commentKarma }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-neutral-600">Cake Day</span>
                            <span class="font-bold text-neutral-700">{{ auth()->user()->created_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
