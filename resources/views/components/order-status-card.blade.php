@props([
    'orders' => [
        ['label' => 'New Orders', 'value' => 15, 'color' => 'bg-green-500'],
        ['label' => 'In Process', 'value' => 20, 'color' => 'bg-green-400'],
        ['label' => 'Drying', 'value' => 18, 'color' => 'bg-blue-200'],
        ['label' => 'Ironing', 'value' => 10, 'color' => 'bg-blue-100'],
        ['label' => 'Quality Check', 'value' => 7, 'color' => 'bg-red-400'],
        ['label' => 'Completed Today', 'value' => 30, 'color' => 'bg-red-500'],
    ]
])

<div {{ $attributes->merge(['class' => 'bg-theme-primary rounded-lg shadow-md p-6 w-full']) }}>
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Current Order Status</h2>

    <div class="flex items-center gap-8">
        {{-- Donut Chart --}}
        <div class="relative w-40 h-40 flex-shrink-0">
            <svg class="w-full h-full -rotate-90" viewBox="0 0 100 100">
                {{-- Calculate segments --}}
                @php
                    $total = array_sum(array_column($orders, 'value'));
                    $offset = 0;
                    $radius = 40;
                    $circumference = 2 * pi() * $radius;

                    // Define segment colors for the donut
                    $chartColors = [
                        'stroke-green-500',
                        'stroke-green-400',
                        'stroke-blue-300',
                        'stroke-blue-200',
                        'stroke-red-400',
                        'stroke-red-500'
                    ];
                @endphp

                @foreach($orders as $index => $order)
                    @if($order['value'] > 0 && $index < 6)
                        @php
                            $percentage = ($order['value'] / $total) * 100;
                            $dashArray = ($percentage / 100) * $circumference;
                            $colorClass = $chartColors[$index] ?? 'stroke-gray-400';
                        @endphp
                        <circle
                            cx="50"
                            cy="50"
                            r="{{ $radius }}"
                            fill="none"
                            class="{{ $colorClass }}"
                            stroke-width="20"
                            stroke-dasharray="{{ $dashArray }} {{ $circumference }}"
                            stroke-dashoffset="{{ -$offset }}"
                            stroke-linecap="round"
                        />
                        @php
                            $offset += $dashArray;
                        @endphp
                    @endif
                @endforeach

                {{-- Inner circle to create donut effect --}}
                <circle cx="50" cy="50" r="20" fill="none" />
            </svg>
        </div>

        {{-- Status List --}}
        <div class="flex-1 space-y-2">
            @foreach($orders as $order)
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">{{ $order['label'] }}:</span>
                    <div class="flex items-center gap-2">
                        <div class="h-2 rounded-full {{ $order['color'] }}"
                             style="width: {{ min($order['value'] * 4, 120) }}px"></div>
                        <span class="font-semibold w-6 text-right
                            {{ $order['label'] === 'Completed Today' ? 'text-green-600' : 'text-gray-800' }}">
                            {{ $order['value'] }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
