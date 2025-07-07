<?php

namespace App\Livewire;


use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use App\Helpers\CartManagment;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;

class CheckoutPage extends Component
{
    use WithPagination;

    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $city;
    public $state;
    public $zip_code;
    public $payment_method;


    public function mount() {
        $cart_items = CartManagment::getAllCartItemsFromCookie();

        if (count($cart_items) == 0) {
            return redirect()->route('products');
        }
    }

    public function placeOrder()
    {

        $this->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required',
            'street_address' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'zip_code' => 'required',
            'payment_method' => 'required',

        ]);

        $cart_items = CartManagment::getAllCartItemsFromCookie();

        $line_items = [];

        foreach ($cart_items as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'mdl',
                    'unit_amount' => $item['unit_amount'] * 100,
                    'product_data' => [
                        'name' => $item['name']
                    ]
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->grand_total = CartManagment::calculateGrandTotal($cart_items);
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'mdl';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        $order->notes = 'Order placed by ' . auth()->user()->name;

        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip_code = $this->zip_code;

        $redirect_url = '';

        if ($this->payment_method === 'stripe') {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $sessionCheckout = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => auth()->user()->email,
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cancel'),
            ]);

            $redirect_url = $sessionCheckout->url;
        } else {
            $redirect_url = route('success');
        }

        $order->save();
        $address->order_id = $order->id;
        $address->save();
        $order->items()->createMany($cart_items);

        Mail::to(request()->user())->send(new OrderPlaced($order));

        return redirect($redirect_url);
    }

    public function render()
    {
        $cart_items = CartManagment::getAllCartItemsFromCookie();
        $grand_total = CartManagment::calculateGrandTotal($cart_items);

        $productIds = collect($cart_items)->pluck('product_id');
        $cart_items_data = collect($cart_items)->keyBy('product_id');

        $query_cart_items = Product::whereIn('id', $productIds)->paginate(3);

        $query_cart_items->getCollection()->transform(function ($product) use ($cart_items_data) {
            $product->quantity = $cart_items_data[$product->id]['quantity'] ?? 1;
            $product->total_amount = $cart_items_data[$product->id]['total_amount'] ?? $product->price;
            return $product;
        });

        return view('livewire.checkout_page', [
            'cart_items' => $query_cart_items,
            'grand_total' => $grand_total,
        ])
        ->title( __('checkout.page_title') . config('app.name'));
    }
}
