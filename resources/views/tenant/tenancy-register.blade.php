<x-guest-layout>
    <form method="POST" action="{{ route('post-register') }}">
        @csrf
        <!-- Company -->
        <div>
            <x-input-label for="company" :value="__('Company Name')" />
            <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')"
                placeholder="ABC" required autofocus autocomplete="company" />
            <x-input-error :messages="$errors->get('company')" class="mt-2" />
        </div>

        <!-- Domain -->
        <div>
            <x-input-label for="domain" :value="__('Tenant Domain')" />

            <div class="flex item-baseline">
                <x-text-input id="domain" class="block mt-2 mr-1 w-full" type="text" name="domain"
                    :value="old('domain')" placeholder="abc" required autofocus autocomplete="domain" />
                <span class="mt-3"> .{{ config('tenancy.central_domains')[1] }}</span>
            </div>

        </div>
        <!-- Name -->

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                placeholder="Tenant Name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                placeholder="abc@gmail.com" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
      
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                placeholder="########" minlength="8"
                title="Password will be mimimum 8 or more digits." required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" placeholder="########" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a> --}}

            <x-primary-button class="ms-4">
                {{ __('Tenant Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
