<?php

namespace App\Livewire\Staff;

use App\Enum\OrderStatus;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $startDate = '';
    public $endDate = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'startDate' => ['except' => ''],
        'endDate' => ['except' => '']
    ];

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

    public function resetFilters(): void
    {
        $this->reset(['search', 'status', 'startDate', 'endDate']);
        $this->resetPage();
    }
    #[Layout('layouts.staff.app')]
    #[Title('Orders')]
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
        )->orderByRaw('estimated_completion_date IS NULL ASC')->oldest('estimated_completion_date')->paginate();

        return view('livewire.staff.orders', compact('orders'));
    }
}
