<?php

namespace App\Livewire;

use App\Helpers\CartManagment;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class CartPage extends Component
{
    public $cart_items = [];

    public $grand_total;

    public function mount()
    {
        $this->cart_items = CartManagment::getAllCartItemsFromCookie();
        $this->grand_total = CartManagment::calculateGrandTotal($this->cart_items);
    }

    public function decreaseQty($product_id)
    {
        $this->cart_items = CartManagment::decrementCartItemQuantity($product_id);
        $this->grand_total = CartManagment::calculateGrandTotal($this->cart_items);
    }

    public function increaseQty($product_id)
    {
        $this->cart_items = CartManagment::incrementCartItemQuantity($product_id);
        $this->grand_total = CartManagment::calculateGrandTotal($this->cart_items);
    }

    public function callRemoveItem($data)
    {
        $product_id = $data['product_id'];

        $this->cart_items = CartManagment::removefromCart($product_id);
        $this->grand_total = CartManagment::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
    }

    public function removeItem($product_id)
    {
        $product_name = Product::select("name")->find($product_id);

        LivewireAlert::title(__('cart.alert.title'))
            ->withOptions([
                'html' => __('cart.alert.text', ['product' => $product_name->name])
            ])
            ->position('center')
            ->withConfirmButton('Yes', )
            ->confirmButtonColor('#414558')
            ->withCancelButton('Cancel')
            ->cancelButtonColor('#00a63e')
            ->question()
            ->timer(0)
            ->onConfirm('callRemoveItem', ['product_id' => $product_id])
            ->show();

    }

    public function render()
    {
        return view('livewire.cart_page')
        ->title(__('cart.page_title') . config('app.name'));
    }
}
