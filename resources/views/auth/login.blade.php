<x-guest-layout>
    <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
            <img aria-hidden="true" class="object-cover w-full h-full" src="{{ asset('images/login-office.jpeg') }}"
                alt="Office" />
        </div>
        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
                <h1 class="mb-4 text-xl font-semibold text-gray-700">
                    Login
                </h1>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Input[ype="email"] -->
                    <div class="mt-4">
                        <x-input-label :value="__('Email')" />
                        <x-text-input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="block w-full" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Input[type="password"] with eye toggle -->
                    <div class="mt-4 relative">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input type="password" id="password" name="password" class="block w-full pr-10" />

                        <!-- Eye Icon -->
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-2 top-9 text-gray-500 focus:outline-none">
                            <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-4.477-10-10 0-1.25.23-2.45.648-3.562M5.634 5.634L18.366 18.366M9.88 9.88a3 3 0 104.24 4.24" />
                            </svg>
                            <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="flex mt-6 text-sm">
                        <label class="flex items-center dark:text-gray-400">
                            <input type="checkbox" name="remember"
                                class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple">
                            <span class="ml-2">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="mt-4">
                        <x-primary-button class="block w-full">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>

                <hr class="my-8" />

                @if (Route::has('password.request'))
                    <p class="mt-4">
                        <a class="text-sm font-medium text-primary-600 hover:underline"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    </p>
                @endif
            </div>
        </div>
    </div>


    @section('scripts')
        <script>
            console.log('hello');
            function togglePassword() {
                const passwordInput = document.getElementById("password");
                const eyeOpen = document.getElementById("eyeOpen");
                const eyeClosed = document.getElementById("eyeClosed");

                const isHidden = passwordInput.type === "password";

                passwordInput.type = isHidden ? "text" : "password";
                eyeOpen.classList.toggle("hidden", !isHidden);
                eyeClosed.classList.toggle("hidden", isHidden);
            }
        </script>
    @endsection

</x-guest-layout>
