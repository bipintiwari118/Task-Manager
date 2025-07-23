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
                <label class="block text-sm font-medium text-gray-700 mb-1">Title <span
                        class="text-red-600">*</span></label>
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
            <div class="w-full max-w-4xl mx-auto">
                <!-- File Upload Label -->
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Images</label>

                <input type="file" name="images" id="featured_image" class="w-full">
                <div class="">
                    @if ($task->images)
                        <p class="text-gray-500 mb-[5px]">{{ $task->images }}</p>
                        <img id="image_preview" src="{{ asset($task->images) }}"
                            alt="{{ $task->images }}" class="w-[100px] h-[120px] object-cover rounded">
                    @else
                        <p class="text-gray-500">No image uploaded.</p>
                        <img id="image_preview" src="" alt="Image Preview"
                            class="w-[100px] h-[120px] hidden object-cover rounded">
                    @endif
                </div>

                @error('images')
                    <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status <span
                        class="text-red-600">*</span></label>
                <select name="status_id" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Select Status</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}" {{ $task->status_id == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}</option>
                    @endforeach
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
            @hasrole('Admin')
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
            @endrole

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
