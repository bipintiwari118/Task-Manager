<x-app-layout>
    <x-slot name="header">
        {{ __('Task List') }}
    </x-slot>

    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="flex flex-row justify-between w-full mb-4">
                <h2 class="text-2xl font-semibold leading-tight">Task List</h2>
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
            <form method="GET" action="{{ route('task.list') }}" class="mb-4">
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
                        <option value="to_do" {{ request('status') == 'to_do' ? 'selected' : '' }}>To Do</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In
                            Progress</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                        </option>
                    </select>
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
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



            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-800 text-white text-left text-sm uppercase font-semibold tracking-wider">
                            <th class="px-5 py-3">Id</th>
                            <th class="px-5 py-3">Title</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3">Priority</th>
                            <th class="px-5 py-3">Assigned Date</th>
                            <th class="px-5 py-3">Completed Date</th>
                            <th class="px-5 py-3">Created By</th>
                            <th class="px-5 py-3">Assigned To</th>
                            <th class="px-14 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white" id="sortable-task-list">
                        <!-- Example Row -->
                        @if ($tasks->count() > 0)
                            @foreach ($tasks as $task)
                                <tr data-id="{{ $task->id }}" class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap font-semibold text-[20px]">
                                            {{ $task->id }}</p>
                                    </td>

                                    <td class="px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ \Illuminate\Support\Str::limit($task->title, 10, '...') }}</p>
                                    </td>

                                    <td class="px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap"><span
                                                class="px-2 py-1 rounded text-sm font-medium
                                                        {{ $task->status == 'to_do'
                                                            ? 'bg-blue-100 text-blue-800'
                                                            : ($task->status == 'in_progress'
                                                                ? 'bg-yellow-100 text-yellow-800'
                                                                : ($task->status == 'completed'
                                                                    ? 'bg-green-100 text-green-800'
                                                                    : 'bg-gray-100 text-gray-600')) }}">
                                                {{ $task->status }}
                                            </span></p>
                                    </td>
                                    <td class="px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            <span
                                                class="px-2 py-1 rounded text-sm font-medium
                                                        {{ $task->priority == 'low'
                                                            ? 'bg-blue-100 text-blue-800'
                                                            : ($task->priority == 'medium'
                                                                ? 'bg-yellow-100 text-yellow-800'
                                                                : ($task->priority == 'high'
                                                                    ? 'bg-green-100 text-green-800'
                                                                    : 'bg-gray-100 text-gray-600')) }}">
                                                {{ $task->priority }}
                                            </span>
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $task->assigned_date }}</p>
                                    </td>
                                    <td class="px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $task->completed_date ? $task->completed_date : 'No Completed' }}</p>
                                    </td>
                                    <td class="px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $task->creator->name }}</p>
                                    </td>

                                    <td class="px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            @if (!@empty($task->assigned_to))
                                                {{ $task->assigne->name }}
                                            @else
                                                Not Assign
                                            @endif
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 text-sm text-center">
                                        <a href="{{ route('task.edit', $task->slug) }}"
                                            class="text-blue-500 hover:text-blue-700 font-bold mr-2">Edit</a>
                                        <a href="{{ route('task.view', $task->slug) }}"
                                            class="text-green-500 hover:text-green-700 font-bold mr-2">View
                                            <a href="{{ route('task.delete', $task->slug) }}"
                                                class="text-red-500 hover:text-red-700 font-bold"
                                                onclick="alert('Are you sure to delete this booking.')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10"
                                    class="border-b border-gray-200 hover:bg-gray-100 text-center py-[15px]">No Task
                                    found.
                                </td>
                            </tr>
                        @endif
                        <!-- Add more rows dynamically -->
                    </tbody>
                </table>

                <div class="flex justify-center mt-2">
                    {{ $tasks->links('pagination::tailwind') }}
                </div>

            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#search_date').click(function() {
                    $(this)[0].showPicker(); // Trigger the calendar when input is clicked
                });



                const el = document.getElementById('sortable-task-list');
                if (el) {
                    const sortable = Sortable.create(el, {
                        animation: 150,
                        onEnd: function(evt) {
                            const order = [];
                            $('#sortable-task-list tr').each(function(index) {
                                order.push({
                                    id: $(this).data('id'),
                                    position: index + 1
                                });
                            });

                            $.ajax({
                                url: '{{ route("task.reorder") }}',
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                contentType: 'application/json', // Tell server it's JSON
                                data: JSON.stringify({
                                    order: order
                                }), // Convert object to JSON string
                                processData: false, // Don't process data (it's JSON string)
                                success: function(res) {
                                    console.log('Order updated:', res);
                                },
                                error: function(err) {
                                    console.error('Error updating order:', err.responseText);
                                }
                            });
                        }
                    });
                } else {
                    console.error('Element with id "sortable-task-list" not found');
                }
            });
        </script>
    @endsection

</x-app-layout>
