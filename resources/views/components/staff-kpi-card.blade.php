@php use App\Services\Util; @endphp
<div class="{{$gradient ?? 'bg-theme-primary'}} rounded-2xl p-6 text-gray-900 dark:text-white shadow-lg flex flex-col items-center">
    <div class="flex items-center justify-between mb-4 w-full">
        <h3 class="text-base font-bold text-{{$color}}-900 dark:text-white">{{$title}}</h3>
        <div class="bg-{{$color}}-200 rounded-full p-2 w-10 h-10 flex items-center justify-center">
            <i class="{{ $icon }} text-{{$color}}-800"></i>
        </div>
    </div>
    <p class="text-4xl font-bold">{{ $value ?? 0 }}</p>
    <p class="pt-4 text-green-500 dark:text-green-300">{{$percentage}}% vs yesterday</p>
</div>
