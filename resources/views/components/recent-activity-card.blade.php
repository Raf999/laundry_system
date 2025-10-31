@props([
    'activities' => [
        [
            'time' => '1 mins ago',
            'message' => 'Order #1045 moved to "Drying".',
            'type' => 'info',
            'highlight' => ['#1045', 'Drying']
        ],
        [
            'time' => '5 mins ago',
            'message' => 'New Customer registered.',
            'type' => 'success'
        ],
        [
            'time' => '3 mins ago',
            'message' => 'Payment of GHS 50.00 received for Order #042.',
            'type' => 'success',
            'highlight' => ['GHS 50.00', '#042']
        ],
    ]
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-md p-6 w-full']) }}>
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h2>

    <div class="space-y-3">
        @foreach($activities as $activity)
            <div class="text-sm">
                {{-- Time stamp --}}
                @if(isset($activity['time']))
                    <div class="text-gray-500 mb-1">{{ $activity['time'] }}:</div>
                @endif

                {{-- Activity message --}}
                @if(isset($activity['message']))
                    <div class="
                        @if($activity['type'] === 'info') text-blue-600
                        @elseif($activity['type'] === 'success') text-green-600
                        @else text-gray-700
                        @endif
                    ">
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
