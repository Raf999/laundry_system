@php use App\Enum\CompanyStatus;use App\Enum\OrderStatus;use Carbon\Carbon; use Illuminate\Support\Str;  @endphp

<div>
    <div class="flex justify-end pb-4">
        <button wire:click="$dispatch('openOrderModal')" class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center gap-2">
            <i class="bx bx-plus"></i>
            New Order
        </button>
    </div>

    <livewire:staff.new-order-modal></livewire:staff.new-order-modal>
    
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-2 text-green-700">
            <i class="bx bx-check-circle text-xl"></i>
            <span class="font-medium">{{ session('message') }}</span>
        </div>
    @endif

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
                        <input
                            type="text"
                            id="start_date_picker"
                            wire:model.live="start_date"
                            autocomplete="off"
                            placeholder="Start date"
                            class="flex-1 px-3 py-2 border dark:text-white  bg-theme-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-gray-800"
                        >
                        <input
                            type="text"
                            id="end_date_picker"
                            wire:model.live="end_date"
                            autocomplete="off"
                            placeholder="End date"
                            class="flex-1 px-3 py-2 border dark:text-white  bg-theme-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-gray-800"
                        >
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select wire:model.live="status"
                            class="w-full px-3 py-2 border text-gray-400 bg-theme-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="" class="">Select Status</option>
                        @foreach(OrderStatus::cases() as $status)
                            <option value="{{$status->value}}" class="text-gray-800">{{Str::headline($status->value)}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Search -->
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium dark:text-white text-gray-700 mb-1">Search</label>
                    <input type="text" wire:model.live.debounce.300ms="search"
                           class="w-full px-3 py-2 border text-gray-700  bg-theme-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
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
                        } elseif (!is_null($daysLeft) && $daysLeft < 1) {
                            $urgency = 'high';
                        } elseif ($daysLeft == 1) {
                            $urgency = 'medium';
                        } else {
                            $urgency = 'none';
                        }

                        $urgencyStyles = [
                            'high' => ' border-l-4 border-red-700 bg-red-50 dark:border-red-700',
                            'medium' => 'border-l-4 border-amber-600 bg-amber-50 dark:border-yellow-600',
                            'low' => 'border-l-4 border-blue-600 dark:border-blue-600',
                            'none' => ''
                        ];

                    @endphp

                    <tr class="{{$urgencyStyles[$urgency]}}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $order->reference }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm ">{{ $order->user?->name  }}</td>
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
                                    class="px-3 py-1 bg-blue-700 text-white rounded hover:bg-blue-900 hover:text-white transition text-xs">
                                    View
                                </button>
                                <button
                                    wire:click="openUpdateSheet({{ $order->id }})"
                                    class="px-3 py-1 bg-green-700 text-white rounded hover:bg-green-900 hover:text-white transition text-xs">
                                    Update
                                </button>

                            </div>8
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
            {{ $orders->links('vendor.pagination.tailwind') }}
        </div>
    </div>

    <!-- Update Order Side Sheet -->
    @if($showUpdateSheet)
        <div class="fixed inset-0 z-50 overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
            <!-- Background overlay with blur effect -->
            <div class="absolute inset-0 overflow-hidden">
                <!-- Backdrop -->
                <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity duration-300" wire:click="closeUpdateSheet"></div>

                <!-- Slide-over panel -->
                <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex sm:pl-16">
                    <div class="w-screen max-w-lg transform transition-transform duration-300 ease-out">
                        <div class="h-full flex flex-col bg-white shadow-2xl">
                            
                            <!-- Header -->
                            <div class="relative bg-gradient-to-r from-purple-600 via-purple-700 to-indigo-700 px-6 py-8">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0 w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                                            <i class="bx bx-edit-alt text-white text-xl"></i>
                                        </div>
                                        <div>
                                            <h2 class="text-xl font-bold text-white tracking-tight" id="slide-over-title">
                                                Update Order
                                            </h2>
                                            <p class="text-sm text-purple-100 mt-0.5">Modify order details and status</p>
                                        </div>
                                    </div>
                                    <button wire:click="closeUpdateSheet" 
                                            class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-white/10 hover:bg-white/20 text-white transition-colors duration-200">
                                        <i class="bx bx-x text-2xl"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="flex-1 overflow-y-auto bg-gray-50">
                                <form wire:submit.prevent="updateOrder" class="h-full flex flex-col">
                                    <div class="flex-1 px-6 py-6">
                                        <div class="space-y-6">
                                            
                                            <!-- Order Management Section -->
                                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                                                <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4 flex items-center">
                                                    <i class="bx bx-package text-purple-600 mr-2"></i>
                                                    Order Management
                                                </h3>
                                                
                                                <div class="space-y-4">
                                                    <!-- Order Status -->
                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                            Order Status <span class="text-red-500">*</span>
                                                        </label>
                                                        <div class="relative">
                                                            <select wire:model="updateForm.status"
                                                                    class="w-full pl-4 pr-10 py-3 border border-gray-300  rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white text-gray-900 transition-all duration-200 appearance-none shadow-sm">
                                                                <option value="">Select Status</option>
                                                                @foreach(\App\Enum\OrderStatus::cases() as $status)
                                                                    <option value="{{ $status->value }}">{{ $status->humanReadable() }}</option>
                                                                @endforeach
                                                            </select>
                                                            <i class="bx bx-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                                                        </div>
                                                        @error('updateForm.status')
                                                            <p class="mt-1.5 text-sm text-red-600 flex items-center">
                                                                <i class="bx bx-error-circle mr-1"></i>{{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <!-- Estimated Completion Date -->
                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                            Estimated Completion Date
                                                        </label>
                                                        <div class="relative">
                                                            <input type="text"
                                                                   id="update_datepicker"
                                                                   wire:model="updateForm.estimated_completion_date"
                                                                   autocomplete="off"
                                                                   class="w-full pl-4 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white text-gray-900  transition-all duration-200 shadow-sm"
                                                                   placeholder="Select completion date">
                                                            <i class="bx bx-calendar absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                                                        </div>
                                                        @error('updateForm.estimated_completion_date')
                                                            <p class="mt-1.5 text-sm text-red-600 flex items-center">
                                                                <i class="bx bx-error-circle mr-1"></i>{{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Order Items Section -->
                                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                                                <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4 flex items-center">
                                                    <i class="bx bx-list-ul text-purple-600 mr-2"></i>
                                                    Order Items
                                                </h3>
                                                
                                                <!-- Existing Order Items -->
                                                @if(count($order_items) > 0)
                                                    <div class="space-y-3 mb-4">
                                                        @foreach($order_items as $index => $item)
                                                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                                                <div class="flex-1">
                                                                    <div class="flex items-center gap-2 mb-1">
                                                                        <span class="font-medium text-gray-900">{{ $item['clothing_type_name'] }}</span>
                                                                        <span class="text-gray-400">-</span>
                                                                        <span class="text-gray-600">{{ $item['service_name'] }}</span>
                                                                    </div>
                                                                    <div class="flex items-center gap-3 text-sm text-gray-500">
                                                                        <span>Color: <span class="font-medium">{{ $item['color'] }}</span></span>
                                                                        <span>•</span>
                                                                        <span>Price: <span class="font-medium">${{ number_format($item['unit_price'], 2) }}</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-center gap-2">
                                                                    <input type="number"
                                                                           min="1"
                                                                           wire:model.live="order_items.{{ $index }}.quantity"
                                                                           class="w-16 px-2 py-1 text-gray-700 border border-gray-300 rounded text-center focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                                                           placeholder="Qty">
                                                                    <button type="button"
                                                                            wire:click="removeOrderItem({{ $index }})"
                                                                            class="p-1 text-red-600 hover:bg-red-50 rounded transition">
                                                                        <i class="bx bx-trash text-lg"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p class="text-sm text-gray-500 mb-4 text-center py-4 bg-gray-50 rounded-lg">No items added yet</p>
                                                @endif

                                                @error('order_items')
                                                    <p class="mb-3 text-sm text-red-600 flex items-center">
                                                        <i class="bx bx-error-circle mr-1"></i>{{ $message }}
                                                    </p>
                                                @enderror

                                                <!-- Add New Item Form -->
                                                <div class="pt-4 border-t border-gray-200">
                                                    <p class="text-sm font-semibold text-gray-700 mb-3">Add New Item</p>
                                                    <div class="space-y-3">
                                                        <!-- Clothing Type -->
                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-600 mb-1">Clothing Type</label>
                                                            <div class="relative">
                                                                <select wire:model="new_item.clothing_type_id"
                                                                        class="w-full pl-3 pr-10 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 text-gray-700 focus:ring-purple-500 focus:border-purple-500 appearance-none">
                                                                    <option value="">Select Type</option>
                                                                    @foreach($clothing_types as $type)
                                                                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <i class="bx bx-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-sm"></i>
                                                            </div>
                                                            @error('new_item.clothing_type_id')
                                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                        <!-- Service -->
                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-600 mb-1">Service</label>
                                                            <div class="relative">
                                                                <select wire:model="new_item.service_id"
                                                                        class="w-full pl-3 pr-10 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 text-gray-700 focus:ring-purple-500 focus:border-purple-500 appearance-none">
                                                                    <option value="">Select Service</option>
                                                                    @foreach($services as $service)
                                                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <i class="bx bx-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-sm"></i>
                                                            </div>
                                                            @error('new_item.service_id')
                                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                        <div class="grid grid-cols-2 gap-3">
                                                            <!-- Quantity -->
                                                            <div>
                                                                <label class="block text-xs font-medium text-gray-600 mb-1">Quantity</label>
                                                                <input type="number"
                                                                       min="1"
                                                                       wire:model="new_item.quantity"
                                                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 text-gray-700 focus:ring-purple-500 focus:border-purple-500"
                                                                       placeholder="1">
                                                                @error('new_item.quantity')
                                                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <!-- Color -->
                                                            <div>
                                                                <label class="block text-xs font-medium text-gray-600 mb-1">Color</label>
                                                                <input type="text"
                                                                       wire:model="new_item.color"
                                                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 text-gray-700 focus:ring-purple-500 focus:border-purple-500"
                                                                       placeholder="e.g. Blue">
                                                                @error('new_item.color')
                                                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Add Item Button -->
                                                        <button type="button"
                                                                wire:click="addOrderItem"
                                                                class="w-full px-4 py-2 bg-purple-100 text-purple-700 font-medium text-sm rounded-lg hover:bg-purple-200 transition flex items-center justify-center gap-2">
                                                            <i class="bx bx-plus"></i>
                                                            Add Item
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delivery Details Section -->
                                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                                                <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4 flex items-center">
                                                    <i class="bx bx-car text-purple-600 mr-2"></i>
                                                    Delivery Details
                                                </h3>
                                                
                                                <div class="space-y-4">
                                                    <!-- Delivery Type -->
                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                            Delivery Type <span class="text-red-500">*</span>
                                                        </label>
                                                        <div class="relative">
                                                            <select wire:model="updateForm.delivery_type"
                                                                    class="w-full pl-4 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white text-gray-900 transition-all duration-200 appearance-none shadow-sm">
                                                                <option value="">Select Delivery Type</option>
                                                                @foreach(\App\Enum\DeliveryType::cases() as $type)
                                                                    <option value="{{ $type->value }}">{{ \Illuminate\Support\Str::headline($type->value) }}</option>
                                                                @endforeach
                                                            </select>
                                                            <i class="bx bx-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                                                        </div>
                                                        @error('updateForm.delivery_type')
                                                            <p class="mt-1.5 text-sm text-red-600 flex items-center">
                                                                <i class="bx bx-error-circle mr-1"></i>{{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <!-- Delivery Address -->
                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                            Delivery Address
                                                        </label>
                                                        <textarea wire:model="updateForm.delivery_address"
                                                                  rows="3"
                                                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white text-gray-900 transition-all duration-200 resize-none shadow-sm"
                                                                  placeholder="Enter delivery address"></textarea>
                                                        @error('updateForm.delivery_address')
                                                            <p class="mt-1.5 text-sm text-red-600 flex items-center">
                                                                <i class="bx bx-error-circle mr-1"></i>{{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <!-- Delivery Cost -->
                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                            Delivery Cost <span class="text-red-500">*</span>
                                                        </label>
                                                        <div class="relative">
                                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">$</span>
                                                            <input type="number"
                                                                   step="0.01"
                                                                   min="0"
                                                                   disabled
                                                                   wire:model="updateForm.delivery_cost"
                                                                   class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white text-gray-900 transition-all duration-200 shadow-sm"
                                                                   placeholder="0.00">
                                                        </div>
                                                        @error('updateForm.delivery_cost')
                                                            <p class="mt-1.5 text-sm text-red-600 flex items-center">
                                                                <i class="bx bx-error-circle mr-1"></i>{{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Footer Actions - Sticky -->
                                    <div class="flex-shrink-0 px-6 py-5 bg-white border-t border-gray-200">
                                        <div class="flex gap-3">
                                            <button type="button"
                                                    wire:click="closeUpdateSheet"
                                                    class="flex-1 px-5 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 active:scale-95 transition-all duration-200 shadow-sm">
                                                Cancel
                                            </button>
                                            <button type="submit"
                                                    class="flex-1 px-5 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-semibold rounded-lg active:scale-95 transition-all duration-200 flex items-center justify-center gap-2 shadow-lg shadow-purple-500/30"
                                                    wire:loading.attr="disabled">
                                                <span wire:loading.remove wire:target="updateOrder" class="flex items-center gap-2">
                                                    <i class="bx bx-save"></i>
                                                    Save Changes
                                                </span>
                                                <span wire:loading wire:target="updateOrder" class="flex items-center gap-2">
                                                    <i class="bx bx-loader-alt animate-spin"></i>
                                                    Updating...
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>




@push('scripts')
    <script>

        document.addEventListener('livewire:initialized', () => {
            // Initialize datepicker when modal opens

            // const input = document.getElementById('datepicker');
            new AirDatepicker('#start_date_picker', {
                autoClose: true,
                maxDate: new Date(),
                locale: localeEn,
                dateFormat: 'EEEE d MMMM yyyy',
                onSelect: ({date}) => {
                    @this.set('start_date', date);
                }
            });
            new AirDatepicker('#end_date_picker', {
                autoClose: true,
                maxDate: new Date(),
                locale: localeEn,
                dateFormat: 'EEEE d MMMM yyyy',
                onSelect: ({date}) => {
                    @this.set('end_date', date);
                }
            });

            // Initialize datepicker for update side sheet
            Livewire.on('updateSheetOpened', () => {
                setTimeout(() => {
                    new AirDatepicker('#update_datepicker', {
                        autoClose: true,
                        minDate: new Date(),
                        locale: localeEn,
                        dateFormat: 'EEEE d MMMM yyyy',
                        onSelect: ({date}) => {
                            @this.set('updateForm.estimated_completion_date', date);
                        }
                    });
                }, 100);
            });
        });
    </script>
@endpush
