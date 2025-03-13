<x-guest-layout>

    <div class="text-center mb-6 mt-10">
        <h1 class="text-2xl font-semibold text-gray-900">SISTEM INFORMASI REKAM MEDIK</h1>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}" class="space-y-6  mb-20">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="username" :value="__('Username')" class="text-gray-700" />
            <x-text-input id="text" class="block mt-2 w-full px-4 py-2 bg-main rounded-lg" type="text"
                name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
            <x-text-input id="password"
                class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6 text-center">
            <x-b-primary-button class="w-1/2 justify-center py-3 bg-blue-600 hover:bg-blue-700 rounded">
                {{ __('Log in') }}
            </x-b-primary-button>
        </div>
    </form>
</x-guest-layout>
