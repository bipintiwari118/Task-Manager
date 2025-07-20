<x-app-layout>
    <x-slot name="header">
        {{ __('Created Task') }}
    </x-slot>
    <div class="w-1/2 mx-auto bg-white p-8 rounded-2xl shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Create New Task</h2>
        @if (Session::has('success'))
            <div class="text-green-500 text-[20px] mt-1  ml-[200px] p-[10px]" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6"
            x-data="{ images: [] }">

            @csrf

            <div class="text-right">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">Create
                    Task</button>
            </div>

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200" required>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200" required>{{ old('description') }}</textarea>
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
                    <option value="to_do">To Do</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <!-- Priority -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                <select name="priority" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Select Priority</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <!-- Assigned To -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Assign To (User ID)</label>
                <select name="assigned_to" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach

                </select>
            </div>

            <!-- Assigned Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Assigned Date</label>
                <input type="date" name="assigned_date" id="assigned_date" value="{{ old('assigned_date') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>

            <!-- Completed Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Completed Date</label>
                <input type="date" name="completed_date" id="completed_date" value="{{ old('completed_date') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">Create
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
