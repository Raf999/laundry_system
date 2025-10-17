@php $user = auth('admin')->user() @endphp

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? ''}}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AlpineJS Persist -->
    <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>


    @fluxAppearance
</head>
<body class="bg-gray-100 dark:text-white font-sans dark:bg-gray-900">

<div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <x-sidebar
        :user="$user"
        :menus="[
                   [
                       'url' => 'admin.dashboard',
                       'title' => 'Dashboard',
                       'icon' => 'fas fa-dashboard',
                   ],

                   [
                       'url' => 'admin.companies',
                       'title' => 'Companies',
                       'icon' => 'fas fa-briefcase',
                       'submenus' => [
                           ['title' => 'Overview',],
                           ['title' => 'Companies List', 'url' => 'admin.companies.index'],
                           ['title' => 'Pending Approvals', 'url' => 'admin.companies.pending'],
                           ['title' => 'Active Companies', ],
                           ['title' => 'Suspended Companies', ],
                       ],
                   ],

                   [
                       'url' => 'admin.orders',
                       'title' => 'Orders',
                       'icon' => 'fas fa-motorcycle',
                       'submenus' => [
                               ['title' => 'Overview', ],
                               ['title' => 'Orders List', 'url' => 'admin.orders.index'],
                               ['title' => 'Pending Orders', '' ],
                               ['title' => 'Completed Orders', ],

                           ],
                   ],

                   [
                       'url' => 'admin.customers',
                       'title' => 'Users',
                       'icon' => 'fas fa-person',
                       'submenus' => [
                               ['title' => 'Overview', ],
                               ['title' => 'User List', 'url' => 'admin.customers.index'],
                               ['title' => 'Support Tickets', ],
                           ],
                   ],

                   [
                       'url' => 'admin.financials',
                       'title' => 'Financials',
                       'icon' => 'fas fa-person',
                       'submenus' => [
                               ['title' => 'Overview', ],
                               ['title' => 'Subscription Plans', 'url' => 'admin.financials.index'],
                               ['title' => 'Commission Tracking', ],
                               ['title' => 'Vendor Payouts', ],
                           ],
                   ],

                   [
                       'url' => 'admin.reports',
                       'title' => 'Reports',
                       'icon' => 'fas fa-chart-bar',
                       'submenus' => [
                               ['title' => 'System Reports', 'url' => 'admin.reports.index'],
                               ['title' => 'Vendor Reports'],
                               ['title' => 'User Reports'],
                               ['title' => 'Exports'],
                           ],
                   ],

                   [
                       'url' => 'admin.analytics',
                       'title' => 'Analytics',
                       'icon' => 'fas fa-chart-bar',
                       'submenus' => [
                               ['title' => 'Overview', ],
                               ['title' => 'All Users', 'url' => 'admin.analytics.index'],
                               ['title' => 'Support Tickets', ],
                           ],
                   ],

                   [
                       'url' => 'admin.settings',
                       'title' => 'Settings',
                       'icon' => 'fas fa-chart-bar',
                       'submenus' => [
                               ['title' => 'Api Management', ],
                               ['title' => 'Commission Settings'],
                               ['title' => 'Platform Configuration', ],
                           ],
                   ]
               ]"
    />

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Navigation/Breadcrumb -->
        <div class="flex px-6 py-5 justify-between items-center">
            <div class="flex items-center space-x-2 text-sm">
                <span class=" text-gray-800 dark:text-gray-400">{{$title ?? ''}}</span>
                <i class="fas fa-chevron-right text-gray-500 text-xs"></i>
                <span class="text-gray-800 dark:text-gray-400">@yield('page-title', 'Overview')</span>
            </div>

            <div class="flex items-center space-x-4">
                <i class="fas fa-user text-sm text-white bg-gray-700 px-3 py-2 rounded-full"></i>
                <p class="text-sm">Hi! {{$user->name}}</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto bg-gray-100 dark:bg-gray-900">
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
