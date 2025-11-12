
<div wire:poll.visible class='bg-theme-primary rounded-lg shadow-md p-6 w-full'>
    <h2 class="text-xl text-gray-800 font-semibold mb-4">Recent Activity</h2>

    <div class="space-y-3">
        @foreach($activities as $activity)
            <div class="bg-{{$activity->color}}-100 p-2 rounded-lg">
                <div class="flex items-center justify-between">
                    <div class="text-{{$activity->color}}-900 font-bold text-base">{{ \Illuminate\Support\Str::title($activity->type) }}</div>
                    <div class="text-black text-sm">{{ $activity->created_at }}</div>

                </div>
                {{-- Activity message --}}
                <div class="text-black text-sm">
                    {{ $activity->description }}
                </div>
            </div>
        @endforeach
    </div>
</div>
