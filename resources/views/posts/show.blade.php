{{-- resources/views/posts/show.blade.php --}}
<x-app-layout>
    <x-reddit-layout>
        <div class="space-y-4">
            <!-- Back Navigation -->
            <div class="mb-4">
                <a href="{{ route('posts.index') }}"
                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-neutral-600 hover:text-reddit-orange transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m0 7h18"/>
                    </svg>
                    Back to Posts
                </a>
            </div>

            <!-- Main Post -->
            <div class="reddit-post">
                <!-- Voting Column -->
                <div class="reddit-vote-column">
                    <button onclick="toggleLike({{ $post->id }})"
                            id="like-btn-{{ $post->id }}"
                            class="reddit-vote-btn reddit-upvote {{ $post->isLikedBy(auth()->user()) ? 'text-reddit-orange' : '' }}">
                        <svg class="w-5 h-5" fill="{{ $post->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <span class="reddit-vote-count" id="like-count-{{ $post->id }}">{{ $post->likes->count() }}</span>
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
                        @can('update', $post)
                            <div class="ml-auto flex items-center space-x-2">
                                <a href="{{ route('posts.edit', $post) }}" class="text-xs text-neutral-500 hover:text-reddit-orange transition-colors">Edit</a>
                                <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-500 hover:text-red-700 transition-colors"
                                            onclick="return confirm('Are you sure you want to delete this post?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endcan
                    </div>

                    <h1 class="reddit-post-title text-xl font-bold">{{ $post->title }}</h1>

                    @if($post->content)
                        <div class="reddit-post-body mt-4">
                            <div class="prose max-w-none">
                                {!! App\Utils\ContentFormatter::formatContent($post->content) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Post Actions -->
                    <div class="reddit-post-actions mt-6">
                        <button class="reddit-action-btn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <span id="comment-count-{{ $post->id }}">{{ $post->comments->count() }}</span> Comments
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
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="reddit-card">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-neutral-900 mb-4">Comments</h2>

                    <!-- Comment Form -->
                    <form onsubmit="submitComment(event, {{ $post->id }})" class="mb-6">
                        <div class="flex space-x-3">
                            <div class="w-10 h-10 bg-reddit-orange rounded-full flex items-center justify-center text-white font-medium">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <textarea name="content"
                                        id="comment-input-{{ $post->id }}"
                                        placeholder="What are your thoughts?"
                                        rows="3"
                                        class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-reddit-orange focus:border-reddit-orange resize-none"></textarea>
                                <div class="flex justify-end mt-3">
                                    <button type="submit"
                                            class="bg-reddit-orange hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-full transition-colors">
                                        Comment
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Comments List -->
                    <div id="comments-list-{{ $post->id }}" class="space-y-4">
                        @forelse($post->comments()->orderBy('created_at', 'desc')->get() as $comment)
                            <div class="flex space-x-3 p-4 bg-neutral-50 rounded-lg" id="comment-{{ $comment->id }}">
                                <div class="w-8 h-8 bg-reddit-orange rounded-full flex items-center justify-center text-white font-medium text-sm">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium text-neutral-900">u/{{ $comment->user->name }}</span>
                                        <div class="flex items-center space-x-3">
                                            <span class="text-sm text-neutral-500">{{ $comment->created_at->diffForHumans() }}</span>
                                            @if($comment->user_id === auth()->id() || $post->user_id === auth()->id())
                                                <button onclick="deleteComment({{ $comment->id }})"
                                                        class="text-sm text-red-500 hover:text-red-700 transition-colors">
                                                    Delete
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="text-neutral-700">{{ $comment->content }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-neutral-500">
                                <svg class="w-12 h-12 mx-auto mb-4 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                <p>No comments yet. Be the first to comment!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            @if($post->updated_at != $post->created_at)
                <div class="reddit-card">
                    <div class="p-4">
                        <p class="text-sm text-neutral-500">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Last edited {{ $post->updated_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </x-reddit-layout>
                    <style>
        .prose p {
            margin-bottom: 1rem;
        }
        .prose p:last-child {
            margin-bottom: 0;
        }
        .prose strong {
            font-weight: 600;
            color: #1F2937;
        }
        .prose em {
            font-style: italic;
            color: #6B7280;
        }
    </style>

    <script>
        // Toggle Like Function
        async function toggleLike(postId) {
            const likeBtn = document.getElementById(`like-btn-${postId}`);
            const likeCount = document.getElementById(`like-count-${postId}`);
            const heartIcon = likeBtn.querySelector('svg');

            try {
                const isLiked = likeBtn.classList.contains('text-reddit-orange');
                const url = `/posts/${postId}/like`;
                const method = isLiked ? 'DELETE' : 'POST';

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Update UI
                    if (data.liked) {
                        likeBtn.classList.add('text-reddit-orange');
                        likeBtn.classList.remove('text-neutral-400');
                        heartIcon.setAttribute('fill', 'currentColor');
                    } else {
                        likeBtn.classList.remove('text-reddit-orange');
                        likeBtn.classList.add('text-neutral-400');
                        heartIcon.setAttribute('fill', 'none');
                    }

                    likeCount.textContent = data.likes_count;
                } else {
                    alert(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Something went wrong. Please try again.');
            }
        }

        // Submit Comment Function
        async function submitComment(event, postId) {
            event.preventDefault();

            const commentInput = document.getElementById(`comment-input-${postId}`);
            const commentsList = document.getElementById(`comments-list-${postId}`);
            const commentCount = document.getElementById(`comment-count-${postId}`);
            const content = commentInput.value.trim();

            if (!content) {
                alert('Please enter a comment');
                return;
            }

            try {
                const response = await fetch(`/posts/${postId}/comments`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ content: content })
                });

                const data = await response.json();

                if (data.success) {
                    // Create new comment element
                    const commentHtml = `
                        <div class="flex space-x-3 p-4 bg-neutral-50 rounded-lg" id="comment-${data.comment.id}">
                            <div class="w-8 h-8 bg-reddit-orange rounded-full flex items-center justify-center text-white font-medium text-sm">
                                ${data.comment.user_name.charAt(0).toUpperCase()}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-medium text-neutral-900">u/${data.comment.user_name}</span>
                                    <div class="flex items-center space-x-3">
                                        <span class="text-sm text-neutral-500">${data.comment.created_at}</span>
                                        ${data.comment.can_delete ? `<button onclick="deleteComment(${data.comment.id})" class="text-sm text-red-500 hover:text-red-700 transition-colors">Delete</button>` : ''}
                                    </div>
                                </div>
                                <p class="text-neutral-700">${data.comment.content}</p>
                            </div>
                        </div>
                    `;

                    // Add comment to the top of the list
                    commentsList.insertAdjacentHTML('afterbegin', commentHtml);

                    // Update comment count
                    commentCount.textContent = data.comments_count;

                    // Clear input
                    commentInput.value = '';
                } else {
                    alert(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Something went wrong. Please try again.');
            }
        }

        // Delete Comment Function
        async function deleteComment(commentId) {
            if (!confirm('Are you sure you want to delete this comment?')) {
                return;
            }

            try {
                const response = await fetch(`/comments/${commentId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Remove comment from DOM
                    const commentElement = document.getElementById(`comment-${commentId}`);
                    if (commentElement) {
                        commentElement.remove();
                    }

                    // Update comment count
                    const commentCount = document.querySelector('[id^="comment-count-"]');
                    if (commentCount) {
                        commentCount.textContent = data.comments_count;
                    }
                } else {
                    alert(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Something went wrong. Please try again.');
            }
        }
    </script>
</x-app-layout>
