<?php

namespace App\Livewire\Admin;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class CompaniesList extends Component
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

    #[Layout('layouts.admin')]
    #[Title('Companies')]
    public function render()
    {
        $companies = Company::query()
            ->when($this->search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%')
                      ->orWhere('phone', 'like', '%' . $search . '%');
            })
        ->when($this->status, function ($query, $status) {
            $query->where('status', $status);
        })
        ->when($this->startDate && $this->endDate, function ($query) {
            $query->whereBetween('created_at', [
                Carbon::parse($this->startDate)->startOfDay(),
                Carbon::parse($this->endDate)->endOfDay()
            ]);
        })->orderBy('created_at', 'asc')->paginate(10);

        return view('livewire.admin.companies-list', [
            'companies' => $companies
        ]);
    }
}
