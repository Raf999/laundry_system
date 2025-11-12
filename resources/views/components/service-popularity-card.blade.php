@props([
    'title' => 'Service Popularity',
    'services' => ['Wash & Fold', 'Dry Cleaning', 'Alterations'],
    'percentages' => [30, 30, 60],
    'colors' => ['#60a5fa', '#93c5fd', '#3b82f6']
])

@php
    $chartId = 'service-chart-' . uniqid();
@endphp

<div {{ $attributes->merge(['class' => 'bg-theme-primary rounded-lg shadow-md p-6 w-full']) }}>
    <h2 class="text-lg font-semibold text-gray-800 mb-6">{{ $title }}</h2>

    <div class="relative h-64">
        <canvas id="{{ $chartId }}"></canvas>
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
                    labels: @json($services),
                    datasets: [{
                        label: 'Popularity',
                        data: @json($percentages),
                        backgroundColor: @json($colors),
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
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
                                    return context.parsed.y + '%';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    size: 11
                                },
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        },
                        x: {
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
