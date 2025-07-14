<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected function getHeading(): ?string
    {
        return __('resource.order.widget.order_stats.heading');
    }

    protected function getDescription(): ?string
    {
        return __('resource.order.widget.order_stats.description');
    }

    protected function getStats(): array
    {
        return [
            Stat::make(__('resource.order.widget.order_stats.new_orders'), Order::query()->where('status', 'new')->count())
                ->description(__('resource.order.widget.order_stats.new_orders_description'))
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make(__('resource.order.widget.order_stats.processing_orders'), Order::query()->where('status', 'processing')->count()),

            Stat::make(__('resource.order.widget.order_stats.shipped_orders'), Order::query()->where('status', 'shipped')->count()),
        ];
    }

}

