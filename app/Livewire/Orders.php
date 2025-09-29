<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Orders extends Component
{
    #[Layout('layouts.employee')]
    #[Title('Orders')]
    public function render()
    {
        return view('livewire.employees.orders');
    }
}
