<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- First_name -->
            <div class="mt-4">
                <x-label for="first_name" :value="__('First Name')" />

                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
            </div>

            <!-- Last_name -->
            <div class="mt-4">
                <x-label for="last_name" :value="__('Last Name')" />

                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />
            </div>

            <!-- Middle_name -->
            <div class="mt-4">
                <x-label for="middle_name" :value="__('Middle Name')" />

                <x-input id="middle_name" class="block mt-1 w-full" type="text" name="middle_name" :value="old('middle_name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <!-- City -->
            <div class="mt-4">
                <x-label for="city" :value="__('City')" />

                <x-input id="city" class="block mt-1 w-full" type="text" name="city" required />
            </div>

            <!-- Street -->
            <div class="mt-4">
                <x-label for="street" :value="__('Street')" />

                <x-input id="street" class="block mt-1 w-full" type="text" name="street" required />
            </div>

            <!-- Home -->
            <div class="mt-4">
                <x-label for="home" :value="__('Home')" />

                <x-input id="home" class="block mt-1 w-full" type="text" name="home" required />
            </div>

            <!-- Group -->
            <div class="mt-4">
                <h3> Выберите из списка необходимую группу</h3>
                <p>
                    <x-input.select :groups="$groups" />
                </p>
            </div>

            <!-- Role -->
            <select name="role_id" class="form-select mb-3 lead" style="max-width: max-content;">
                <option value=1> Администратор</option>
                <option value=2> Учитель</option>
                <option value=3 selected> Студент</option>
            </select>

            <!-- Birthday -->
            <div class="mt-4">
                <h3> Укажите день рождения </h3>
                <input type="date" name="birthday" size="18" class="form-control" style="max-width:max-content ;" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>

        </form>
    </x-auth-card>
</x-guest-layout>