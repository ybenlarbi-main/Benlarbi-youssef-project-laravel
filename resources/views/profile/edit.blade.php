<x-app-layout>
    <x-reddit-layout>
        <div class="space-y-6">
            <!-- Profile Settings Header -->
            <div class="reddit-card">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-neutral-900 mb-2">Profile Settings</h1>
                    <p class="text-neutral-600">Manage your account settings and preferences.</p>
                </div>
            </div>

            <!-- Update Profile Information -->
            <div class="reddit-card">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-neutral-900 mb-4">Profile Information</h2>
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Update Password -->
            <div class="reddit-card">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-neutral-900 mb-4">Update Password</h2>
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="reddit-card">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-red-600 mb-4">Delete Account</h2>
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </x-reddit-layout>
</x-app-layout>
