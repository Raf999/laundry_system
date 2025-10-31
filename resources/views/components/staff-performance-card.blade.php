@props([
    'title' => 'Staff Performance',
    'topPerformer' => [
        'name' => 'Ama Mensah',
        'avatar' => '👤',
        'isTopPerformer' => true
    ],
    'metrics' => [
        ['label' => 'Assigned Tasks', 'value' => 100, 'max' => 100, 'color' => 'bg-blue-500'],
        ['label' => 'Kwame Nakruu', 'value' => 40, 'max' => 100, 'color' => 'bg-blue-400'],
        ['label' => 'Completed Tasks', 'value' => 20, 'max' => 100, 'color' => 'bg-blue-400'],
    ],
    'legendLabels' => ['10', 'Accomplished', 'Tasks']
])

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

        {{-- Performance Bars --}}
        <div class="space-y-4">
            @foreach($metrics as $metric)
                <div>
                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                        <span>{{ $metric['label'] }}</span>
                    </div>
                    <div class="relative h-6 bg-gray-100 rounded-full overflow-hidden">
                        <div class="{{ $metric['color'] }} h-full rounded-full transition-all duration-300"
                             style="width: {{ ($metric['value'] / $metric['max']) * 100 }}%">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Legend --}}
        <div class="flex justify-between text-xs text-gray-400 pt-2">
            @foreach($legendLabels as $label)
                <span>{{ $label }}</span>
            @endforeach
        </div>
    </div>
</div>
