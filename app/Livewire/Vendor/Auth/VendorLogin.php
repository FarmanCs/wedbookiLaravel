<?php

namespace App\Livewire\Vendor\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth.simple')]
class VendorLogin extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::guard('vendor')->attempt([
            'email' => $this->email,
            'password' => $this->password
        ], $this->remember)) {
            session()->regenerate();

            // Update last login
            Auth::guard('vendor')->user()->update([
                'last_login' => now()
            ]);

            return redirect()->route('vendor.dashboard');
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.vendor.auth.vendor-login');

    }
}
