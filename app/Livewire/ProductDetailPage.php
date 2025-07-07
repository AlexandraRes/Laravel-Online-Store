<?php

namespace App\Livewire;

use App\Helpers\CartManagment;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class ProductDetailPage extends Component
{
    public $slug;
    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public $quantity = 1;

    public function increaseQty()
    {
        $this->quantity++;
    }

    public function decreaseQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart($product_id)
    {
        sleep(0.5);

        $total_count = CartManagment::addItemToCartWithQty($product_id, $this->quantity);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        LivewireAlert::title(__('product_detail.alert'))
            ->position('bottom-end')
            ->timer(3000)
            ->success()
            ->toast()
            ->withOptions(['width' => 'fit-content'])
            ->show();
    }

    public function render()
    {
        return view('livewire.product_detail_page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ])
        ->title( __('product_detail.page_title') . config('app.name'));
    }
}
