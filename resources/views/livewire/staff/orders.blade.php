@php use App\Enum\CompanyStatus;use App\Enum\OrderStatus;use Carbon\Carbon; use Illuminate\Support\Str;  @endphp
<div>
    <div class="bg-theme-primary rounded-lg shadow broder ">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-xl font-semibold text-gray-800 ">Orders List</h2>
        </div>

        <!-- Filters -->
        <div class="px-6 py-4 border-b border-gray-100">
            <div class="flex flex-wrap gap-4 items-end">
                <!-- Date Range Filter -->
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                    <div class="flex gap-2">
                        <input type="date" wire:model.live="startDate"
                               class="flex-1 px-3 py-2 border text-gray-700   bg-theme-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Start date">
                        <input type="date" wire:model.live="endDate"
                               class="flex-1 px-3 py-2 border text-gray-700 dark:text-white  bg-theme-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="End date">
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select wire:model.live="status"
                            class="w-full px-3 py-2 border text-gray-700 bg-theme-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value=""></option>
                        @foreach(OrderStatus::cases() as $status)
                            <option value="{{$status->value}}">{{$status->value}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Search -->
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium dark:text-white text-gray-700 mb-1">Search</label>
                    <input type="text" wire:model.live.debounce.300ms="search"
                           class="w-full px-3 py-2 border text-gray-700  bg-theme-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Search...">
                </div>

                <!-- Reset Button -->
                @if($search || $status || $startDate || $endDate)
                    <button wire:click="resetFilters"
                            class="px-4 py-2 bg-red-600 font-bold text-gray-100 rounded-lg hover:bg-gray-300 transition">
                        Reset
                    </button>
                @endif

                <!-- Export Button -->
                {{--                <button--}}
                {{--                    class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition flex items-center gap-2">--}}
                {{--                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
                {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
                {{--                              d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>--}}
                {{--                    </svg>--}}
                {{--                    Export--}}
                {{--                </button>--}}
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-theme-primary">
                <tr class="text-gray-500 text-left text-xs font-medium uppercase tracking-wider border-b border-gray-100 ">
                    <th class="px-6 py-3">Order ID
                    </th>
                    <th class="px-6 py-3">Customer Name
                    </th>
                    <th class="px-6 py-3">Delivery Type
                    </th>
                    <th class="px-6 py-3">Total Amount
                    </th>
                    <th class="px-6 py-3">Status
                    </th>
                    <th class="px-6 py-3">Payment Status
                    </th>
                    <th class="px-6 py-3">Date Created</th>
                    <th class="px-6 py-3">Estimate Completion Date</th>
                    <th class="px-6 py-3">Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-theme-primary text-gray-700">
                @forelse($orders as $order)
                    @php
                        if ($order->estimated_completion_date === null) {
                            $daysLeft = null;
                        } else {
                            $daysLeft = floor(Carbon::now()->diffInDays(Carbon::parse($order->estimated_completion_date)));

                        }
//                        $daysLeft = Carbon::parse($order->created_at)->diffInDays(Carbon::parse($order->estimated_completion_date));

                         if ($order->status === 'completed') {
                            $urgency = 'none';
                        } elseif ($daysLeft && $daysLeft < 1) {
                            $urgency = 'high';
                        } elseif ($daysLeft == 1) {
                            $urgency = 'medium';
                        } else {
                            $urgency = 'none';
                        }

                        $urgencyStyles = [
                            'high' => ' border-l-4 border-red-700 dark:border-red-700',
                            'medium' => 'border-l-4 border-amber-600 dark:border-amber-600',
                            'low' => 'border-l-4 border-blue-600 dark:border-blue-600',
                            'none' => ''
                        ];

                    @endphp

                    <tr class="{{$urgencyStyles[$urgency]}}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $order->reference }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm ">{{ $order->user?->first_name  }}</td>
                        {{--                        <td class="px-6 py-4 whitespace-nowrap text-sm ">{{ Str::limit($order->address, 35, '...')  }}</td>--}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $order->delivery_type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $order->total_amount }}</td>
                        <td class="px-6 py-4 whitespace-nowrap flex items-center justify-center">
                                <span class="px-3 py-2 inline-flex text-xs font-semibold rounded-full {{OrderStatus::from($order->status)->color()}} ">
                                    {{ OrderStatus::from($order->status)->humanReadable()  }}
                                </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-2 inline-flex text-xs font-semibold rounded-full
                                    {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->payment_status === 'unpaid' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ Str::pascal($order->payment_status) }}
                                </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm ">
                            {{ Carbon::parse($order->created_at)->format('M d Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm flex items-center gap-2 justify-center">
                            <span>
                            {{ $order->estimated_completion_date ? Carbon::parse($order->estimated_completion_date)->format('M d Y') : '--' }}
{{--                                {{$daysLeft}}--}}
                                </span>

                            @if($daysLeft && $daysLeft < 1 && $order->status !== 'completed')
                                <i class="bx bx-siren text-red-600 text-lg font-bold"></i>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex gap-2">
                                <button
                                    class="px-3 py-1 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                                    View
                                </button>
                                <button
                                    class="px-3 py-1 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                                    Update
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="px-6 py-4 text-center text-gray-500">
                            No Orders Yet.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
    </div>
</div>
