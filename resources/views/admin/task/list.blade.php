<x-app-layout>
    <x-slot name="header">{{ __('Task List') }}</x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-row justify-between w-full mb-4">
            <h2 class="text-2xl font-semibold leading-tight"></h2>
            <a href="{{ route('task.add') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Task
            </a>

        </div>
        @if (Session::has('success'))
            <div class="text-green-500 text-[20px] mt-1  ml-[200px] p-[10px]" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <!-- Filter Section -->
        <form method="GET" action="{{ route('task.list') }}" class="mb-10">
            <div class="flex items-center gap-4">
                <label for="category" class="text-gray-700 font-semibold">Filter by Search:</label>
                <input type="text" name="title" id="search"
                    class="border w-[200px] border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Search here" value="{{ request('title') }}">
                <input type="date" name="date" id="search_date"
                    class="border w-[200px] border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Search here" value="{{ request('date') }}">
                <select name="status" id="search"
                    class="border w-[200px] border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Status</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}" {{ request('status_id') == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Apply Filter
                </button>
                @if (request('title') || request('date') || request('status'))
                    <a href="{{ route('task.list') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Clear
                    </a>
                @endif
            </div>
        </form>



        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($statuses as $status)
                <div class="bg-white rounded shadow p-4" data-status-id="{{ $status->id }}">
                    <h2 class="text-2xl font-bold mb-[32px] text-blue-700">{{ $status->name }}</h2>

                    <div class="tasks-list" id="tasks-list-{{ $status->id }}">
                        @forelse ($status->tasks as $i => $task)
                            <div class="task-card border rounded p-3 mb-3 shadow-sm"
                                style="{{ $i >= 5 ? 'display:none;' : '' }}" data-task-id="{{ $task->id }}">
                                <h3 class="font-bold text-lg">{{ $task->title }}</h3>
                                <p class="mt-2 text-sm text-gray-500">
                                    Created By: <span
                                        class="text-green-500 font-semibold">{{ $task->creator->name ?? 'N/A' }}</span>
                                </p>
                                <p class="mt-2 text-sm text-gray-500">
                                    Assigned Date: <span
                                        class="text-green-500 font-semibold">{{ $task->assigned_date ?? 'N/A' }}</span><br>
                                </p>
                                <p class="mt-2 text-sm text-gray-500">
                                    Assigned: <span class="text-green-500 font-semibold">
                                        @foreach ($task->assignedUsers as $user)
                                            <li>{{ $user->name }}</li>
                                        @endforeach
                                    </span>
                                </p>
                                <p class="mt-2 text-sm text-gray-500">
                                    Completed Date: <span
                                        class="text-green-500 font-semibold">{{ $task->completed_date ?? 'N/A' }}</span>
                                </p>

                                <p class="mt-2 text-sm text-gray-500">
                                    Priority: <span
                                        class="text-green-500 font-semibold">{{ $task->priority ?? 'N/A' }}</span>
                                </p>

                                <div class="mt-2 flex space-x-3">
                                    <a href="{{ route('task.edit', $task->slug) }}"
                                        class="text-blue-600 hover:underline font-semibold">Edit</a>

                                    <a href="{{ route('task.view', $task->slug) }}"
                                        class="text-green-500 hover:text-green-700 hover:underline font-bold mr-2">View</a>
                                    <a href="{{ route('task.delete', $task->slug) }}"
                                        class="text-red-500 hover:text-red-700 hover:underline font-bold"
                                        onclick="alert('Are you sure to delete this task.')">Delete</a>
                                </div>
                            </div>
                        @empty
                            {{-- This placeholder ensures the container remains valid for SortableJS --}}
                            <div class="empty-placeholder text-gray-400 italic text-center py-2">
                                No tasks — drop here
                            </div>
                        @endforelse
                    </div>

                    @if ($status->tasks->count() > 5)
                        <button class="load-more-btn mt-3 px-4 py-2 bg-blue-500 text-white rounded"
                            data-status-id="{{ $status->id }}">
                            Load More
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#search_date').click(function() {
                    $(this)[0].showPicker(); // Trigger the calendar when input is clicked
                });

                $('.load-more-btn').click(function() {
                    let btn = $(this);
                    let statusId = btn.data('status-id');
                    let container = $('#tasks-list-' + statusId);

                    // Find hidden tasks in this container
                    let hiddenTasks = container.find('.task-card:hidden');

                    // Show next 5 hidden tasks
                    hiddenTasks.slice(0, 5).slideDown();

                    // If no more hidden tasks, remove the button
                    if (container.find('.task-card:hidden').length === 0) {
                        btn.remove();
                    }
                });




                // Initialize SortableJS on all .tasks-list containers
                $('.tasks-list').each(function() {
                    Sortable.create(this, {
                        group: 'tasks', // allows drag between lists with the same group name
                        animation: 150,
                        onAdd: function(evt) {
                            // Called when a task is dropped into a new status list

                            let taskId = $(evt.item).data(
                                'task-id'); // We'll add this attribute below
                            let newStatusId = $(evt.to).closest('[data-status-id]').data(
                                'status-id');

                            // Send AJAX request to update task status
                            $.ajax({
                                url: "{{ route('task.updateStatus') }}", // We'll create this route
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    task_id: taskId,
                                    status_id: newStatusId
                                },
                                success: function(response) {
                                    console.log('Task status updated successfully');
                                },
                                error: function(xhr) {
                                    alert(
                                        'You do not have permission to change the status of this task.'
                                    );
                                    // Optionally revert the drag or reload page
                                    location.reload();
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endsection
</x-app-layout>
