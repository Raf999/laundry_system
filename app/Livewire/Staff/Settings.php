<?php

namespace App\Livewire\Staff;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Settings extends Component
{
    #[Layout('layouts.staff.app')]
    #[Title('Settings')]
    public function render()
    {
        return view('livewire.staff.settings');
    }
}
