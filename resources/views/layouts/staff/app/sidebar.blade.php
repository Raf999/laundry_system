<div class="w-64 bg-white dark:bg-gray-800 flex flex-col">
    <!-- Company Header -->
    <div class="p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-cube text-white text-sm"></i>
                </div>
                <div>
                    <h3 class=" text-gray-900 dark:text-white font-medium">{{$user->company?->name ?? $user->name}}</h3>
                </div>
            </div>
            {{--            <button class="text-gray-400 hover:text-white">--}}
            {{--                <i class="fas fa-chevron-down text-xs"></i>--}}
            {{--            </button>--}}
        </div>
    </div>

    <!-- Navigation Sections -->
    <div class="flex-1 overflow-y-auto sidebar-scroll">
        <!-- Platform Section -->
        <div class="p-4">
                <x-sidebar-menu
                    :url="'staff.dashboard'"
                    :title="'Dashboard'"
                    :icon="'bx bx-grid'"
                    :submenus="[]"
                />

            <x-sidebar-menu
                    :url="'staff.orders'"
                    :title="'Orders'"
                    :icon="'bx bx-cycling'"
                    :submenus="[
                               ['title' => 'Overview',],
                               ['title' => 'Orders List', 'url' => 'staff.orders'],
                               ['title' => 'Ready For Pickup' ]
                           ]"
                />

            <x-sidebar-menu
                    :url="'staff.customers'"
                    :title="'Customers'"
                    :icon="'bx bx-user-square'"
                    :submenus="[
                               ['title' => 'Overview',],
                               ['title' => 'Customers List', 'url' => 'staff.customers'],
                           ]"
                />

            <x-sidebar-menu
                    :url="'staff.reports'"
                    :title="'Staff Management'"
                    :icon="'bx bx-group'"
                    :submenus="[
                               ['title' => 'Staff List',],
                               ['title' => 'Roles & Permission'],
                               ['title' => 'Schedules'],
                           ]"
                />

            <x-sidebar-menu
                    :url="'staff.reports'"
                    :title="'Finances'"
                    :icon="'bx bx-currency-note'"
                    :submenus="[
                               ['title' => 'Revenue Overview',],
                               ['title' => 'Transactions'],
                               ['title' => 'Expenses'],
                               ['title' => 'Invoices'],
                               ['title' => 'Receipts'],
                           ]"
                />

            <x-sidebar-menu
                    :url="'staff.reports'"
                    :title="'Services & Pricing'"
                    :icon="'bx bx-washer'"
                    :submenus="[
                               ['title' => 'Service Types',],
                               ['title' => 'Pricing Management'],
                               ['title' => 'Packages & Bundles'],
                               ['title' => 'Discounts']
                           ]"
                />

            <x-sidebar-menu
                    :url="'staff.reports'"
                    :title="'Inventory'"
                    :icon="'bx bx-currency-note'"
                    :submenus="[
                               ['title' => 'Stock Items',],
                               ['title' => 'Suppliers'],
                               ['title' => 'Stock History'],
                           ]"
                />

            <x-sidebar-menu
                    :url="'staff.reports'"
                    :title="'Reports'"
                    :icon="'fas fa-chart-bar'"
                    :submenus="[
                               ['title' => 'Sales Reports',],
                               ['title' => 'Customer Reports'],
                               ['title' => 'Inventory Reports'],
                           ]"
                />
        </div>
    </div>

    <!-- Bottom Logout Section -->
    <form method="POST" action="{{ route('staff.logout') }}">
        @csrf
        <button type="submit" class="p-4 text-gray-800 border-t dark:border-gray-700 border-gray-200 flex items-center space-x-3 w-full  hover:bg-gray-300 dark:hover:bg-gray-700 text-lg">
            <i class="fas fa-sign-out-alt  text-gray-800 dark:text-white  rounded-full"></i>

            <span class="dark:text-gray-300">Logout</span>
        </button>
    </form>
</div>

