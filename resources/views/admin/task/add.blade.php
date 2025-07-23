<x-app-layout>
    <x-slot name="header">
        {{ __('Created Task') }}
    </x-slot>
    <div class="w-1/2 mx-auto bg-white p-8 rounded-2xl shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Create New Task</h2>
        @if (Session::has('success'))
            <div class="text-green-500 text-[20px] mt-1  ml-[50px] p-[10px]" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">

            @csrf

            <div class="text-right">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">Create
                    Task</button>
            </div>

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title <span
                        class="text-red-600">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">
                @error('title')
                    <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image Upload -->


            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Image</label>
                <input type="file" name="images" id="featured_image" class="w-full">
                <div class="">
                    <img id="image_preview" src="#" alt="Image Preview"
                        class="w-[100px] h-[120px] hidden object-cover rounded">
                </div>
                @error('featured_image')
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
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
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
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
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
                        <option value="">Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach

                    </select>
                    @error('assigned_to')
                        <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                    @enderror
                </div>
            @endrole

            <!-- Assigned Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Assigned Date </label>
                <input type="date" name="assigned_date" id="assigned_date" value="{{ old('assigned_date') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2">
                @error('assigned_date')
                    <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                @enderror
            </div>

            <!-- Completed Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Completed Date</label>
                <input type="date" name="completed_date" id="completed_date" value="{{ old('completed_date') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2">
                @error('completed_date')
                    <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                @enderror
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
            const imageInput = document.getElementById('featured_image');
            const imagePreview = document.getElementById('image_preview');

            imageInput.addEventListener('change', function() {
                const file = this.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                    }

                    reader.readAsDataURL(file);
                }
            });

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
