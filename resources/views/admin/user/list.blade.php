<x-app-layout>
    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">

        <div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md">
            {{-- <div class="flex justify-center items-center w-12 bg-blue-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                    </path>
                </svg>
            </div> --}}

            {{-- <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-blue-500">Info</span>
                    <p class="text-sm text-gray-600">Sample table page</p>
                </div>
            </div> --}}
        </div>
        <a href="{{ route('users.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-right mb-4">
            Add User
        </a>
        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            @if (Session::has('success'))
                <div class="text-green-500 text-[20px] mt-1  p-[10px]" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Roles</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($users as $user)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->id }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->email }}
                                </td>
                                 {{-- get the names of the user's roles --}}
                                <td class="px-4 py-3 text-sm">
                                    @if(!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $rolename)
                                        <span
                                            class="bg-blue-200 text-blue-800 text-[16px] font-semibold mr-2 px-2.5 py-0.5 rounded">
                                            {{ $rolename }}
                                        </span>
                                    @endforeach
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="bg-blue-600  px-[15px] py-[5px] rounded-md text-white mr-[30px] hover:bg-blue-800">Edit</a>
                                    <a href="{{ route('users.delete', $user->id) }}"
                                        class="bg-red-600  px-[15px] py-[5px] rounded-md mr-[30px] text-white  hover:bg-red-800"
                                        onclick="alert('Are you sure to delete this product')">Delete</a>
                                    <a href="{{ route('users.show', $user->id) }}"
                                        class="bg-green-600  px-[15px] py-[5px] rounded-md text-white  hover:bg-green-800">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $users->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
