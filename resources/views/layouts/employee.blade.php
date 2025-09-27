<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-scroll::-webkit-scrollbar-track {
            background: #374151;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #6b7280;
            border-radius: 2px;
        }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans">
<div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
   @include('layouts.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Navigation/Breadcrumb -->
        <div class="bg-gray-800 px-6 py-5">
            <div class="flex items-center space-x-2 text-sm">
                <span class="text-gray-400">Dashboard</span>
                <i class="fas fa-chevron-right text-gray-500 text-xs"></i>
                <span class="text-white">@yield('page-title', 'Overview')</span>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto bg-gray-900">
            <div class="p-6">
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
