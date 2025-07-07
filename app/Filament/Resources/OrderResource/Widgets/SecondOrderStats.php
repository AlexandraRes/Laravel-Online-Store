<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;
use League\CommonMark\Extension\DescriptionList\Node\Description;

class SecondOrderStats extends BaseWidget
{
    protected ?string $heading = 'Profit information';

    protected ?string $description = 'The widgets below provide, information about profit for entire period.';

    protected function getStats(): array
    {

        return [
            Stat::make('Profit', Number::currency(Order::sum('grand_total'), 'MDL'))
                ->icon('heroicon-m-banknotes'),
        ];
    }

}

