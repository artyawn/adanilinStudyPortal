<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('FIO')" />
                <x-text-input id="fio" class="block mt-1 w-full" type="text" name="fio" :value="old('fio')" required autofocus />
                <x-input-error :messages="$errors->get('fio')" class="mt-2" />
            </div>

            <!-- GroupSelect -->
                <div class="mt-4">
                    <x-input-label for="group_id" :value="__('Group')" />
                    <x-group-select id="group_id" class="block mt-1 w-full" type="text" name="group_id" :value="old('group_id')" required ></x-group-select>
                    <x-input-error :messages="$errors->get('group_id')" class="mt-2" />
                </div>

            <!-- RoleSelect -->
            <div class="mt-4">
                <x-input-label for="role" :value="__('Role')" />
                <x-role-select id="role" class="block mt-1 w-full" type="int" name="role" :value="old('role')" required ></x-role-select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
