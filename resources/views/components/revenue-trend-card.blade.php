@props([
    'title' => 'Revenue Trend (Last 30 Days)',
    'dataPoints' => [
        ['x' => 0, 'y' => 5],
        ['x' => 20, 'y' => 15],
        ['x' => 40, 'y' => 25],
        ['x' => 60, 'y' => 35],
        ['x' => 80, 'y' => 45],
        ['x' => 100, 'y' => 60],
        ['x' => 120, 'y' => 70],
        ['x' => 140, 'y' => 75],
        ['x' => 160, 'y' => 85],
        ['x' => 180, 'y' => 95],
        ['x' => 200, 'y' => 140],
    ],
    'maxX' => 200,
    'maxY' => 140,
    'yAxisLabels' => [0, 15, 20, 65, 135, 100]
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-md p-6 w-full']) }}>
    <h2 class="text-lg font-semibold text-gray-800 mb-6">{{ $title }}</h2>

    <div class="relative h-64">
        {{-- Y-axis labels --}}
        <div class="absolute left-0 top-0 bottom-8 w-8 flex flex-col justify-between text-xs text-gray-500">
            @foreach(array_reverse($yAxisLabels) as $label)
                <span class="text-right">{{ $label }}</span>
            @endforeach
        </div>

        {{-- Chart area --}}
        <div class="ml-10 mr-4 h-full relative">
            {{-- Background grid lines --}}
            <div class="absolute inset-0 flex flex-col justify-between">
                @for($i = 0; $i < 6; $i++)
                    <div class="border-t border-gray-100"></div>
                @endfor
            </div>

            {{-- SVG Chart --}}
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 {{ $maxX }} {{ $maxY }}" preserveAspectRatio="none">
                {{-- Create path from data points --}}
                @php
                    $pathData = 'M ';
                    foreach($dataPoints as $index => $point) {
                        $pathData .= $point['x'] . ',' . ($maxY - $point['y']);
                        if($index < count($dataPoints) - 1) {
                            $pathData .= ' L ';
                        }
                    }
                @endphp

                {{-- Line --}}
                <path
                    d="{{ $pathData }}"
                    fill="none"
                    stroke="#3b82f6"
                    stroke-width="2"
                    vector-effect="non-scaling-stroke"
                />

                {{-- Data points --}}
                @foreach($dataPoints as $point)
                    <circle
                        cx="{{ $point['x'] }}"
                        cy="{{ $maxY - $point['y'] }}"
                        r="3"
                        fill="#3b82f6"
                        vector-effect="non-scaling-stroke"
                    />
                @endforeach
            </svg>
        </div>

        {{-- X-axis labels --}}
        <div class="ml-10 mr-4 mt-2 flex justify-between text-xs text-gray-500">
            <span>0</span>
            <span>20</span>
            <span>25</span>
            <span>60</span>
            <span>70</span>
            <span>80</span>
            <span>90</span>
            <span>200</span>
        </div>
    </div>
</div>
