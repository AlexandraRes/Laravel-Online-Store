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
            null => Tab::make(__('resource.order.status.all')),
            __('resource.order.status.new') => Tab::make()->query(fn($query) => $query->where('status', __('new'))),
            __('resource.order.status.processing') => Tab::make()->query(fn($query) => $query->where('status', 'processing')),
            __('resource.order.status.shipped') => Tab::make()->query(fn($query) => $query->where('status', 'shipped')),
            __('resource.order.status.delivered') => Tab::make()->query(fn($query) => $query->where('status', 'delivered')),
            __('resource.order.status.canceled') => Tab::make()->query(fn($query) => $query->where('status', 'canceled')),
        ];
    }
}
