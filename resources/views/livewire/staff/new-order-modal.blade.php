<div>
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>

            <!-- Modal Container -->
            <div class="flex items-center justify-center min-h-screen p-4">
                <div
                    class="relative bg-theme-primary rounded-lg shadow-xl max-w-6xl w-full max-h-[90vh] overflow-y-auto">
                    <!-- Close Button -->
                    <button wire:click="closeModal"
                            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 z-10">
                        <i class="bx bx-x text-2xl"></i>
                    </button>

                    <!-- Modal Content -->
                    <div class="p-6">
                        <!-- Modal Header -->
                        <h3 class="text-lg font-semibold text-gray-900 mb-6" id="modal-title">
                            New Order
                        </h3>

                        <form wire:submit.prevent="saveOrder">
                            <!-- Step 1: Phone Number -->
                            <div class="mb-6 pb-6 border-b border-gray-200">
                                <h4 class="text-md font-semibold text-gray-700 mb-4">Step 1: Customer Phone</h4>

                                <div class="relative">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        wire:model.live.debounce.500ms="phone"
                                        placeholder="Enter customer phone number"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-gray-800"
                                    >

                                    <!-- Loading indicator -->
                                    @if($searchingCustomer)
                                        <div class="absolute right-3 top-9">
                                            <i class="bx bx-loader-alt animate-spin text-green-600"></i>
                                        </div>
                                    @endif

                                    @error('phone')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Customer Found Message -->
                                @if($isExistingCustomer)
                                    <div
                                        class="mt-3 p-3 bg-green-50 border border-green-200 rounded-lg flex items-center gap-2 text-green-700">
                                        <i class="bx bx-check-circle text-xl"></i>
                                        <span class="text-sm font-medium">Existing customer found! Information loaded below.</span>
                                    </div>
                                @endif

                                @if($phone && strlen($phone) >= 10 && !$isExistingCustomer && !$searchingCustomer)
                                    <div
                                        class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded-lg flex items-center gap-2 text-blue-700">
                                        <i class="bx bx-info-circle text-xl"></i>
                                        <span class="text-sm font-medium">New customer - please fill in their information below.</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Step 2: Customer Information -->
                            <div class="mb-6 pb-6 border-b border-gray-200">
                                <h4 class="text-md font-semibold text-gray-700 mb-4">Step 2: Customer Information</h4>

                                <div class="space-y-4">
                                    <div class="flex items-center gap-4 w-100">
                                        <!-- Customer Name -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Full Name <span class="text-red-500">*</span>
                                            </label>
                                            <input
                                                type="text"
                                                wire:model="customer_name"
                                                placeholder="Enter customer name"
                                                value="{{ $isExistingCustomer ? $customer_name : '' }}"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent {{ $isExistingCustomer ? 'bg-gray-50' : '' }} text-gray-800"
                                                {{ $isExistingCustomer ? '' : '' }}
                                            >
                                            @error('customer_name')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Customer Email -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Email
                                            </label>
                                            <input
                                                type="email"
                                                wire:model="customer_email"
                                                placeholder="Enter customer email"
                                                value="{{ $isExistingCustomer ? $customer_email : '' }}"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent  text-gray-800 {{ $isExistingCustomer ? 'bg-gray-50' : '' }}"
                                            >
                                            @error('customerEmail')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <!-- Customer Address -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Address
                                        </label>
                                        <textarea
                                            wire:model="address"
                                            rows="2"
                                            placeholder="Enter customer address"
                                            value="{{$isExistingCustomer ? $address : '' }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent  text-gray-800 {{ $isExistingCustomer ? 'bg-gray-50' : '' }}"
                                        ></textarea>
                                        @error('customerAddress')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Order Details -->
                            <div class="mb-6">
                                <h4 class="text-md font-semibold text-gray-700 mb-4">Step 3: Order Details</h4>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-100">
                                    <!-- Estimated Completion -->
                                    <div class="mb-4">
                                        <div class="mb-4">
                                            <label for="completionDate" class="block text-sm font-medium text-gray-700 mb-2">
                                                Estimated Completion Date <span class="text-red-500">*</span>
                                            </label>
                                            <input
                                                type="text"
                                                id="datepicker"
                                                wire:model="estimated_completion_date"
                                                autocomplete="off"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-gray-800"
                                                placeholder="Select completion date"
                                            >
                                        </div>
                                        @error('estimated_completion_date')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Payment Method -->
                                    <div class="mb-4">
                                        <div class="mb-4">
                                            <label for="paymentMethod" class="block text-sm font-medium text-gray-700 mb-2">
                                                Payment Method <span class="text-red-500">*</span>
                                            </label>
                                            <select
                                                wire:model="payment_method"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-gray-800"
                                            >
                                                <option value="">Select Payment Method</option>
                                                @foreach (\App\Enum\PaymentMethod::cases() as $method)
                                                    <option value="{{ $method->value }}">{{ \Illuminate\Support\Str::headline($method->value)  }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('payment_method')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Add Item Form -->
                                <div class="p-4 border border-gray-200 rounded-lg bg-white mb-4">
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                        <!-- Clothing Type -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Clothing Type <span class="text-red-500">*</span>
                                            </label>
                                            <select
                                                wire:model="new_item.clothing_type_id"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-gray-800"
                                            >
                                                <option value="">Select clothing type</option>
                                                @foreach ($clothing_types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                                @endforeach
                                            </select>
                                            @error('new_item.clothing_type_id')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Service -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Service <span class="text-red-500">*</span>
                                            </label>
                                            <select
                                                wire:model="new_item.service_id"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-gray-800"
                                            >
                                                <option value="">Select service</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('new_item.service_id')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Quantity -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Quantity <span class="text-red-500">*</span>
                                            </label>
                                            <input
                                                type="number"
                                                min="1"
                                                wire:model="new_item.quantity"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-gray-800"
                                            >
                                            @error('new_item.quantity')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Color -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Color
                                            </label>
                                            <input
                                                type="text"
                                                wire:model="new_item.color"
                                                placeholder="e.g. Blue"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-gray-800"
                                            >
                                            @error('new_item.color')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Add Button -->
                                    <div class="mt-4">
                                        <button
                                            type="button"
                                            wire:click="addOrderItem"
                                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center gap-2"
                                        >
                                            <i class="bx bx-plus"></i> Add Item
                                        </button>
                                    </div>
                                </div>

                                <!-- Item List -->
                                @if (count($order_items) > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full border border-gray-200 text-sm text-gray-800">
                                            <thead class="bg-gray-100 text-gray-700 font-medium">
                                            <tr>
                                                <th class="px-3 py-2 text-left">#</th>
                                                <th class="px-3 py-2 text-left">Clothing Type</th>
                                                <th class="px-3 py-2 text-left">Service</th>
                                                <th class="px-3 py-2 text-left">Quantity</th>
                                                <th class="px-3 py-2 text-left">Color</th>
                                                <th class="px-3 py-2 text-right">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($order_items as $index => $item)
                                                <tr class="border-t border-gray-200">
                                                    <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                                    <td class="px-3 py-2">{{ $item['clothing_type_name'] ?? '' }}</td>
                                                    <td class="px-3 py-2">{{ $item['service_name'] ?? '' }}</td>
                                                    <td class="px-3 py-2">{{ $item['quantity'] }}</td>
                                                    <td class="px-3 py-2">{{ $item['color'] }}</td>
                                                    <td class="px-3 py-2 text-right">
                                                        <button
                                                            type="button"
                                                            wire:click="removeOrderItem({{ $index }})"
                                                            class="text-red-600 hover:text-red-800"
                                                        >
                                                            <i class="bx bx-trash text-lg"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>

                            <!-- Modal Footer -->
                            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                                <button
                                    type="button"
                                    wire:click="closeModal"
                                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition"
                                >
                                    Cancel
                                </button>
                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center gap-2"
                                    wire:loading.attr="disabled"
                                >
                                    <span wire:loading.remove wire:target="saveOrder">Create Order</span>
                                    <span wire:loading wire:target="saveOrder">
                                    <i class="bx bx-loader-alt animate-spin"></i> Creating...
                                </span>
                                </button>
                            </div>
                        </form>
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
        Livewire.on('modalOpened', () => {
            setTimeout(() => {
                // const input = document.getElementById('datepicker');
                    new AirDatepicker('#datepicker', {
                        autoClose: true,
                        minDate: new Date(),
                        locale: localeEn,
                        dateFormat: 'EEEE d MMMM yyyy',
                        onSelect: ({date}) => {
                            @this.set('estimated_completion_date', date);
                        }
                    });
            }, 100);
        });
    });
</script>
@endpush
