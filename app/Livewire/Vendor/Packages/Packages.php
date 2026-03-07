<?php

namespace App\Livewire\Vendor\Packages;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.vendor.vendor')]
class Packages extends Component
{
    public function render()
    {
        return view('livewire.vendor.packages.packages');
    }
}
