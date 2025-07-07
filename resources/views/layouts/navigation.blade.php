<nav x-data="{ open: false }" class="bg-white border-b border-neutral-300 sticky top-0 z-50 shadow-sm backdrop-blur-md bg-white/95">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-3">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 group">
                        <div class="w-8 h-8 bg-reddit-orange rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm group-hover:shadow-md transition-all duration-200">
                            <span>SN</span>
                        </div>
                        <div class="hidden lg:block">
                            <div class="text-lg font-bold text-neutral-800 group-hover:text-reddit-orange transition-colors duration-200">
                                Social Network
                            </div>
                            <div class="text-xs text-neutral-500 font-medium">
                                Connect & Share
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="hidden lg:flex items-center ml-4">
                    <div class="relative">
                        <input type="text"
                               placeholder="Search..."
                               class="w-64 pl-10 pr-4 py-2 text-sm bg-neutral-100 border border-neutral-200 rounded-full focus:outline-none focus:ring-2 focus:ring-reddit-orange focus:border-transparent focus:bg-white transition-all duration-200"
                               name="search">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden xl:flex space-x-1 ml-4">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                        </svg>
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.*')">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                        Posts
                    </x-nav-link>

                    <x-nav-link :href="route('invitations.index')" :active="request()->routeIs('invitations.*')" class="relative">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Network
                        @php
                            $pendingCount = auth()->user()->receivedInvitations()->where('status', 'pending')->count();
                        @endphp
                        @if($pendingCount > 0)
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-reddit-orange text-white text-xs rounded-full flex items-center justify-center font-bold">
                                {{ $pendingCount }}
                            </span>
                        @endif
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-2">
                <!-- Quick Actions -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('posts.create') }}"
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-full bg-reddit-orange text-white hover:bg-orange-600 transition-all duration-200"
                       title="Create new post">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span class="hidden sm:inline">New Post</span>
                    </a>

                    <a href="{{ route('ai-posts.create') }}"
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-full bg-purple-600 text-white hover:bg-purple-700 transition-all duration-200"
                       title="Generate AI post">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                        <span class="hidden sm:inline">AI</span>
                    </a>
                </div>

                <!-- Notifications -->
                <div class="relative">
                    <x-notification-dropdown />
                </div>

                <!-- User Menu -->
                <div class="relative">
                    <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-2 py-2 text-sm font-medium rounded-lg text-neutral-700 hover:bg-neutral-100 focus:outline-none focus:bg-neutral-100 transition-all duration-200 border border-neutral-200 group">
                            <x-user-avatar :user="Auth::user()" size="sm" class="mr-1" />
                            <div class="text-left hidden lg:block">
                                <div class="font-medium text-neutral-800 group-hover:text-reddit-orange transition-colors">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-neutral-500">
                                    {{ auth()->user()->getAllConnections()->count() }} connections
                                </div>
                            </div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4 text-neutral-400 group-hover:text-neutral-600 transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-neutral-200 bg-neutral-50">
                            <div class="flex items-center space-x-3">
                                <x-user-avatar :user="Auth::user()" size="md" />
                                <div>
                                    <p class="text-sm font-medium text-neutral-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-neutral-500">{{ Auth::user()->email }}</p>
                                    <div class="flex items-center mt-1">
                                        <div class="w-2 h-2 bg-reddit-orange rounded-full mr-2"></div>
                                        <span class="text-xs text-neutral-600">{{ auth()->user()->getAllConnections()->count() }} connections</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="py-1">
                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center px-4 py-2 hover:bg-neutral-50 transition-colors">
                                <svg class="w-4 h-4 text-neutral-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="text-sm text-neutral-700">Profile Settings</span>
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('dashboard')" class="flex items-center px-4 py-2 hover:bg-neutral-50 transition-colors">
                                <svg class="w-4 h-4 text-neutral-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                <span class="text-sm text-neutral-700">Dashboard</span>
                            </x-dropdown-link>
                        </div>

                        <div class="border-t border-neutral-200"></div>

                        <div class="py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                               onclick="event.preventDefault(); this.closest('form').submit();"
                                               class="flex items-center px-4 py-2 text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    <span class="text-sm">Sign Out</span>
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-neutral-400 hover:text-neutral-600 hover:bg-neutral-100 focus:outline-none focus:bg-neutral-100 focus:text-neutral-600 transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white/95 backdrop-blur-md border-t border-neutral-200/60">
        <!-- Search Bar Mobile -->
        <div class="px-4 py-3 border-b border-neutral-200/60">
            <div class="relative">
                <input type="text"
                       placeholder="Search..."
                       class="w-full pl-10 pr-4 py-2 text-sm bg-neutral-100 border border-neutral-200 rounded-full focus:outline-none focus:ring-2 focus:ring-reddit-orange focus:border-transparent focus:bg-white transition-all duration-200"
                       name="search">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="pt-4 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                </svg>
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.*')">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
                Posts
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('invitations.index')" :active="request()->routeIs('invitations.*')" class="relative">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Network
                @php
                    $pendingCount = auth()->user()->receivedInvitations()->where('status', 'pending')->count();
                @endphp
                @if($pendingCount > 0)
                    <span class="ml-auto px-2 py-1 bg-reddit-orange text-white text-xs rounded-full font-semibold">
                        {{ $pendingCount }}
                    </span>
                @endif
            </x-responsive-nav-link>
        </div>

        <!-- Mobile Quick Actions -->
        <div class="px-4 py-3 border-t border-neutral-200/60 bg-neutral-50/50">
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('posts.create') }}" class="flex items-center justify-center px-4 py-2 bg-reddit-orange hover:bg-orange-600 text-white text-sm font-medium rounded-full transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    New Post
                </a>
                <a href="{{ route('ai-posts.create') }}" class="flex items-center justify-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-full transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    AI Generate
                </a>
            </div>
        </div>

        <!-- User Profile Section -->
        <div class="pt-4 pb-3 border-t border-neutral-200/60">
            <div class="px-4 flex items-center space-x-3 mb-4">
                <x-user-avatar :user="Auth::user()" size="md" />
                <div>
                    <div class="font-semibold text-base text-neutral-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-neutral-500">{{ Auth::user()->email }}</div>
                    <div class="text-xs text-neutral-600 mt-1">{{ auth()->user()->getAllConnections()->count() }} connections</div>
                </div>
            </div>

            <div class="space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <svg class="w-5 h-5 mr-3 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profile Settings
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault(); this.closest('form').submit();"
                                           class="text-red-600 hover:bg-red-50">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Sign Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
