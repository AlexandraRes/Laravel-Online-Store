<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\Concerns\Translatable;

class OrdersRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'orders';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('resource.order.title.plural'))
            ->recordTitleAttribute('id')

            ->columns([
                TextColumn::make('id')
                    ->label(__('resource.shared.fields.id'))
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label(__('resource.shared.fields.created_at'))
                    ->formatStateUsing(
                        fn($state) => $state
                        ? \Carbon\Carbon::parse($state)->translatedFormat('d F, Y H:i:s')
                        : null
                    )
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label(__('resource.shared.fields.user_name'))
                    ->searchable()
                    ->sortable(),

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
                    ->formatStateUsing(fn(string $state) => __('resource.order.status.' . $state))
                    ->icon(fn(string $state): string => match ($state) {
                        'new' => 'heroicon-m-sparkles',
                        'processing' => 'heroicon-m-arrow-path',
                        'shipped' => 'heroicon-m-truck',
                        'delivered' => 'heroicon-m-check-badge',
                        'canceled' => 'heroicon-m-x-circle',
                    }),

                TextColumn::make('payment_method')
                    ->label(__('resource.shared.fields.payment_method'))
                    ->formatStateUsing(fn(string $state) => __('resource.order.payment_method.' . $state))
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
                    ->formatStateUsing(fn(string $state) => __('resource.order.payment_status.' . $state))
                    ->icon(fn(string $state): string => match ($state) {
                        'pending' => 'heroicon-m-arrow-path',
                        'paid' => 'heroicon-m-check-badge',
                        'failed' => 'heroicon-m-x-circle',
                    }),

                TextColumn::make('grand_total')
                    ->label(__('resource.shared.fields.grand_total'))
                    ->numeric()
                    ->money('MDL')
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('new_order')
                    ->label(__('resource.order.new_order'))
                    ->icon('heroicon-o-plus-circle')
                    ->action(function () {

                        $userId = $this->ownerRecord->id;
                        session()->put('orders.return_url', url()->previous());
                        return redirect()->route('filament.admin.resources.orders.create', ['user_id' => $userId]);

                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label(__('resource.shared.fields.edit'))
                    ->url(function ($record) {

                        session()->put('orders.return_url', url()->previous());
                        return route('filament.admin.resources.orders.edit', ['record' => $record->getKey()]);

                    })
                    ->openUrlInNewTab(false),
                Tables\Actions\DeleteAction::make()
                    ->label(__('resource.shared.fields.delete')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label(__('resource.shared.bulk.delete'))
                        ->modalHeading(__('resource.shared.bulk.delete_heading'))
                        ->modalDescription(__('resource.shared.bulk.delete_description'))
                        ->successNotificationTitle(__('resource.shared.bulk.delete_success')),
                ]),
            ]);
    }
}
