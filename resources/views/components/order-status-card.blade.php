{{-- resources/views/components/order-status-card.blade.php --}}
@props([
    'orders' => [
        ['label' => 'New Orders', 'value' => 15, 'color' => '#22c55e'],
        ['label' => 'In Process', 'value' => 20, 'color' => '#4ade80'],
        ['label' => 'Drying', 'value' => 18, 'color' => '#93c5fd'],
        ['label' => 'Ironing', 'value' => 10, 'color' => '#bfdbfe'],
        ['label' => 'Quality Check', 'value' => 7, 'color' => '#f87171'],
        ['label' => 'Quality Check', 'value' => 0, 'color' => '#ef4444'],
        ['label' => 'Completed Today', 'value' => 30, 'color' => '#ef4444'],
    ]
])

@php
    $chartId = 'order-status-chart-' . uniqid();
    // Separate data for donut chart (first 6 items) and display list (all items)
    $donutData = array_slice($orders, 0, 6);
    $donutLabels = array_column($donutData, 'label');
    $donutValues = array_column($donutData, 'value');
    $donutColors = array_column($donutData, 'color');

    //find highest out of donutvalues
    $highest = max($donutValues);
@endphp

<div {{ $attributes->merge(['class' => 'bg-theme-primary rounded-lg shadow-md p-6 w-full']) }}>
    <h2 class="text-xl font-semibold dark:text-white text-gray-800 mb-6">Current Order Status</h2>

    <div class="flex items-center gap-8">
        {{-- Donut Chart --}}
        <div class="w-40 h-40 flex-shrink-0">
            <canvas id="{{ $chartId }}"></canvas>
        </div>

        {{-- Status List --}}
        <div class="flex-1 space-y-2">
            @foreach($orders as $order)
                <div class="grid grid-cols-[40%_60%] items-center text-sm">
                    <span class="dark:text-gray-200 text-gray-600">{{ $order['label'] }}:</span>
                    <div class="grid grid-cols-[80%_20%] items-center gap-2">
                        <div class="h-2 rounded-full"
                             style="width: {{ min(($order['value']) / $highest * 100, 100) }}%; background-color: {{ $order['color'] }}">

                        </div>
                        <span class="font-semibold text-right
                            {{ $order['label'] === 'Completed Today' ? 'text-green-600' : 'text-gray-800 dark:text-gray-200' }}">
                            {{ $order['value'] }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @endpush
@endonce

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('{{ $chartId }}');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @json($donutLabels),
                    datasets: [{
                        data: @json($donutValues),
                        backgroundColor: @json($donutColors),
                        borderWidth: 0,
                        spacing: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    cutout: '50%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            cornerRadius: 8,
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.parsed;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
