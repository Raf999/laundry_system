@props([
    'activities' => [
        [
            'time' => '1 mins ago',
            'message' => 'Order #1045 moved to "Drying".',
            'type'   => 'Orders',
            'color'    => 'blue',
            'highlight' => ['#1045', 'Drying']
        ],
        [
            'time' => '5 mins ago',
            'message' => 'New Customer registered.',
            'type'   => 'Customers',
            'color'   => 'green',
        ],
        [
            'time' => '3 mins ago',
            'message' => 'Payment of GHS 50.00 received for Order #042.',
            'type'   => 'Payments',
            'color'   => 'amber',
            'highlight' => ['GHS 50.00', '#042']
        ],
    ]
])

<div {{ $attributes->merge(['class' => 'bg-theme-primary rounded-lg shadow-md p-6 w-full']) }}>
    <h2 class="text-xl font-semibold dark:text-white mb-4">Recent Activity</h2>

    <div class="space-y-3">
        @foreach($activities as $activity)
            <div class="bg-{{$activity['color']}}-100 p-2 rounded-lg">
                <div class="flex items-center justify-between">
                    <div class="text-{{$activity['color']}}-900 font-bold text-base">{{ $activity['type'] }}</div>
                    <div class="text-black text-sm">{{ $activity['time'] }}</div>

                </div>
                {{-- Activity message --}}
                @if(isset($activity['message']))
                    <div class="text-black text-sm">
                        @php
                            $message = $activity['message'];
                            $highlights = $activity['highlight'] ?? [];

                            // Replace highlights with styled spans
                            foreach($highlights as $highlight) {
                                $pattern = '/' . preg_quote($highlight, '/') . '/';
                                if($activity['type'] === 'info') {
                                    $message = preg_replace($pattern, '<span class="font-medium">' . $highlight . '</span>', $message, 1);
                                } else {
                                    $message = preg_replace($pattern, '<span class="font-medium">' . $highlight . '</span>', $message, 1);
                                }
                            }
                        @endphp
                        {!! $message !!}
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
