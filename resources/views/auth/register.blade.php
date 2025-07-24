<x-guest-layout>
    <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
            <img aria-hidden="true" class="object-cover w-full h-full"
                src="{{ asset('images/create-account-office.jpeg') }}" alt="Office" />
        </div>

        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
                <h1 class="mb-4 text-xl font-semibold text-gray-700">
                    Create account
                </h1>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input type="text" id="name" name="name" class="block w-full"
                            value="{{ old('name') }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input name="email" type="email" class="block w-full" value="{{ old('email') }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4 relative">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" type="password" name="password" class="block w-full pr-10"
                            required />
                        <span onclick="togglePassword('password')"
                            class="absolute inset-y-0 right-0 pr-3 mt-4 flex items-center cursor-pointer">
                            <svg id="eyeClosed-password" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-6-10-6s1.79-2.552 4.652-4.25M9.88 9.88a3 3 0 104.24 4.24M15 15l3.586 3.586M3 3l18 18" />
                            </svg>
                            <svg id="eyeOpen-password" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-gray-600 hidden" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mt-4 relative">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                            class="block w-full pr-10" required />
                        <span onclick="togglePassword('password_confirmation')"
                            class="absolute inset-y-0 right-0 pr-3 flex mt-4 items-center cursor-pointer">
                            <svg id="eyeClosed-password_confirmation" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-6-10-6s1.79-2.552 4.652-4.25M9.88 9.88a3 3 0 104.24 4.24M15 15l3.586 3.586M3 3l18 18" />
                            </svg>
                            <svg id="eyeOpen-password_confirmation" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-gray-600 hidden" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>


                    <div class="mt-4">
                        <x-primary-button class="block w-full">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>

                <hr class="my-8" />

                <p class="mt-4">
                    <a class="text-sm font-medium text-primary-600 hover:underline"
                        href="{{ route('login') }}">{{ __('Already registered?') }}</a>
                </p>
            </div>
        </div>

        @section('scripts')
            <script>
                console.log('hello');

                function togglePassword(fieldId) {
                    const input = document.getElementById(fieldId);
                    const eyeClosed = document.getElementById("eyeClosed-" + fieldId);
                    const eyeOpen = document.getElementById("eyeOpen-" + fieldId);

                    const isHidden = input.type === "password";
                    input.type = isHidden ? "text" : "password";
                    eyeClosed.classList.toggle("hidden", isHidden);
                    eyeOpen.classList.toggle("hidden", !isHidden);
                }
            </script>
        @endsection
</x-guest-layout>
