<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagment;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{

    public $total_count = 0;

    public $login = '';

    #[On('update-cart-count')]
    public function updateCartCount($total_count)
    {
        $this->total_count = $total_count;
    }

    #[On('update-user-login')]
    public function updateUserLogin($login)
    {
        $this->login = $login;
    }

    public function mount()
    {
        $this->login = auth()->user()->name ?? '';
        $this->total_count = count(CartManagment::getAllCartItemsFromCookie());
    }

    public function switchLocale($locale)
    {
        if (in_array($locale, config('app.supported_locales'))) {
            session(['locale' => $locale]);
        }

        return redirect(request()->header('Referer') ?? '/');
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
