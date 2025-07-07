{{-- resources/views/ai-posts/preview.blade.php --}}
<x-app-layout>
    <x-reddit-layout>
        <div class="space-y-6">
            <!-- Success Header -->
            <div class="reddit-card">
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-neutral-900">Content Generated Successfully!</h1>
                            <p class="text-neutral-600">Review your AI-generated post before publishing</p>
                        </div>
                    </div>

                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <p class="text-sm text-purple-700">
                            <strong>Your Prompt:</strong> "{{ $prompt }}"
                        </p>
                    </div>
                </div>
            </div>

            <!-- Preview Section -->
            <div class="reddit-card">
                <div class="p-6">
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="w-5 h-5 text-reddit-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <h2 class="text-lg font-semibold text-neutral-900">Preview</h2>
                    </div>
                    <!-- Reddit-style Post Preview -->
                    <div class="reddit-post">
                        <!-- Voting Column -->
                        <div class="reddit-vote-column">
                            <button class="reddit-vote-btn reddit-upvote">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            <span class="reddit-vote-count">0</span>
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
                                    Posted by u/{{ auth()->user()->name }} • Just now
                                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                        </svg>
                                        AI
                                    </span>
                                </span>
                            </div>

                            <h3 class="reddit-post-title" id="preview-title">{{ $title }}</h3>

                            <div class="reddit-post-body mt-4" id="preview-content">
                                {!! App\Utils\ContentFormatter::formatContent($content) !!}
                            </div>

                            <!-- Post Actions -->
                            <div class="reddit-post-actions">
                                <button class="reddit-action-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    0 Comments
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

                    <p class="text-sm text-neutral-500 mt-4">
                        This is exactly how your post will appear to other users.
                    </p>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="reddit-card">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-neutral-900 mb-4">Review & Edit</h2>

                    <form method="POST" action="{{ route('ai-posts.store') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-neutral-700 mb-2">
                                Title <span class="text-neutral-500">(you can edit this)</span>
                            </label>
                            <input type="text" name="title" id="title"
                                   class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-reddit-orange focus:border-reddit-orange"
                                   value="{{ old('title', $title) }}" required
                                   onchange="updatePreviewTitle(this.value)">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-neutral-700 mb-2">
                                Generated Content <span class="text-neutral-500">(you can edit this)</span>
                            </label>
                            <textarea name="content" id="content" rows="12"
                                      class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-reddit-orange focus:border-reddit-orange"
                                      required
                                      onchange="updatePreviewContent(this.value)">{{ old('content', $content) }}</textarea>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-neutral-500">
                                Review and edit the generated content as needed before publishing. The preview above updates as you edit.
                            </p>
                        </div>

                        <div class="mb-6 bg-purple-50 border border-purple-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm text-purple-700 font-medium">
                                    This post will be marked as AI-generated
                                </span>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <a href="{{ route('ai-posts.create') }}"
                               class="inline-flex items-center px-6 py-3 text-sm font-medium text-neutral-600 bg-neutral-100 hover:bg-neutral-200 rounded-full transition-colors">
                                Generate New Content
                            </a>
                            <div class="space-x-3">
                                <button type="submit"
                                        class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 rounded-full transition-colors">
                                    Publish Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-reddit-layout>

    <script>
        function updatePreviewTitle(title) {
            const previewTitle = document.getElementById('preview-title');
            if (previewTitle) {
                previewTitle.textContent = title;
            }
        }

        function updatePreviewContent(content) {
            const previewContent = document.getElementById('preview-content');
            if (previewContent) {
                // Simple client-side formatting (basic)
                let formatted = content
                    .replace(/\*\*([^*]+)\*\*/g, '<strong>$1</strong>')
                    .replace(/\*([^*]+)\*/g, '<em>$1</em>')
                    .replace(/#(\w+)/g, '<span class="inline-block bg-blue-100 text-blue-800 text-sm px-2 py-1 rounded mr-1">#$1</span>');

                previewContent.innerHTML = formatted.replace(/\n/g, '<br>');
            }
        }
    </script>
</x-app-layout>
