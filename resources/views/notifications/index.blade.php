{{-- resources/views/notifications/index.blade.php --}}
<x-app-layout>
    <x-reddit-layout>
        <x-slot name="header">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-gradient-to-r from-reddit-orange/20 to-reddit-blue/20 rounded-xl">
                        <svg class="w-8 h-8 text-reddit-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-neutral-900">Notifications</h2>
                        <p class="text-neutral-600">Stay updated with your social activity</p>
                    </div>
                </div>

                @if($unreadCount > 0)
                    <button onclick="markAllAsRead()" class="reddit-btn reddit-btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Mark All Read ({{ $unreadCount }})
                    </button>
                @endif
            </div>
        </x-slot>

        <div class="max-w-4xl mx-auto">
            @if($notifications->count() > 0)
                <div class="space-y-4">
                    @foreach($notifications as $notification)
                        <div class="reddit-card {{ !$notification->isRead() ? 'ring-2 ring-reddit-orange ring-opacity-20 bg-reddit-orange/5' : '' }}"
                             id="notification-{{ $notification->id }}">
                            <div class="p-4">
                                <div class="flex items-start space-x-4">
                                    <!-- Icon -->
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 rounded-full flex items-center justify-center {{ $notification->type === 'like' ? 'bg-reddit-orange/10' : 'bg-reddit-blue/10' }}">
                                            @if($notification->type === 'like')
                                                <svg class="w-6 h-6 text-reddit-orange" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                                </svg>
                                            @elseif($notification->type === 'comment')
                                                <svg class="w-6 h-6 text-reddit-blue" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                                                </svg>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-lg font-semibold text-slate-900">{{ $notification->title }}</h3>
                                            @if(!$notification->isRead())
                                                <div class="flex items-center space-x-2">
                                                    <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                                    <span class="text-xs font-medium text-blue-600">New</span>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="text-slate-600 mt-1">{{ $notification->message }}</p>
                                        <div class="flex items-center justify-between mt-3">
                                            <span class="text-sm text-slate-500">{{ $notification->created_at->diffForHumans() }}</span>
                                            <div class="flex items-center space-x-3">
                                                @if(isset($notification->data['post_id']))
                                                    <a href="{{ route('posts.show', $notification->data['post_id']) }}"
                                                       onclick="markAsRead({{ $notification->id }})"
                                                       class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                                                        View Post
                                                    </a>
                                                @endif

                                                @if(!$notification->isRead())
                                                    <button onclick="markAsRead({{ $notification->id }})"
                                                            class="text-sm text-slate-600 hover:text-slate-800">
                                                        Mark as Read
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="card">
                    <div class="card-body text-center py-16">
                        <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-3">No Notifications</h3>
                        <p class="text-slate-600 mb-8 max-w-md mx-auto">
                            You're all caught up! When someone likes or comments on your posts, you'll see notifications here.
                        </p>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                            <a href="{{ route('posts.index') }}" class="btn-primary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                View Posts
                            </a>
                            <a href="{{ route('posts.create') }}" class="btn-secondary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Create Post
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        async function markAsRead(notificationId) {
            try {
                const response = await fetch(`/notifications/${notificationId}/read`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (response.ok) {
                    const notificationElement = document.getElementById(`notification-${notificationId}`);
                    if (notificationElement) {
                        notificationElement.classList.remove('ring-2', 'ring-blue-500', 'ring-opacity-20', 'bg-blue-50/30');
                        const newBadge = notificationElement.querySelector('.text-blue-600');
                        if (newBadge) newBadge.remove();
                        const markButton = notificationElement.querySelector('button[onclick*="markAsRead"]');
                        if (markButton) markButton.remove();
                    }
                    showToast('Notification marked as read', 'success');
                }
            } catch (error) {
                console.error('Error marking notification as read:', error);
                showToast('Failed to mark notification as read', 'error');
            }
        }

        async function markAllAsRead() {
            try {
                const response = await fetch('/notifications/mark-all-read', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
        </div>

        <x-slot name="leftSidebar">
            <div class="space-y-4">
                <!-- Community Stats -->
                <div class="reddit-card">
                    <div class="p-4">
                        <h4 class="font-bold text-neutral-900 mb-3">Your Activity</h4>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-neutral-600">Total Notifications</span>
                                <span class="font-bold text-reddit-orange">{{ $notifications->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-neutral-600">Unread</span>
                                <span class="font-bold text-reddit-blue">{{ $unreadCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="rightSidebar">
            <div class="space-y-4">
                <!-- Quick Actions -->
                <div class="reddit-card">
                    <div class="p-4">
                        <h4 class="font-bold text-neutral-900 mb-3">Quick Actions</h4>
                        <div class="space-y-2">
                            <a href="{{ route('dashboard') }}" class="reddit-btn reddit-btn-outline w-full">
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    <span>Dashboard</span>
                                </div>
                            </a>
                            <a href="{{ route('posts.index') }}" class="reddit-btn reddit-btn-outline w-full">
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                    <span>View Posts</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <script>
            async function markAllAsRead() {
                try {
                    const response = await fetch('{{ route('notifications.mark-all-read') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    if (response.ok) {
                        // Refresh the page to show updated state
                        window.location.reload();
                    }
                } catch (error) {
                    console.error('Error marking all notifications as read:', error);
                    showToast('Failed to mark all notifications as read', 'error');
                }
            }
        </script>
    </x-reddit-layout>
</x-app-layout>
