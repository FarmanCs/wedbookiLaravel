<?php

namespace App\Livewire\Vendor\Reviews;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.vendor.vendor')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.vendor.reviews.index');
    }
}
