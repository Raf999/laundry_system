{{-- resources/views/components/staff-performance-card.blade.php --}}
@props([
    'title' => 'Staff Performance',
    'topPerformer' => [
        'name' => 'Ama Mensah',
//        'avatar' => '👤',
        'isTopPerformer' => true
    ],
    'labels' => ['Ama Mensah', 'Kwame Asante', 'Kweku Ananse'],
    'values' => [100, 40, 20],
    'colors' => ['#3b82f6', '#60a5fa', '#93c5fd']
])

@php
    $chartId = 'performance-chart-' . uniqid();
@endphp

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-md p-6 w-full']) }}>
    <h2 class="text-lg font-semibold text-gray-800 mb-6">{{ $title }}</h2>

    <div class="space-y-6">
        {{-- Top Performer --}}
        <div class="flex items-center gap-3 pb-4 border-b border-gray-100">
            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                @if(isset($topPerformer['avatar']))
                    <span class="text-xl">{{ $topPerformer['avatar'] }}</span>
                @else
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                @endif
            </div>
            <div class="flex-1">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-gray-700">Top Performer: {{ $topPerformer['name'] }}</span>
                    @if($topPerformer['isTopPerformer'])
                        <span class="text-green-500">★</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Chart --}}
        <div class="relative h-48">
            <canvas id="{{ $chartId }}"></canvas>
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
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Tasks',
                        data: @json($values),
                        backgroundColor: @json($colors),
                        borderRadius: 20,
                        borderSkipped: false,
                        barThickness: 20,
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
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
                                    return 'Tasks: ' + context.parsed.x;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            max: 100,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            },
                            ticks: {
                                color: '#9ca3af',
                                font: {
                                    size: 10
                                }
                            }
                        },
                        y: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
