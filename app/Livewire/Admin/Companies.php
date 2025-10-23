<?php

namespace App\Livewire\Admin;

use App\Enum\CompanyStatus;
use App\Models\Company;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportPageComponents\BaseTitle;

class Companies extends Component
{

    public function getKpis(): object
    {
        return (object) [

            'total' => [
                'title' => 'Total',
                'value' => Company::count(),
                'color' => 'purple',
                'icon' => 'fas fa-users'
            ],
            'pending' => [
                'title' => 'Pending',
                'value' => Company::where('status', CompanyStatus::PENDING->value)->count(),
                'color' => 'yellow',
                'icon' => 'fas fa-clock'
            ],
            'approved' => [
                'title' => 'Approved',
                'value' => Company::where('status', CompanyStatus::APPROVED->value)->count(),
                'color' => 'emerald',
                'icon' => 'fas fa-check-circle'
            ],
            'banned' => [
                'title' => 'Banned',
                'value' => Company::where('status', CompanyStatus::BANNED->value)->count(),
                'color' => 'gray',
                'icon' => 'fas fa-ban'
            ],
            'suspended' => [
                'title' => 'Suspended',
                'value' => Company::where('status', CompanyStatus::SUSPENDED->value)->count(),
                'color' => 'orange',
                'icon' => 'fas fa-pause-circle'
            ],
            'Rejected' => [
                'title' => 'Rejected',
                'value' => Company::where('status', CompanyStatus::SUSPENDED->value)->count(),
                'color' => 'red',
                'icon' => 'fas fa-xmark-circle'
            ],
            'new' => [
                'title' => 'New (30 days)',
                'value' => Company::where('created_at', '>=', now()->subDays(30))->count(),
                'color' => 'lime',
                'icon' => 'fas fa-user-plus'
            ],
            'Active' => [
                'title' => 'Active',
                'value' => 1000000,
                'color' => 'blue',
                'icon' => 'fas fa-user-check'
            ],
        ];
    }

    #[Layout('layouts.admin.app')]
    #[Title('Companies')]
    public function render()
    {
        return view('livewire.admin.companies', [
            'kpis' => $this->getKpis(),
        ]);
    }
}
