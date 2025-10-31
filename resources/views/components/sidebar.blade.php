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
            @foreach($menus as $menu )
                <x-sidebar-menu
                    :url="$menu['url']"
                    :title="$menu['title']"
                    :icon="$menu['icon']"
                    :submenus="$menu['submenus'] ?? []"
                    {{--                    :submenus="$menu['submenus']"--}}
                />
            @endforeach
        </div>
    </div>

    <!-- Bottom Logout Section -->
    <form method="POST" action="{{ route('Staff.logout') }}">
        @csrf
        <button type="submit" class="p-4 text-gray-800 border-t dark:border-gray-700 border-gray-200 flex items-center space-x-3 w-full  hover:bg-gray-300 dark:hover:bg-gray-700 text-lg">
            <i class="fas fa-sign-out-alt  text-gray-800 dark:text-white  rounded-full"></i>

            <span class="dark:text-gray-300">Logout</span>
        </button>
    </form>
</div>

