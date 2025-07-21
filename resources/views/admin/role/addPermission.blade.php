<x-app-layout>
    <x-slot name="header">
        {{ __('Add Role To Permission') }}
    </x-slot>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">

            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('role.list') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back
                </a>
            </div>
            @if (Session::has('success'))
                <div class="text-green-500 text-sm mt-1 p-[20px]" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <!-- Role Name Section -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold leading-tight text-gray-800">Role: {{ $role->name }}</h2>
            </div>

            <!-- Permissions Form -->
            <form action="{{ route('give.role.permission', $role->id) }}" method="POST">
                @csrf
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Assign Permissions</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($permissions as $permission)
                            <div class="flex items-center">
                                <input type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                    id="{{ $permission->id }}"
                                    class="w-4 h-4 text-blue-600 border-gray-600 rounded focus:ring-blue-500"
                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                <label for="{{ $permission->id }}"
                                    class="ml-2 text-sm font-medium text-gray-700">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                            Save Permissions
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
