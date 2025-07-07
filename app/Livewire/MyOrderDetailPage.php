<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class MyOrderDetailPage extends Component
{

    public $order;

    public function mount($order_id)
    {
        $this->order = Order::with(['items', 'address'])
            ->where('user_id', auth()->user()->id)
            ->where('id', $order_id)
            ->firstOrFail();
    }

    public function getStatusBadgeHtml($status)
    {
        $colors = [
            'new' => 'bg-blue-500',
            'processing' => 'bg-orange-500',
            'shipped' => 'bg-green-500',
            'delivered' => 'bg-green-700',
            'canceled' => 'bg-red-500',
        ];

        $text = __('my_order_detail.order_statuses.' . $status);
        $color = $colors[$status] ?? 'bg-gray-500';

        return "<div class=\" {$color} py-1 px-3 rounded text-white shadow\">{$text}</div>";
    }

    public function getPaymentStatusBadgeHtml($payment_status): string
    {
        $colors = [
            'pending' => 'bg-yellow-500',
            'paid' => 'bg-green-700',
            'failed' => 'bg-red-500',
        ];

        $text = __('my_order_detail.payment_statuses.' . $payment_status);
        $color = $colors[$payment_status] ?? 'bg-gray-500';

        return "<div class=\"{$color} py-1 px-3 rounded text-white shadow\">{$text}</div>";
    }

    public function render()
    {
        return view('livewire.my_order_detail_page')
            ->title(__('my_order_detail.page_title') . config('app.name'));
    }
}
