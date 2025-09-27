<div class="mb-2" x-data="{ open: false }">
    <button  @click="open = !open"
            class="w-full flex items-center justify-between text-left px-3 py-2 rounded-lg hover:bg-gray-700 text-gray-300">
        <div class="flex items-center space-x-3">
            <i class="{{ $icon }}"></i>
            <span class="text-sm">{{$title ?? ''}}</span>
        </div>
        @if(isset($submenus))
            <i class="fas fa-chevron-right text-xs transform transition-transform duration-300 ease-in-out" :class="{ 'rotate-90': open }"></i>
        @endif
    </button>

    <!--  Submenu -->
        <div class="ml-6 mt-1 space-y-1"
             x-show="open"
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
        >
            @foreach($submenus ?? [] as $item)
                <a href="#"
                   class="block px-3 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-700 rounded-lg">{{$item}}</a>
            @endforeach
        </div>
</div>
