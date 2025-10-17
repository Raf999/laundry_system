@php use App\Services\Util; @endphp
<div class="{{$gradient}} rounded-2xl p-6 text-white shadow-lg">
    <div class="flex items-start justify-between mb-4">
        <h3 class="text-base font-medium opacity-90">{{$title}}</h3>
        <div class="bg-white bg-opacity-20 rounded-full p-2 w-10 h-10 flex items-center justify-center">
            <i class="{{ $icon }} text-white"></i>
        </div>
    </div>
    <p class="text-6xl font-bold">{{ Util::formatNumber($value)  ?? 0 }}</p>
</div>
