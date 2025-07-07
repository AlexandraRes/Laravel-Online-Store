<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\NewOrdersStat;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use App\Filament\Resources\OrderResource\Widgets\ProcessingOrdersStat;
use App\Filament\Resources\OrderResource\Widgets\ProfitStat;
use App\Filament\Resources\OrderResource\Widgets\SecondOrderStats;
use App\Filament\Resources\OrderResource\Widgets\ShippedOrdersStat;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;


class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->icon('heroicon-o-plus-circle'),

        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::class,
            SecondOrderStats::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'New' => Tab::make()->query(fn($query) => $query->where('status', 'new')),
            'Processing' => Tab::make()->query(fn($query) => $query->where('status', 'processing')),
            'Shipped' => Tab::make()->query(fn($query) => $query->where('status', 'shipped')),
            'Delivered' => Tab::make()->query(fn($query) => $query->where('status', 'delivered')),
            'Canceled' => Tab::make()->query(fn($query) => $query->where('status', 'canceled')),
        ];
    }
}
