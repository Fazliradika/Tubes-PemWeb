<x-guest-layout>
    <div class="mb-6 text-center lg:text-left">
        <h2 class="text-3xl font-bold text-white">Buat Akun Baru 🚀</h2>
        <p class="mt-2 text-sm text-gray-400">Daftar sekarang untuk mengakses layanan kesehatan</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Display general registration error -->
        @if ($errors->has('registration'))
            <div class="mb-4 bg-red-900/50 border border-red-500 text-red-200 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $errors->first('registration') }}</span>
            </div>
        @endif

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-300" />
            <x-text-input id="name" class="block mt-1 w-full bg-gray-800 border-gray-700 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input id="email" class="block mt-1 w-full bg-gray-800 border-gray-700 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone (Optional)')" class="text-gray-300" />
            <x-text-input id="phone" class="block mt-1 w-full bg-gray-800 border-gray-700 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500" type="text" name="phone" :value="old('phone')" autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Hidden Role - Always Patient -->
        <input type="hidden" name="role" value="patient">

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-300" />

            <x-text-input id="password" class="block mt-1 w-full bg-gray-800 border-gray-700 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-300" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-gray-800 border-gray-700 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="ms-4 w-full justify-center bg-blue-600 hover:bg-blue-700 text-white border-transparent">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <!-- Login Link -->
        <div class="mt-8 text-center border-t border-gray-700 pt-6">
            <p class="text-sm text-gray-500">
                {{ __('Already have an account?') }}
                <a class="font-semibold text-blue-500 hover:text-blue-400 hover:underline transition-colors" href="{{ route('login') }}">
                    {{ __('Login here') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
