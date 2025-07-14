<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('resource.shared.sections.latest_orders'))
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([

                TextColumn::make('id')
                    ->label(__('resource.shared.fields.id'))
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label(__('resource.shared.fields.user_name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('resource.shared.fields.created_at'))
                    ->sortable()
                    ->formatStateUsing(
                        fn($state) => $state
                        ? \Carbon\Carbon::parse($state)->translatedFormat('d F, Y H:i:s')
                        : null
                    ),

                TextColumn::make('status')
                    ->label(__('resource.shared.fields.status'))
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped', 'delivered' => 'success',
                        'canceled' => 'danger',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'new' => 'heroicon-m-sparkles',
                        'processing' => 'heroicon-m-arrow-path',
                        'shipped' => 'heroicon-m-truck',
                        'delivered' => 'heroicon-m-check-badge',
                        'canceled' => 'heroicon-m-x-circle',
                    })
                    ->formatStateUsing(fn(string $state): string => __('resource.order.status.' . $state)),

                TextColumn::make('payment_method')
                    ->label(__('resource.shared.fields.payment_method'))
                    ->formatStateUsing(fn($state): string => __('resource.order.payment_method.' . $state))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->label(__('resource.shared.fields.payment_status'))
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'failed' => 'danger',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'pending' => 'heroicon-m-arrow-path',
                        'paid' => 'heroicon-m-check-badge',
                        'failed' => 'heroicon-m-x-circle',
                    })
                    ->formatStateUsing(fn(string $state): string => __('resource.order.payment_status.' . $state)),

                TextColumn::make('grand_total')
                    ->label(__('resource.shared.fields.grand_total'))
                    ->numeric()
                    ->money('MDL')
                    ->sortable()
            ])
            ->actions([

                EditAction::make()
                    ->url(function ($record) {

                        session()->put('orders.return_url', url()->previous());
                        return route('filament.admin.resources.orders.edit', ['record' => $record->getKey()]);

                    })
                    ->openUrlInNewTab(false)
                    ->color('success'),

                DeleteAction::make(),
            ]);
    }
}
