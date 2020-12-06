<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('First name (if there are several people with your name, add the first initial of your last name)') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email (must be @student.uwcdilijan.am!!!)') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            <div class="mt-4">
                <x-jet-label for="bio" value="{{ __('Bio') }}" />
                <x-jet-input id="bio" class="block mt-1 w-full" type="textbox" name="bio" :value="old('bio')" required />
            </div>
            <div class="mt-4">
                <x-jet-label for="interests" value="{{ __('Interests (what do you like doing?)') }}" />
                <x-jet-input id="interests" class="block mt-1 w-full" type="textbox" name="interests" :value="old('interests')" required />
            </div>
            <div class="mt-4">
                <x-jet-label for="preference" value="{{ __('Preferences (what are you looking for?)') }}" />
                <x-jet-input id="preference" class="block mt-1 w-full" type="textarea" name="preference" :value="old('preference')" required />
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
