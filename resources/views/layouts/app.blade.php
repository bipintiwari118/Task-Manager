<!DOCTYPE html>
<html x-data="data" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Scripts -->
    <script src="{{ asset('js/init-alpine.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    {{--
    for select multiple --}}

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body>
    <div class="flex h-screen bg-gray-50" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        @include('layouts.navigation')
        <!-- Mobile sidebar -->
        <!-- Backdrop -->
        @include('layouts.navigation-mobile')
        <div class="flex flex-col flex-1 w-full">
            @include('layouts.top-menu')
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    @if (isset($header))
                        <h2 class="my-6 text-2xl font-semibold text-gray-700">
                            {{ $header }}
                        </h2>
                    @endif

                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    @yield('scripts')
</body>

</html>
