<x-app-layout>
    <x-slot name="header">
        {{ __('Edit User') }}
    </x-slot>

     <a href="{{ route('users.list') }}"
                class="bg-blue-500 w-[70px] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-left mb-4">
                Back
            </a>
    <div class="flex flex-col justify-center items-center overflow-y-auto">
        {{-- <div class="h-32 md:h-auto md:w-1/2">
            <img aria-hidden="true" class="object-cover w-full h-full"
                 src="{{ asset('images/create-account-office.jpeg') }}" alt="Office"/>
        </div> --}}

        <div class="flex flex-col items-center justify-center sm:p-12 md:w-1/2">

            <div class="w-full">
                <h1 class="mb-4 text-xl font-semibold text-gray-700">
                    Edit User
                </h1>

                <form method="POST" action="{{ route('users.update',$user->id) }}">
                    @csrf

                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input type="text" id="name" name="name" class="block w-full"
                            value="{{ $user->name }}"  autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input name="email" type="email" class="block w-full" value="{{ $user->email }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input type="password" name="password" class="block w-full" value  />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label id="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input type="password" name="password_confirmation" class="block w-full"  />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                      <div class="mt-4">
                        <x-input-label for="roles" :value="__('Assign Roles')" />
                        <select name="roles[]" id="roles"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" multiple>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name)?'selected':'' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-primary-button class="block w-full">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>

                <hr class="my-8" />

            </div>
        </div>
</x-app-layout>
