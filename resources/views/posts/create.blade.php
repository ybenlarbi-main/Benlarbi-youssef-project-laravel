{{-- resources/views/posts/create.blade.php --}}
<x-app-layout>
    <x-reddit-layout>
        <!-- Page Header -->
        <div class="card card-elevated">
            <div class="card-header">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-600 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-neutral-900">Create Post</h1>
                        <p class="text-neutral-600">Share your thoughts with the community</p>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf

                    <div class="space-y-6">
                        <div class="form-group">
                            <label for="title" class="form-label">
                                Title
                            </label>
                            <input type="text" name="title" id="title"
                                   class="form-input"
                                   value="{{ old('title') }}" required
                                   placeholder="Enter a compelling title...">
                            @error('title')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content" class="form-label">
                                Content
                            </label>
                            <textarea name="content" id="content" rows="12"
                                      class="form-textarea"
                                      required
                                      placeholder="What's on your mind? Share your story, ask a question, or start a discussion...">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between pt-6 border-t border-neutral-200">
                            <div class="flex items-center space-x-3">
                                <button type="button" class="btn-ghost btn-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Add Image
                                </button>
                                <button type="button" class="btn-ghost btn-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                    </svg>
                                    Add Link
                                </button>
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('posts.index') }}" class="btn-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn-primary">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Post
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Writing Tips -->
        <div class="card">
            <div class="card-header">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-warning-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    <h3 class="font-semibold text-neutral-900">Writing Tips</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-gradient-to-r from-brand-400 to-brand-600 rounded-full mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p class="text-sm font-medium text-neutral-800">Be specific</p>
                            <p class="text-xs text-neutral-600 mt-0.5">Include details, names, places, and emotions</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-gradient-to-r from-success-400 to-success-600 rounded-full mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p class="text-sm font-medium text-neutral-800">Add context</p>
                            <p class="text-xs text-neutral-600 mt-0.5">Explain why this topic matters to you</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-gradient-to-r from-purple-400 to-purple-600 rounded-full mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p class="text-sm font-medium text-neutral-800">Include questions</p>
                            <p class="text-xs text-neutral-600 mt-0.5">Engage your audience with thought-provoking questions</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-gradient-to-r from-warning-400 to-warning-600 rounded-full mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p class="text-sm font-medium text-neutral-800">Be respectful</p>
                            <p class="text-xs text-neutral-600 mt-0.5">Consider your audience and community guidelines</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-reddit-layout>
</x-app-layout>
