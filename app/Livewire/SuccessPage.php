<?php

namespace App\Livewire;

use App\Helpers\CartManagment;
use Livewire\Component;
use App\Models\Order;
use Livewire\Attributes\Url;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use App\Livewire\Partials\Navbar;

class SuccessPage extends Component
{
    #[Url]
    public $session_id;

    public function render()
    {

        $latest_order = Order::with('address')->where('user_id', auth()->user()->id)->latest()->first();

        if ($this->session_id) {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $session_info = Session::retrieve($this->session_id);
            if ($session_info->payment_status != 'paid') {
                $latest_order->payment_status = 'failed';
                $latest_order->save();
                return redirect()->route('cancel');
            } elseif ($session_info->payment_status == 'paid') {
                CartManagment::clearCartItemFromCookie();
                $this->dispatch('update-cart-count', total_count: 0)->to(Navbar::class);
                $latest_order->payment_status = 'paid';
                $latest_order->save();
            }
        } elseif ($latest_order->payment_method == 'cod') {
            CartManagment::clearCartItemFromCookie();
            $this->dispatch('update-cart-count', total_count: 0)->to(Navbar::class);
        }

        return view('livewire.success_page', [
            'latest_order' => $latest_order,
        ])
        ->title(__('success.page_title') . config('app.name'));
    }
}
