<div class="w-64 bg-theme-primary flex flex-col">
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
                :url="'admin.dashboard'"
                :title="'Dashboard'"
                :icon="'bx bx-grid'"
            />

            <x-sidebar-menu
                :url="'admin.companies'"
                :title="'Companies'"
                :icon="'bx bx-store-alt-2'"
                :submenus="[
                               ['title' => 'Overview',],
                               ['title' => 'Companies List', 'url' => 'admin.companies.index'],
                               ['title' => 'Pending Approvals', 'url' => 'admin.companies.pending'],
                               ['title' => 'Active Companies', ],
                               ['title' => 'Suspended Companies', ],
                           ]"
            />

            <x-sidebar-menu
                :url="'admin.orders'"
                :title="'Orders'"
                :icon="'bx bx-cycling'"
                :submenus="[
                                   ['title' => 'Overview', ],
                                   ['title' => 'Orders List', 'url' => 'admin.orders.index'],
                                   ['title' => 'Pending Orders', '' ],
                                   ['title' => 'Completed Orders', ],

                               ]"
            />

            <x-sidebar-menu
                :url="'admin.customers'"
                :title="'Customers'"
                :icon="'bx bx-user-square'"
                :submenus="[
                                   ['title' => 'Overview', ],
                                   ['title' => 'User List', 'url' => 'admin.customers.index'],
                                   ['title' => 'Support Tickets', ],
                               ]"
            />

            <x-sidebar-menu
                :url="'admin.financials'"
                :title="'Financials'"
                :icon="'bx bx-wallet-alt'"
                :submenus="[
                                   ['title' => 'Overview', ],
                                   ['title' => 'Subscription Plans', 'url' => 'admin.financials.index'],
                                   ['title' => 'Commission Tracking', ],
                                   ['title' => 'Vendor Payouts', ],
                               ]"
            />

            <x-sidebar-menu
                :url="'admin.reports'"
                :title="'Reports'"
                :icon="'bx bx-pie-chart-alt'"
                :submenus="[
                                   ['title' => 'System Reports', 'url' => 'admin.reports.index'],
                                   ['title' => 'Vendor Reports'],
                                   ['title' => 'User Reports'],
                                   ['title' => 'Exports'],
                               ]"
            />

            <x-sidebar-menu
                :url="'admin.analytics'"
                :title="'Analytics'"
                :icon="'bx bx-bar-chart-square'"
                :submenus="[
                                   ['title' => 'Overview', ],
                                   ['title' => 'Users', 'url' => 'admin.analytics.index'],
                                   ['title' => 'Companies', ],
                               ]"
            />

            <x-sidebar-menu
                :url="'admin.settings'"
                :title="'Settings'"
                :icon="'bx bx-cog'"
                :submenus="[
                                   ['title' => 'Api Management', ],
                                   ['title' => 'Commission Settings'],
                                   ['title' => 'Platform Configuration', ],
                               ]"
            />
        </div>
    </div>

    <!-- Bottom Logout Section -->
    <form method="POST" action="{{ route('employee.logout') }}">
        @csrf
        <button type="submit"
                class="p-4 text-gray-800 border-t dark:border-gray-700 border-gray-200 flex items-center space-x-3 w-full  hover:bg-gray-300 dark:hover:bg-gray-700 text-lg">
            <i class="fas fa-sign-out-alt  text-gray-800 dark:text-white  rounded-full"></i>

            <span class="dark:text-gray-300">Logout</span>
        </button>
    </form>
</div>

