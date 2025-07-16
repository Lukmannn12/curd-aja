<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

<div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Welcome Back 👋</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                    <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-4">
                    <label for="remember_me" class="inline-flex items-center text-sm text-gray-600">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <div>
                    <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Register</a>
            </div>
        </div>
</x-guest-layout>
