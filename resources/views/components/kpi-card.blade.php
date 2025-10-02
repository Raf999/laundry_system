<div class="{{$gradient}} rounded-2xl p-6 text-white shadow-lg">
    <div class="flex items-start justify-between mb-4">
        <h3 class="text-base font-medium opacity-90">{{$title}}</h3>
        <div class="bg-white bg-opacity-20 rounded-full p-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
        </div>
    </div>
    <p class="text-6xl font-bold">{{ $value ?? 0 }}</p>
</div>
