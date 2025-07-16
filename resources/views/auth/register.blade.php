<x-guest-layout>
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Create Your Account ✨</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" class="text-gray-700 font-medium" />
                    <x-text-input id="name" class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                    <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Register Button -->
                <div>
                    <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Log in</a>
            </div>
        </div>
</x-guest-layout>
