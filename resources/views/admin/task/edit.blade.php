<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Task') }}
    </x-slot>
    <div class="w-1/2 mx-auto bg-white p-8 rounded-2xl shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Task</h2>
        @if (Session::has('success'))
            <div class="text-green-500 text-[20px] mt-1  ml-[50px] p-[10px]" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <form action="{{ route('task.update', $task->slug) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6" x-data="{ images: [] }">

            @csrf


            <div class="flex justify-between">
                <a href="{{ route('task.list') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition float-right">Back</a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition float-left">Update
                    Task</button>
            </div>

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" value="{{ $task->title }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">
                @error('title')
                    <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">{{ $task->description }}</textarea>
                @error('description')
                    <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image Upload -->
            <div x-data="{ images: [] }" class="w-full max-w-4xl mx-auto">
                <!-- File Upload Label -->
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Images</label>

                <!-- Upload Box -->
                <div
                    class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 flex justify-center items-center cursor-pointer hover:border-blue-500 transition">
                    <input type="file" name="images[]" multiple
                        class="absolute inset-0 opacity-0 cursor-pointer z-10"
                        @change="images = Array.from($event.target.files)">
                    <div class="text-center text-gray-500 z-0">
                        <svg class="w-10 h-10 mx-auto text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 16l4-4a4 4 0 015.657 0L21 3M3 21h18" />
                        </svg>
                        <p class="mt-2 text-sm">Click or drag to upload images</p>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4" x-show="images.length">
                    <template x-for="(image, index) in images" :key="index">
                        <div class="relative">
                            <img :src="URL.createObjectURL(image)" alt="preview"
                                class="w-full h-32 object-cover rounded-lg shadow hover:scale-105 transition">
                            <p class="absolute bottom-1 left-1 bg-black/60 text-white text-xs px-1 py-0.5 rounded"
                                x-text="image.name.split('.')[0].slice(0, 12) + (image.name.length > 12 ? '...' : '')">
                            </p>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Select Status</option>
                    <option value="to_do" {{ $task->status == 'to_do' ? 'selected' : '' }}>To Do</option>
                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                    <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                @enderror
            </div>

            <!-- Priority -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                <select name="priority" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Select Priority</option>
                    <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                </select>
                @error('priority')
                    <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                @enderror
            </div>

            <!-- Assigned To -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Assign To (User ID)</label>
                <select name="assigned_to" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    @foreach ($users as $user)
                        <option value="">Select User</option>
                        <option value="{{ $user->id }}" {{ $task->assigned_to == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}</option>
                    @endforeach

                </select>
                @error('assigned_to')
                    <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                @enderror
            </div>

            <!-- Assigned Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Assigned Date</label>
                <input type="date" name="assigned_date" id="assigned_date" value="{{ $task->assigned_date }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2">
                @error('assigned_date')
                    <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                @enderror
            </div>

            <!-- Completed Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Completed Date</label>
                <input type="date" name="completed_date" id="completed_date" value="{{ $task->completed_date }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2">
                @error('completed_date')
                    <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">Update
                    Task</button>
            </div>
        </form>
    </div>


    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#assigned_date').click(function() {
                    $(this)[0].showPicker(); // Trigger the calendar when input is clicked
                });

                $('#completed_date').click(function() {
                    $(this)[0].showPicker(); // Trigger the calendar when input is clicked
                });
            });
        </script>
    @endsection

</x-app-layout>
