<?php

namespace App\Livewire;

use App\Helpers\CartManagment;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class ProductsPage extends Component
{

    use WithPagination;

    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_brands = [];

    #[Url]
    public $featured;

    #[Url]
    public $on_sale;

    #[Url]
    public $price_range;

    public $min_price = 0;
    public $max_price = 10000;

    #[Url]
    public $sort = 'latest';

    public function updatingSelectedCategories()
    {
        $this->resetPage();
    }

    public function updatingSelectedBrands()
    {
        $this->resetPage();
    }

    public function updatingFeatured()
    {
        $this->resetPage();
    }

    public function updatingOnSale()
    {
        $this->resetPage();
    }

    public function updatingPriceRange()
    {
        $this->resetPage();
    }

    public function updatingSort()
    {
        $this->resetPage();
    }

    public function addToCart($product_id)
    {
        sleep(0.5);

        $product_name = Product::select('name')->find($product_id);

        $total_count = CartManagment::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        LivewireAlert::title('')
            ->position('bottom-end')
            ->timer(3000)
            ->success()
            ->toast()
            ->withOptions([
                'width' => 'fit-content',
                'html' => __('products.alert', ['product' => $product_name->name]),
            ])
            ->show();
    }

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);

        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if (!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }

        if ($this->featured) {
            $productQuery->where('is_featured', 1);
        }

        if ($this->on_sale) {
            $productQuery->where('on_sale', 1);
        }

        $this->min_price = $productQuery->min('price');
        $this->max_price = $productQuery->max('price');

        if (is_null($this->min_price) || is_null($this->max_price)) {
            $this->min_price = 0;
            $this->max_price = 0;
            $this->price_range = 0;
        } elseif ($this->price_range < $this->min_price || $this->price_range > $this->max_price) {
            $this->price_range = $this->max_price;
        } elseif (!$this->price_range) {
            $this->price_range = ($this->min_price + $this->max_price) / 2;
        }

        if ($this->price_range) {
            $productQuery->whereBetween('price', [$this->min_price, $this->price_range]);
        }

        if ($this->sort == 'latest') {
            $productQuery->latest();
        } elseif ($this->sort == 'price') {
            $productQuery->orderBy('price');
        }

        return view('livewire.products_page', [
            'products' => $productQuery->paginate(6),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ])
            ->title(__('products.page_title') . config('app.name'));
    }
}
