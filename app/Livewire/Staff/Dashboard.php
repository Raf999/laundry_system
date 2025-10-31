<?php

namespace App\Livewire\Staff;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('layouts.staff.app')]
    #[Title('Dashboard')]
    public function render()
    {
        return view('livewire.staff.dashboard');
    }
}
