<div class="flex flex-col space-y-10">
    {{-- The best athlete wants his opponent at his best. --}}

    {{--KPI CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
        @foreach($kpis as $kpi)
            <x-staff-kpi-card :title="$kpi['title']" :value="$kpi['value']" :icon="$kpi['icon']" :color="$kpi['color']" :percentage="$kpi['percentage']"></x-staff-kpi-card>
        @endforeach
    </div>

    <div class="flex justify-between gap-10">
        {{--Current Order Status --}}
        <x-order-status-card></x-order-status-card>
        <livewire:staff.recent-activity-card></livewire:staff.recent-activity-card>
    </div>

    <div class="flex justify-between gap-10">
        <x-revenue-trend-card></x-revenue-trend-card>
        <x-service-popularity-card></x-service-popularity-card>
        <x-staff-performance-card></x-staff-performance-card>
    </div>
</div>
