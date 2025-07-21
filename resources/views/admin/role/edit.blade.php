<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Role') }}
    </x-slot>

    <div class="">
        <form action="{{ route('role.update',$role->id) }}" method="post" enctype="multipart/form-data">
            @csrf

            <a href="{{ route('role.list') }}"
                class="bg-green-600 text-white px-[35px] py-[8px] rounded-md  mb-[30px] float-left ml-[60px] hover:bg-green-800">List</a>
            <button
                class="bg-blue-600 text-white px-[20px] py-[8px] rounded-md  mb-[30px] float-right mr-[50px] hover:bg-blue-800">Edit Role</button>
            <div class="h-auto w-full">
                @if (Session::has('success'))
                    <div class="text-green-500 text-[20px] mt-1  ml-[200px] p-[10px]" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger ml-[100px]">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-700 ml-[100px]">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="h-auto w-full flex justify-evenly">
                    <div class="w-3/5 h-auto shadow-md p-[20px] flex flex-col items-center gap-y-[30px]">
                        <div class="w-full flex flex-col gap-y-3">
                            <label for="" class="text-[20px] font-[500]">Name: <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="name" id="name" class="w-full rounded-md" value="{{ $role->name }}">
                            @error('name')
                                <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>


                </div>



            </div>


        </form>
    </div>

</x-app-layout>

