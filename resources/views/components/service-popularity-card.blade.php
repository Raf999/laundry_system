@props([
    'title' => 'Service Popularity',
    'services' => [
        ['name' => 'Wash & Fold', 'percentage' => 30, 'color' => 'bg-blue-400'],
        ['name' => 'Dry Cleaning', 'percentage' => 30, 'color' => 'bg-blue-300'],
        ['name' => 'Alterations', 'percentage' => 60, 'color' => 'bg-blue-500'],
    ]
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-md p-6 w-full']) }}>
    <h2 class="text-lg font-semibold text-gray-800 mb-6">{{ $title }}</h2>

    <div class="flex items-end justify-around h-64 px-4">
        @foreach($services as $service)
            <div class="flex flex-col items-center gap-3 flex-1 max-w-[100px]">
                {{-- Bar --}}
                <div class="relative w-full" style="height: 200px;">
                    <div class="absolute bottom-0 w-full {{ $service['color'] }} rounded-t-md transition-all duration-300"
                         style="height: {{ ($service['percentage'] / 60) * 100 }}%;">
                    </div>

                    {{-- Percentage label --}}
                    <div class="absolute -top-6 left-1/2 -translate-x-1/2 text-sm font-semibold text-gray-700">
                        {{ $service['percentage'] }}%
                    </div>
                </div>

                {{-- Service name --}}
                <div class="text-xs text-gray-600 text-center w-full">
                    {{ $service['name'] }}
                </div>
            </div>
        @endforeach
    </div>
</div>
