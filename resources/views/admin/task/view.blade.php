<x-app-layout>
    <x-slot name="header">
        {{ __('View Task Details') }}
    </x-slot>

    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white shadow-lg rounded-2xl p-6 md:p-8">
            <div class="flex flex-col md:flex-row items-center gap-6 mb-6">
                @if ($task->images)
                    <img src="{{ asset($task->images) }}" alt="{{ $task->title }}"
                        class="w-full md:w-60 rounded-xl shadow-md object-cover h-48">
                @else
                    <div
                        class="w-full md:w-60 h-48 bg-gray-200 rounded-xl flex items-center justify-center text-gray-500">
                        No Image
                    </div>
                @endif

                <div class="flex-1">
                    <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-2">{{ $task->title }}</h2>
                    <p class="text-gray-600">{{ $task->description }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm md:text-base">
                <div>
                    <strong>Status:</strong>
                    <span
                        class="inline-block ml-2 px-2 py-1 rounded-full
                    {{ $task->status->name === 'Completed' ? 'bg-green-100 text-green-700' : ($task->status->name === 'In Progress' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                        {{ $task->status->name }}
                    </span>
                </div>

                <div>
                    <strong>Priority:</strong>
                    <span class="ml-2 text-gray-800">{{ ucfirst($task->priority) }}</span>
                </div>

                <div>
                    <strong>Created By:</strong>
                    <span class="ml-2 text-gray-800">{{ $task->creator->name }}</span>
                </div>


                <div>
                    <strong>Assigned To:</strong>
                    <span class="ml-2 text-gray-800">
                        @foreach ($task->assignedUsers as $user)
                            <li>{{ $user->name }}</li>
                        @endforeach
                    </span>
                </div>

                <div>
                    <strong>Assigned Date:</strong>
                    <span
                        class="ml-2 text-gray-800">{{ \Carbon\Carbon::parse($task->assigned_date)->format('d M Y') }}</span>
                </div>

                <div>
                    <strong>Completed Date:</strong>
                    <span class="ml-2 text-gray-800">
                        {{ $task->completed_date ? \Carbon\Carbon::parse($task->completed_date)->format('d M Y') : 'N/A' }}
                    </span>
                </div>
            </div>

            <div class="mt-8">
                <a href="{{ route('task.list') }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                    Back to Tasks
                </a>
            </div>
        </div>
    </div>

</x-app-layout>
