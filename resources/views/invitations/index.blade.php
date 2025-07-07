{{-- resources/views/invitations/index.blade.php --}}
<x-app-layout>
    <x-reddit-layout>
        <div class="space-y-6">
            <!-- Page Header -->
            <div class="reddit-card">
                <div class="p-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-neutral-900">Network Invitations</h1>
                            <p class="text-neutral-600 mt-1">Manage your connection requests and grow your network</p>
                        </div>
                        <a href="{{ route('invitations.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-reddit-orange text-white rounded-full hover:bg-orange-600 transition-colors font-medium">
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
                <div class="reddit-card">
                    <div class="p-4 text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-neutral-900">{{ auth()->user()->getAllConnections()->count() }}</div>
                        <div class="text-sm text-neutral-500">Active Connections</div>
                    </div>
                </div>

                <div class="reddit-card">
                    <div class="p-4 text-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-neutral-900">{{ $receivedInvitations->count() }}</div>
                        <div class="text-sm text-neutral-500">Received Invites</div>
                    </div>
                </div>

                <div class="reddit-card">
                    <div class="p-4 text-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="reddit-card">
                    <div class="p-4 border-b border-neutral-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7"/>
                                    </svg>
                                </div>
                                <h3 class="ml-3 text-lg font-bold text-neutral-900">
                                    Received Invitations
                                </h3>
                            </div>
                            <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-medium">{{ $receivedInvitations->count() }} pending</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="space-y-4">
                            @foreach($receivedInvitations as $invitation)
                                <div class="relative group">
                                    <div class="flex items-center justify-between p-4 bg-neutral-50 rounded-xl border border-neutral-200 hover:border-neutral-300 hover:bg-neutral-100 transition-all duration-200">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 bg-reddit-orange rounded-full flex items-center justify-center text-white font-bold text-lg">
                                                {{ strtoupper(substr($invitation->sender->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-semibold text-slate-900">{{ $invitation->sender->name }}</p>
                                                <p class="text-sm text-slate-600">{{ $invitation->sender->email }}</p>
                                                <div class="flex items-center mt-1 text-xs text-slate-500">
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
                                                <button type="submit"
                                                        class="btn-success"
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
                                                <button type="submit"
                                                        class="btn-secondary text-red-600 hover:text-red-700 hover:bg-red-50 hover:border-red-200"
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
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Sent Invitations -->
            @if($sentInvitations->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="p-2 bg-amber-100 rounded-lg">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                </div>
                                <h3 class="ml-3 text-lg font-semibold text-slate-900">
                                    Sent Invitations
                                </h3>
                            </div>
                            <span class="badge badge-pending">{{ $sentInvitations->count() }} pending</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="space-y-4">
                            @foreach($sentInvitations as $invitation)
                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-200">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-gradient-to-br from-slate-400 to-slate-600 rounded-full flex items-center justify-center text-white font-semibold text-lg">
                                            {{ strtoupper(substr($invitation->receiver->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-900">{{ $invitation->receiver->name }}</p>
                                            <p class="text-sm text-slate-600">{{ $invitation->receiver->email }}</p>
                                            <div class="flex items-center mt-1 text-xs text-slate-500">
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
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Empty States -->
            @if($receivedInvitations->count() === 0 && $sentInvitations->count() === 0)
                <div class="card">
                    <div class="card-body text-center py-12">
                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">No Pending Invitations</h3>
                        <p class="text-slate-600 mb-6">Start building your network by sending connection requests to other users.</p>
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
                <div class="card">
                    <div class="card-header">
                        <div class="flex items-center">
                            <div class="p-2 bg-indigo-100 rounded-lg">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-semibold text-slate-900">
                                Your Network ({{ auth()->user()->getAllConnections()->count() }} connections)
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach(auth()->user()->getAllConnections()->take(6) as $connection)
                                <div class="flex items-center space-x-3 p-3 bg-slate-50 rounded-lg">
                                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr($connection->name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="font-medium text-slate-900 truncate">{{ $connection->name }}</p>
                                        <p class="text-sm text-slate-500 truncate">{{ $connection->email }}</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="badge badge-success">Connected</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if(auth()->user()->getAllConnections()->count() > 6)
                            <div class="mt-4 text-center">
                                <p class="text-sm text-slate-500">
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
