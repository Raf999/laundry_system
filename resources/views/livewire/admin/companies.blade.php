<div class="flex flex-col space-y-20">
    {{-- Do your work, then step back. --}}
    {{--  KPI CARDS  --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
        @foreach($kpis as $kpi)
            @php
                \Illuminate\Support\Facades\Log::info($kpi)
            @endphp
        <x-kpi-card :gradient="'bg-gradient-to-br from-' .$kpi['color']. '-600 to-' .$kpi['color'].'-400'" :title="$kpi['title']" :value="$kpi['value']"></x-kpi-card>
        @endforeach
    </div>

    <livewire:admin.companies-list></livewire:admin.companies-list>
</div>
