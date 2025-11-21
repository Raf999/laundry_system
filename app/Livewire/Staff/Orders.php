<?php

namespace App\Livewire\Staff;

use App\Enum\OrderStatus;
use App\Models\ClothingType;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pricing;
use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

class Orders extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $start_date = '';
    public $end_date = '';

    // Update side sheet properties
    public $showUpdateSheet = false;
    public $selectedOrderId = null;
    public $updateForm = [
        'status' => '',
        'delivery_type' => '',
        'delivery_address' => '',
        'delivery_cost' => 0,
        'estimated_completion_date' => '',
        'discount_amount' => 0,
        'amount_paid' => 0,
    ];

    // Order items management
    public $order_items = [];
    public $new_item = [
        'clothing_type_id' => '',
        'service_id' => '',
        'quantity' => 1,
        'color' => '',
    ];
    public $clothing_types;
    public $services;


    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'startDate' => ['except' => ''],
        'endDate' => ['except' => '']
    ];

    public function mount()
    {
        $this->clothing_types = ClothingType::all();
        $this->services = Service::all();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function updatingStartDate(): void
    {
        $this->resetPage();
    }

    public function updatingEndDate(): void
    {
        $this->resetPage();
    }

    public function openUpdateSheet($orderId): void
    {
        $order = Order::with(['items.clothingType', 'items.service'])->findOrFail($orderId);
        
        $this->selectedOrderId = $orderId;
        $this->updateForm = [
            'status' => $order->status,
            'delivery_type' => $order->delivery_type,
            'delivery_address' => $order->delivery_address ?? '',
            'delivery_cost' => $order->delivery_cost,
            'estimated_completion_date' => $order->estimated_completion_date ? \Carbon\Carbon::parse($order->estimated_completion_date)->format('l d F Y') : '',
            'discount_amount' => $order->discount_amount,
            'amount_paid' => $order->amount_paid,
        ];

        // Load order items
        $this->order_items = $order->items->map(function ($item) {
            return [
                'id' => $item->id,
                'clothing_type_id' => $item->clothing_type_id,
                'service_id' => $item->service_id,
                'quantity' => $item->quantity,
                'color' => $item->color,
                'unit_price' => $item->unit_price,
                'clothing_type_name' => $item->clothingType->type ?? '',
                'service_name' => $item->service->name ?? '',
            ];
        })->toArray();

        // Reset new item form
        $this->new_item = [
            'clothing_type_id' => '',
            'service_id' => '',
            'quantity' => 1,
            'color' => '',
        ];
        
        $this->showUpdateSheet = true;
        $this->dispatch('updateSheetOpened');
    }

    public function closeUpdateSheet(): void
    {
        $this->showUpdateSheet = false;
        $this->selectedOrderId = null;
        $this->reset('updateForm', 'order_items', 'new_item');
        $this->resetValidation();
    }

    public function addOrderItem(): void
    {
        $this->validate([
            'new_item.clothing_type_id' => 'required|exists:clothing_types,id',
            'new_item.service_id' => 'required|exists:services,id',
            'new_item.quantity' => 'required|integer|min:1',
            'new_item.color' => 'required|string',
        ]);

        $clothing = $this->clothing_types->firstWhere('id', $this->new_item['clothing_type_id']);
        $service = $this->services->firstWhere('id', $this->new_item['service_id']);
        $pricing = Pricing::where('clothing_type_id', $this->new_item['clothing_type_id'])
                          ->where('service_id', $this->new_item['service_id'])
                          ->first();

        $this->order_items[] = [
            'id' => null, // null means it's a new item
            'clothing_type_id' => $this->new_item['clothing_type_id'],
            'service_id' => $this->new_item['service_id'],
            'quantity' => $this->new_item['quantity'],
            'color' => $this->new_item['color'],
            'unit_price' => $pricing->price ?? 0,
            'clothing_type_name' => $clothing->type ?? '',
            'service_name' => $service->name ?? '',
        ];

        // Reset the form
        $this->new_item = [
            'clothing_type_id' => '',
            'service_id' => '',
            'quantity' => 1,
            'color' => '',
        ];
        $this->resetValidation(['new_item.*']);
    }

    public function removeOrderItem($index): void
    {
        unset($this->order_items[$index]);
        $this->order_items = array_values($this->order_items); // reindex
    }

    public function updateItemQuantity($index, $quantity): void
    {
        if ($quantity >= 1) {
            $this->order_items[$index]['quantity'] = (int)$quantity;
        }
    }

    public function updateOrder(): void
    {
        $this->validate([
            'updateForm.status' => 'required|string',
            'updateForm.delivery_type' => 'required|string',
            'updateForm.delivery_address' => 'nullable|string',
            'updateForm.delivery_cost' => 'required|numeric|min:0',
            'updateForm.estimated_completion_date' => 'nullable|date',
            'updateForm.discount_amount' => 'required|numeric|min:0',
            'updateForm.amount_paid' => 'required|numeric|min:0',
            'order_items' => 'required|array|min:1',
        ]);

        $order = Order::findOrFail($this->selectedOrderId);
        
        // Update order details
        $order->update([
            'status' => $this->updateForm['status'],
            'delivery_type' => $this->updateForm['delivery_type'],
            'delivery_address' => $this->updateForm['delivery_address'],
            'delivery_cost' => $this->updateForm['delivery_cost'],
            'estimated_completion_date' => $this->updateForm['estimated_completion_date'] ? \Carbon\Carbon::parse($this->updateForm['estimated_completion_date']) : null,
            'discount_amount' => $this->updateForm['discount_amount'],
            'amount_paid' => $this->updateForm['amount_paid'],
        ]);

        // Get existing item IDs
        $existingItemIds = collect($this->order_items)
            ->filter(fn($item) => isset($item['id']) && $item['id'])
            ->pluck('id')
            ->toArray();

        // Delete removed items
        OrderItem::where('order_id', $order->id)
            ->whereNotIn('id', $existingItemIds)
            ->delete();

        // Update or create order items
        foreach ($this->order_items as $item) {
            if (isset($item['id']) && $item['id']) {
                // Update existing item
                OrderItem::where('id', $item['id'])->update([
                    'quantity' => $item['quantity'],
                    'color' => $item['color'],
                ]);
            } else {
                // Create new item
                OrderItem::create([
                    'order_id' => $order->id,
                    'clothing_type_id' => $item['clothing_type_id'],
                    'service_id' => $item['service_id'],
                    'quantity' => $item['quantity'],
                    'color' => $item['color'],
                    'unit_price' => $item['unit_price'],
                ]);
            }
        }

        $this->closeUpdateSheet();
        session()->flash('message', 'Order updated successfully!');
    }


    public function resetFilters(): void
    {
        $this->reset(['search', 'status', 'startDate', 'endDate']);
        $this->resetPage();
    }
    #[Layout('layouts.staff.app')]
    #[Title('Orders')]
    #[AsEventListener('orderSaved')]
    public function render()
    {
    $orders = Order::where('company_id', auth('staff')->user()->company->id)->with('user')
        ->orderByRaw(
            "CASE
                WHEN status = 'processing' THEN 1
                WHEN status = 'ready_for_washing' THEN 2
                WHEN status = 'washed' THEN 3
                WHEN status = 'ready_for_ironing' THEN 4
                WHEN status = 'ironed' THEN 5
                WHEN status = 'ready_for_pickup' THEN 6
                WHEN status = 'delivered' THEN 7
                WHEN status = 'completed' THEN 8
                ELSE 9
            END"
        )->orderByRaw('estimated_completion_date IS NULL ASC')
        ->when($this->start_date, function (Builder $query) {
            $query->whereDate('created_at', '>=', $this->start_date);
        })
        ->when($this->end_date, function (Builder $query) {
            $query->whereDate('created_at', '<=', $this->end_date);
        })
        ->oldest('estimated_completion_date')->paginate();

        return view('livewire.staff.orders', compact('orders'));
    }
}
