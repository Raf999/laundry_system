<?php

namespace App\Livewire\Admin;

use App\Enum\CompanyStatus;
use App\Models\Company;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Companies extends Component
{

    public function getKpis(): object
    {
        return (object) [

            'total' => [
                'title' => 'Total',
                'value' => Company::count(),
                'color' => 'purple',
            ],
            'pending' => [
                'title' => 'Pending',
                'value' => Company::where('status', CompanyStatus::PENDING->value)->count(),
                'color' => 'yellow',
            ],
            'approved' => [
                'title' => 'Approved',
                'value' => Company::where('status', CompanyStatus::APPROVED->value)->count(),
                'color' => 'emerald',
            ],
            'banned' => [
                'title' => 'Banned',
                'value' => Company::where('status', CompanyStatus::BANNED->value)->count(),
                'color' => 'gray',
            ],
            'suspended' => [
                'title' => 'Suspended',
                'value' => Company::where('status', CompanyStatus::SUSPENDED->value)->count(),
                'color' => 'orange',
            ],
            'Rejected' => [
                'title' => 'Rejected',
                'value' => Company::where('status', CompanyStatus::SUSPENDED->value)->count(),
                'color' => 'red',
            ],
            'new' => [
                'title' => 'New (30 days)',
                'value' => Company::where('created_at', '>=', now()->subDays(30))->count(),
                'color' => 'lime',
            ],
            'Active' => [
                'title' => 'Active',
                'value' => 1000000,
                'color' => 'blue',
            ],
        ];
    }

    #[Layout('layouts.admin')]
    #[Title('Companies')]
    public function render()
    {
        return view('livewire.admin.companies', [
            'kpis' => $this->getKpis(),
        ]);
    }
}
