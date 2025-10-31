<?php

namespace App\Livewire\Staff;

use App\Services\Util;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    public function getKpis(): object
    {
        return (object) [

            'revenue' => [
                'title' => 'Today\'s Revenue',
                'value' => Util::formatMoney(145000),
                'percentage' => 10,
                'color' => 'purple',
                'icon' => 'bx bx-dollar-circle'
            ],
            'active_orders' => [
                'title' => 'Active Orders',
                'value' => Util::formatNumber(100),
                'percentage' => 12,
                'color' => 'amber',
                'icon' => 'bx bx-bell-check'
            ],
            'ready_for_pickup' => [
                'title' => 'Ready for Pickup',
                'value' => Util::formatNumber(100),
                'percentage' => 14,
                'color' => 'emerald',
                'icon' => 'bx bx-cycling'
            ],
            'pending_payments' => [
                'title' => 'Pending Payments',
                'value' => Util::formatMoney(100),
                'percentage' => 20,
                'color' => 'gray',
                'icon' => 'bx bx-coins'
            ],
        ];
    }

    #[Layout('layouts.staff.app')]
    #[Title('Dashboard')]
    public function render()
    {
        return view('livewire.staff.dashboard', [
            'kpis' => $this->getKpis()
        ]);
    }
}
