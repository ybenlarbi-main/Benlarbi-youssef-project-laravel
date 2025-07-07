{{-- resources/views/invitations/index.blade.php --}}
<x-app-layout>
    <x-reddit-layout>
        <div class="space-y-6">
            <!-- Page Header -->
            <div class="card card-elevated">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-neutral-900">Network Invitations</h1>
                            <p class="text-neutral-600 mt-1">Manage your connection requests and grow your network</p>
                        </div>
                        <a href="{{ route('invitations.create') }}" class="btn-primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Send Invitation
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-brand-400 to-brand-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-neutral-900">{{ auth()->user()->getAllConnections()->count() }}</div>
                        <div class="text-sm text-neutral-500">Active Connections</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body text-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-success-400 to-success-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-neutral-900">{{ $receivedInvitations->count() }}</div>
                        <div class="text-sm text-neutral-500">Received Invites</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body text-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-neutral-900">{{ $sentInvitations->count() }}</div>
                        <div class="text-sm text-neutral-500">Sent Invites</div>
                    </div>
                </div>
            </div>

            <!-- Received Invitations -->
            @if($receivedInvitations->count() > 0)
                <div class="card card-elevated">
                    <div class="card-header">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="p-2 bg-gradient-to-br from-success-400 to-success-600 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7"/>
                                    </svg>
                                </div>
                                <h3 class="ml-3 text-lg font-semibold text-neutral-900">
                                    Received Invitations
                                </h3>
                            </div>
                            <span class="badge badge-success">{{ $receivedInvitations->count() }} pending</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="space-y-4">
                            @foreach($receivedInvitations as $invitation)
                                <div class="card hover:shadow-medium transition-all duration-200">
                                    <div class="card-body-sm">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-4">
                                                <div class="w-12 h-12 bg-gradient-to-br from-brand-500 to-brand-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                                    {{ strtoupper(substr($invitation->sender->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-neutral-900">{{ $invitation->sender->name }}</p>
                                                    <p class="text-sm text-neutral-600">{{ $invitation->sender->email }}</p>
                                                    <div class="flex items-center mt-1 text-xs text-neutral-500">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        Sent {{ $invitation->created_at->diffForHumans() }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <form method="POST" action="{{ route('invitations.accept', $invitation) }}" class="inline"
                                                      onsubmit="showLoading('Accepting invitation...')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn-success btn-sm"
                                                            onclick="showToast('Connection request accepted! 🎉', 'success')">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        Accept
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('invitations.decline', $invitation) }}" class="inline"
                                                      onsubmit="showLoading('Declining invitation...')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn-danger btn-sm"
                                                            onclick="showToast('Invitation declined', 'info')">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                        Decline
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Sent Invitations -->
            @if($sentInvitations->count() > 0)
                <div class="card card-elevated">
                    <div class="card-header">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="p-2 bg-gradient-to-br from-warning-400 to-warning-600 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                </div>
                                <h3 class="ml-3 text-lg font-semibold text-neutral-900">
                                    Sent Invitations
                                </h3>
                            </div>
                            <span class="badge badge-pending">{{ $sentInvitations->count() }} pending</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="space-y-4">
                            @foreach($sentInvitations as $invitation)
                                <div class="card hover:shadow-medium transition-all duration-200">
                                    <div class="card-body-sm">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-4">
                                                <div class="w-12 h-12 bg-gradient-to-br from-neutral-400 to-neutral-600 rounded-full flex items-center justify-center text-white font-semibold text-lg">
                                                    {{ strtoupper(substr($invitation->receiver->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-neutral-900">{{ $invitation->receiver->name }}</p>
                                                    <p class="text-sm text-neutral-600">{{ $invitation->receiver->email }}</p>
                                                    <div class="flex items-center mt-1 text-xs text-neutral-500">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        Sent {{ $invitation->created_at->diffForHumans() }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <span class="badge badge-pending">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    Awaiting Response
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Empty States -->
            @if($receivedInvitations->count() === 0 && $sentInvitations->count() === 0)
                <div class="card">
                    <div class="card-body text-center py-16">
                        <div class="w-20 h-20 bg-gradient-to-br from-neutral-100 to-neutral-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-neutral-900 mb-2">No Pending Invitations</h3>
                        <p class="text-neutral-600 mb-8 max-w-md mx-auto">Start building your network by sending connection requests to other users.</p>
                        <a href="{{ route('invitations.create') }}" class="btn-primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Send Your First Invitation
                        </a>
                    </div>
                </div>
            @endif

            <!-- Active Connections Preview -->
            @if(auth()->user()->getAllConnections()->count() > 0)
                <div class="card card-elevated">
                    <div class="card-header">
                        <div class="flex items-center">
                            <div class="p-2 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-semibold text-neutral-900">
                                Your Network ({{ auth()->user()->getAllConnections()->count() }} connections)
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach(auth()->user()->getAllConnections()->take(6) as $connection)
                                <div class="card hover:shadow-medium transition-all duration-200">
                                    <div class="card-body-sm">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-success-500 to-brand-600 rounded-full flex items-center justify-center text-white font-semibold">
                                                {{ strtoupper(substr($connection->name, 0, 1)) }}
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="font-medium text-neutral-900 truncate">{{ $connection->name }}</p>
                                                <p class="text-sm text-neutral-500 truncate">{{ $connection->email }}</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <span class="badge badge-success">Connected</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if(auth()->user()->getAllConnections()->count() > 6)
                            <div class="mt-6 text-center">
                                <p class="text-sm text-neutral-500">
                                    And {{ auth()->user()->getAllConnections()->count() - 6 }} more connections...
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </x-reddit-layout>
</x-app-layout>
