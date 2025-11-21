@php $user = auth('staff')->user() @endphp

<!DOCTYPE html>
<html lang="en" style="color-scheme: dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? ''}}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Boxicons -->
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Flowbite -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-theme-primary font-sans ">
<div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
   @include('layouts.staff.app.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Navigation/Breadcrumb -->
        <div class="flex px-6 py-5 justify-between items-center">
            <div class="flex items-center space-x-2 text-sm">
                <span class=" text-gray-800">{{$title ?? ''}}</span>
                <i class="fas fa-chevron-right text-gray-500 text-xs"></i>
                <span class="text-gray-800 ">@yield('page-title', 'Overview')</span>
            </div>

            <div class="flex items-center space-x-4">
                <i class="fas fa-user text-sm text-white bg-gray-700 px-3 py-2 rounded-full"></i>
                <p class="text-sm text-gray-800">Hi! {{$user->full_name}}</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto bg-theme-secondary">
            <div class="p-10">
                @isset($slot)
                    {{ $slot }}
                @endisset
            </div>
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>
