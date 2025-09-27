@php
    $user = auth('employees')->user()
@endphp

<div class="w-64 bg-gray-800 flex flex-col">
    <!-- Company Header -->
    <div class="p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-cube text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-white font-medium">DerryTech Inc</h3>
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
            <h4 class="text-gray-400 text-xs font-medium uppercase tracking-wider mb-3">Platform</h4>

            <!-- Menu Expandable -->
            <!-- Dashboard -->
            <x-sidebar-menu :title="'Dashboard'" :icon="'fas fa-dashboard text-sm'"/>

            <!-- Orders -->
            <x-sidebar-menu
                :title="'Orders'"
                :icon="'fas fa-motorcycle text-sm'"
                :submenus="[
                    'Orders List',
                    'Washing Queue',
                    'Ironing Queue',
                    'Ready For Collection'
                ]"
            />

            <!-- Customers -->
            <x-sidebar-menu
                :title="'Customers'"
                :icon="'fas fa-person text-sm'"
                :submenus="[
                    'Overview',
                    'Customer List',
                ]"
            />

            <!-- Reports -->
            <x-sidebar-menu
                :title="'Reports'"
                :icon="'fas fa-pie-chart text-sm'"
                :submenus="[
                    'Analytics',
                    'Audit Log',
                ]"/>
            <x-sidebar-menu
                :title="'Settings'"
                :icon="'fas fa-cog text-sm'"
            />
        </div>
    </div>

    <!-- Bottom User Section -->
    <div class="p-4 border-t border-gray-700">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div
                    class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                    <span class="text-white text-xs font-medium">S</span>
                </div>
                <div>
                    <p class="text-white text-sm font-medium">
                        {{$user->full_name}}
                    </p>
                    <p class="text-gray-400 text-xs">{{$user->email}}</p>
                </div>
            </div>
            <button class="text-gray-400 hover:text-white">
                <i class="fas fa-chevron-down text-xs"></i>
            </button>
        </div>
    </div>
</div>

