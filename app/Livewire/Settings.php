<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Settings extends Component
{
    #[Layout('layouts.employee')]
    #[Title('Settings')]
    public function render()
    {
        return view('livewire.employees.settings');
    }
}
