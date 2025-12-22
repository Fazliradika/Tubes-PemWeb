<x-guest-layout>
    <!-- Header -->
    <div class="mb-6 text-center lg:text-left">
        <h2 class="text-3xl font-bold text-white">Selamat Datang 👋</h2>
        <p class="mt-2 text-sm text-gray-400">Silakan masuk ke akun Anda untuk melanjutkan</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email" class="block mt-1 w-full bg-gray-800 border-gray-700 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-white" />

            <x-text-input id="password" class="block mt-1 w-full bg-gray-800 border-gray-700 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 mb-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-700 bg-gray-800 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col gap-4">
            <x-primary-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700 text-white border-transparent text-lg font-semibold rounded-lg">
                {{ __('Log in') }}
            </x-primary-button>

            @if (Route::has('password.request'))
                <div class="text-right">
                    <a class="underline text-sm text-gray-400 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
            @endif
        </div>

        <!-- Register Link -->
        <div class="mt-8 text-center border-t border-gray-700 pt-6">
            <p class="text-sm text-gray-500">
                {{ __("Don't have an account?") }}
                <a class="font-semibold text-blue-500 hover:text-blue-400 hover:underline transition-colors" href="{{ route('register') }}">
                    {{ __('Register here') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
