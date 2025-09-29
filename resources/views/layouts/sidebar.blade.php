@php
    $user = auth('employees')->user()
@endphp

<div class="w-64 bg-white dark:bg-gray-800 flex flex-col">
    <!-- Company Header -->
    <div class="p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-cube text-white text-sm"></i>
                </div>
                <div>
                    <h3 class=" text-gray-900 dark:text-white font-medium">{{$user->company->name}}</h3>
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
            <!-- Dashboard -->
            <x-sidebar-menu :url="'dashboard'" :title="'Dashboard'" :icon="'fas fa-dashboard text-sm'"/>

            <!-- Orders -->
            <x-sidebar-menu
                :url="'orders'"
                :title="'Orders'"
                :icon="'fas fa-motorcycle text-sm'"
                {{--                :submenus="[--}}
                {{--                    'Orders List',--}}
                {{--                    'Washing Queue',--}}
                {{--                    'Ironing Queue',--}}
                {{--                    'Ready For Collection'--}}
                {{--                ]"--}}
            />

            <!-- Customers -->
            <x-sidebar-menu
                :url="'customers'"
                :title="'Customers'"
                :icon="'fas fa-person text-sm'"
                {{--                :submenus="[--}}
                {{--                    'Overview',--}}
                {{--                    'Customer List',--}}
                {{--                ]"--}}
            />

            <!-- Reports -->
            <x-sidebar-menu
                :url="'reports'"
                :title="'Reports'"
                :icon="'fas fa-pie-chart text-sm'"
                {{--                :submenus="[--}}
                {{--                    'Analytics',--}}
                {{--                    'Audit Log',--}}
                {{--                ]"--}}
            />
            <x-sidebar-menu
                :url="'settings'"
                :title="'Settings'"
                :icon="'fas fa-cog text-sm'"
            />
        </div>
    </div>

    <!-- Bottom Logout Section -->
    <form method="POST" action="{{ route('employee.logout') }}">
        @csrf
        <button type="submit" class="p-4 text-gray-800 border-t dark:border-gray-700 border-gray-200 flex items-center space-x-3 w-full  hover:bg-gray-300 dark:hover:bg-gray-700 text-lg">
            <i class="fas fa-sign-out-alt  text-gray-800 dark:text-white  rounded-full"></i>

            <span class="dark:text-gray-300">Logout</span>
        </button>
    </form>
</div>

