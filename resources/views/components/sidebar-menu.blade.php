<div class="mb-2" x-data="{ open: {{ request()->routeIs($url . '*') ? 'true' : 'false' }}  }">

    <a href="{{ empty($submenus) ? route($url) : '#'}}"
       wire:navigate.hover @click="open = !open"
       wire:current="bg-gray-700 text-white"
       class="w-full flex items-center justify-between text-left px-3 py-2 rounded-lg hover:bg-gray-700 hover:text-white text-gray-900 dark:text-gray-300 text-base">
        {{--            {{ request()->routeIs($url . '*') ? 'bg-gray-700 text-white' : '' }}">--}}
        <div class="flex items-center space-x-3 ">
            <i class="{{ $icon }} text-base font-thin"></i>
            <span>{{$title ?? ''}}</span>
        </div>

        @if(!empty($submenus))
            <i class="fas fa-chevron-right text-xs transform transition-transform duration-300 ease-in-out"
               :class="{ 'rotate-90': open }"></i>
        @endif
    </a>

    @if(!empty($submenus))
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

             x-init="$watch('open', value => { if (value) $el.style.display = 'block' })"
        >
            @foreach($submenus as $item)
                <a
                    href="{{ !empty($item['url']) ? route($item['url'])  : '#'}}"
                    wire:navigate.hover
                    class="block px-3 py-2 text-sm text-gray-900 dark:text-gray-400 hover:text-white hover:bg-gray-700 rounded-lg {{ !empty($item['url']) && request()->routeIs($item['url']) ? 'bg-gray-700 text-white': ''}}">{{$item['title']}}</a>
            @endforeach
        </div>
    @endif
</div>
