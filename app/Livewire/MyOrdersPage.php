<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class MyOrdersPage extends Component
{
    use WithPagination;

    public function getStatusBadgeHtml($status): string
    {
        $colors = [
            'new' => 'bg-blue-500',
            'processing' => 'bg-orange-500',
            'shipped' => 'bg-green-500',
            'delivered' => 'bg-green-700',
            'canceled' => 'bg-red-500',
        ];

        $text = __('my_orders.statuses.order.' . $status);
        $color = $colors[$status] ?? 'bg-gray-500';

        return "<div class=\"{$color} py-1 px-3 rounded text-white shadow\">{$text}</div>";
    }

    public function getPaymentStatusBadgeHtml($payment_status): string
    {
        $colors = [
            'pending' => 'bg-yellow-500',
            'paid' => 'bg-green-700',
            'failed' => 'bg-red-500',
        ];

        $text = __('my_orders.statuses.payment.' . $payment_status);
        $color = $colors[$payment_status] ?? 'bg-gray-500';

        return "<div class=\"{$color} py-1 px-3 rounded text-white shadow\">{$text}</div>";
    }

    public function render()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest('created_at')
            ->paginate(10);

        return view('livewire.my_orders_page', [
            'orders' => $orders,
        ])
            ->title(__('my_orders.page_title') . config('app.name'));

    }
}
