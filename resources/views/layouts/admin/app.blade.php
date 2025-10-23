@php $user = auth('admin')->user() @endphp

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? ''}}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Boxicons -->
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @fluxAppearance
</head>
<body class="dark:text-white font-sans">

<div class="flex h-screen overflow-hidden w-screen">

    @include('layouts.admin.app.sidebar')

    <!-- Main Content Area -->
    <div class="bg-theme-secondary flex flex-col overflow-hidden w-full">

        <!-- Top Navigation/Breadcrumb -->
        <div class="bg-theme-primary flex justify-end items-center px-6 py-4">
{{--            <div class="flex items-center space-x-2 text-sm">--}}
{{--                <span class=" text-gray-800 dark:text-gray-400">{{$title ?? ''}}</span>--}}
{{--                <i class="fas fa-chevron-right text-gray-500 text-xs"></i>--}}
{{--                <span class="text-gray-800 dark:text-gray-400">{{$base_title ?? ''}}</span>--}}
{{--            </div>--}}

            <div class="flex items-center space-x-4">
                <i class="fas fa-user text-sm text-white bg-gray-700 px-3 py-2 rounded-full"></i>
                <p class="text-sm">Hi! {{$user->name}}</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            <div class="p-6">
                @isset($slot)
                    {{ $slot }}
                @endisset
            </div>
        </div>
    </div>
    <!-- Sidebar -->


</div>
@fluxScripts
</body>
</html>
