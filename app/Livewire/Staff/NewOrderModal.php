<?php

namespace App\Livewire\Staff;

use App\Enum\ActivityType;
use App\Enum\DeliveryType;
use App\Enum\OrderStatus;
use App\Models\Activity;
use App\Models\ClothingType;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pricing;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class NewOrderModal extends Component
{
    public $showModal = false;
    public $customerName = '';

    // customer info
    public $phone = '';
    public $customer_id = null;
    public $customer_name = '';
    public $customer_email = '';
    public $address = '';

    // order info
    public $order_items = [];
    public $estimated_completion_date = null;
    public $payment_method = '';
    public $clothing_types;
    public $services;
    public $new_item;

    public $isExistingCustomer = false;
    public $searchingCustomer = false;
    protected $listeners = ['openOrderModal' => 'openModal'];


    public function mount()
    {
        $this->clothing_types = ClothingType::all();
        $this->services = Service::all();
        $this->new_item = [
            'clothing_type_id' => '',
            'service_id' => '',
            'quantity' => 1,
            'color' => '',
        ];
    }

    public function addOrderItem()
    {
        $this->validate([
            'new_item.clothing_type_id' => 'required|exists:clothing_types,id',
            'new_item.service_id' => 'required|exists:services,id',
            'new_item.quantity' => 'required|integer|min:1',
            'new_item.color' => 'required|string',
        ]);

        $clothing = $this->clothing_types->firstWhere('id', $this->new_item['clothing_type_id']);
        $service = $this->services->firstWhere('id', $this->new_item['service_id']);

        $this->order_items[] = [
            ...$this->new_item,
            'clothing_type_name' => $clothing->type ?? '',
            'service_name' => $service->name ?? '',
        ];
    }


    public function removeOrderItem($index): void
    {
        unset($this->order_items[$index]);
        $this->order_items = array_values($this->order_items); // reindex
    }

    public function openModal(): void
    {
        $this->showModal = true;
        $this->dispatch('modalOpened', title: 'New Order');
    }

    public function resetForm(): void
    {
        $this->reset(['phone', 'customer_id', 'customer_name', 'customer_email', 'address', 'order_items', 'estimated_completion_date', 'payment_method']);
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm(); // Reset form fields
    }

    public function updatedPhone($value): void
    {
        // Clean phone number (remove spaces, dashes, etc.)
        $cleanPhone = preg_replace('/[^0-9+]/', '', $value);

        // Only search if phone number has reasonable length (adjust as needed)
        if (strlen($cleanPhone) >= 10) {
            $this->searchCustomer($cleanPhone);
        } else {
            $this->clearCustomerInfo();
        }
    }

    public function searchCustomer($phone): void
    {
        $this->searchingCustomer = true;

        // Search for customer by phone
        $customer = User::where('phone', $phone)
            ->orWhere('phone', 'LIKE', '%' . $phone . '%')
            ->first();

        if ($customer) {
            //populate fields
            $this->customer_id = $customer->id;
            $this->customer_name = $customer->name;
            $this->customer_email = $customer->email ?? '';
            $this->address = $customer->address ?? '';
            $this->isExistingCustomer = true;

            // Optional: Show success message
            session()->flash('customer_found', 'Customer found! Information loaded.');
        } else {
            // New customer - clear fields but keep phone
            $this->clearCustomerInfo();
            $this->isExistingCustomer = false;
        }

        $this->searchingCustomer = false;
    }

    public function clearCustomerInfo(): void
    {
        $this->customer_id = null;
        $this->customer_name = '';
        $this->customer_email = '';
        $this->address = '';
        $this->isExistingCustomer = false;
    }

    public function saveOrder():void
    {
        // Validate and save your order
//        $this->validate([
//            'phone' => 'required|min:10',
//            'customer_name' => 'required|min:3',
//            'order_items' => 'required|array|min:1',
//            'payment_method' => 'required',
//            'estimated_completion_date' => 'nullable|date',
//        ]);


        // Save logic here
        if ($this->isExistingCustomer) {
            // Update existing customer info if needed
            $customer = User::find($this->customer_id);
            $customer->update([
                'name' => $this->customer_name,
                'email' => $this->customer_email,
                'address' => $this->address,
            ]);
        } else {
            // Create a new customer
            $customer = User::create([
                'name' => $this->customer_name,
                'phone' => $this->phone,
                'email' => $this->customer_email,
                'address' => $this->address,
            ]);
            $this->customer_id = $customer->id;
        }

        $ref = 'ORD-' . now()->format('YmdHis');;
        // Create Order
        $order = Order::create([
            'user_id' => $this->customer_id,
            'reference' => $ref,
            'staff_in_id' => auth()->id(),
            'company_id' => auth()->user()->company->id,
            'delivery_address' => $this->address,
            'payment_method' => $this->payment_method,
            'estimated_completion_date' => Carbon::parse($this->estimated_completion_date)->toDateTimeString(),
            'status' => OrderStatus::PROCESSING->value,
            'delivery_type' => DeliveryType::STORE_PICKUP->value,
        ]);

        foreach ($this->order_items as $item) {
            $pricing = Pricing::where('clothing_type_id', $item['clothing_type_id'])->where('service_id', $item['service_id'])->firstOrFail();

            OrderItem::create([
                'order_id' => $order->id,
                'clothing_type_id' => $item['clothing_type_id'],
                'unit_price' => $pricing->price,
                'quantity' => $item['quantity'],
                'service_id' => $item['service_id'],
                'color' => $item['color'],
            ]);
        }

        Activity::create([
            'type' => ActivityType::ORDERS->value,
            'description' => 'New order created for ' . $this->customer_name,
            'company_id' => auth()->user()->company->id
        ]);

        $this->closeModal();
        $this->dispatch('orderSaved'); // Optional: emit event to refresh the parent component
    }

    public function render()
    {
        return view('livewire.staff.new-order-modal');
    }
}
