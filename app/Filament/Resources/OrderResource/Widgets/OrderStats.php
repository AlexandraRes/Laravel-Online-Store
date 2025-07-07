<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected ?string $heading = 'Order information';

    protected ?string $description = 'The widgets below provide, concise information about order statuses.';

    protected function getStats(): array
    {

        return [
            Stat::make('New Orders', Order::query()->where('status', 'new')->count())
                ->description('Orders must be processed until 12:00')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Processing Orders', Order::query()->where('status', 'processing')->count()),
            Stat::make('Shipped Orders', Order::query()->where('status', 'processing')->count()),
        ];
    }

}

