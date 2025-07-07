{{-- resources/views/posts/create.blade.php --}}
<x-app-layout>
    <x-reddit-layout>
        <!-- Page Header -->
        <div class="reddit-card">
            <div class="p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-reddit-orange rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-neutral-900">Create Post</h1>
                        <p class="text-neutral-600">Share your thoughts with the community</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-neutral-700 mb-2">
                                Title
                            </label>
                            <input type="text" name="title" id="title"
                                   class="w-full px-4 py-3 border border-neutral-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-reddit-orange focus:border-reddit-orange"
                                   value="{{ old('title') }}" required
                                   placeholder="Enter a compelling title...">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-neutral-700 mb-2">
                                Content
                            </label>
                            <textarea name="content" id="content" rows="12"
                                      class="w-full px-4 py-3 border border-neutral-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-reddit-orange focus:border-reddit-orange resize-none"
                                      required
                                      placeholder="What's on your mind? Share your story, ask a question, or start a discussion...">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-neutral-200">
                            <div class="flex items-center space-x-4">
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm text-neutral-600 hover:text-neutral-800 hover:bg-neutral-100 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Add Image
                                </button>
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm text-neutral-600 hover:text-neutral-800 hover:bg-neutral-100 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                    </svg>
                                    Add Link
                                </button>
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('posts.index') }}"
                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-neutral-600 hover:text-neutral-800 hover:bg-neutral-100 rounded-lg transition-colors">
                                    Cancel
                                </a>
                                <button type="submit"
                                        class="inline-flex items-center px-6 py-2 bg-reddit-orange text-white rounded-lg hover:bg-orange-600 transition-colors font-medium">
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
        <div class="reddit-card">
            <div class="p-4">
                <h3 class="font-bold text-neutral-900 mb-3">Writing Tips</h3>
                <div class="space-y-2 text-sm text-neutral-600">
                    <div class="flex items-start space-x-2">
                        <div class="w-1 h-1 bg-neutral-400 rounded-full mt-2"></div>
                        <span>Keep your title clear and descriptive</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <div class="w-1 h-1 bg-neutral-400 rounded-full mt-2"></div>
                        <span>Use proper formatting for better readability</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <div class="w-1 h-1 bg-neutral-400 rounded-full mt-2"></div>
                        <span>Be respectful and constructive</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <div class="w-1 h-1 bg-neutral-400 rounded-full mt-2"></div>
                        <span>Consider your audience and community guidelines</span>
                    </div>
                </div>
            </div>
        </div>
    </x-reddit-layout>
</x-app-layout>
