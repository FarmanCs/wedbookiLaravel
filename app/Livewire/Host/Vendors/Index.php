<?php

namespace App\Livewire\Host\Vendors;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.host.host')]
#[Title('Vendors Management')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.host.vendors.index');
    }
}
