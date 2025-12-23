<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Photo') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your profile photo.") }}
        </p>
    </header>

    <div class="mt-6">
        <!-- Current Photo -->
        @if ($user->profile_photo)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                     alt="Profile Photo" 
                     class="w-32 h-32 rounded-full object-cover border-4 border-gray-200">
            </div>
        @else
            <div class="mb-4">
                <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        @endif

        <!-- Upload Form -->
        <form method="post" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="profile_photo" :value="__('Choose Photo')" />
                <input id="profile_photo" 
                       name="profile_photo" 
                       type="file" 
                       class="mt-1 block w-full text-sm text-gray-900 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-900 focus:outline-none" 
                       accept="image/*"
                       required />
                <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">JPG, PNG (Max: 2MB)</p>
            </div>

            <div class="flex items-center gap-4 mt-4">
                <x-primary-button>{{ __('Upload Photo') }}</x-primary-button>

                @if (session('status') === 'photo-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Photo updated.') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>
