<?php

namespace App\Livewire\Staff;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Orders extends Component
{
    #[Layout('layouts.staff.app')]
    #[Title('Orders')]
    public function render()
    {
        return view('livewire.staff.orders');
    }
}
