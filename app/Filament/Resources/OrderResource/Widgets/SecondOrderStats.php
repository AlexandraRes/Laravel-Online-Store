<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;


class SecondOrderStats extends BaseWidget
{
    use HasWidgetShield;

    protected function getHeading(): ?string
    {
        return __('resource.order.widget.second_order_stats.heading');
    }

    protected function getDescription(): ?string
    {
        return __('resource.order.widget.second_order_stats.description');
    }

    protected function getStats(): array
    {
        return [
            Stat::make(__('resource.order.widget.second_order_stats.profit'), Number::format(Order::sum('grand_total') , 2) . ' MDL')
                ->icon('heroicon-m-banknotes')
                ->extraAttributes(['class' => 'col-span-full']),
        ];
    }
}

