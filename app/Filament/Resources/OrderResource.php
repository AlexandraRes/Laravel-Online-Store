<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Models\Order;
use App\Models\Product;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Number;
use Filament\Resources\RelationManagers\Concerns\Translatable;


class OrderResource extends Resource
{

    use Translatable;

    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return __('resource.order.title.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resource.order.title.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make(__('resource.shared.sections.order_information'))->schema([
                        Select::make('user_id')
                            ->label(__('resource.shared.fields.name'))
                            ->required()
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),

                        Select::make('payment_method')
                            ->label(__('resource.shared.fields.payment_method'))
                            ->options([
                                'stripe' => __('resource.order.payment_method.stripe'),
                                'cod' => __('resource.order.payment_method.cod'),
                            ])
                            ->required(),

                        Select::make('payment_status')
                            ->label(__('resource.shared.fields.payment_status'))
                            ->options([
                                'pending' => __('resource.order.payment_status.pending'),
                                'paid' => __('resource.order.payment_status.paid'),
                                'failed' => __('resource.order.payment_status.failed'),

                            ])
                            ->required()
                            ->default('pending'),

                        ToggleButtons::make('status')
                            ->label(__('resource.shared.fields.status'))
                            ->options([
                                'new' => __('resource.order.status.new'),
                                'processing' => __('resource.order.status.processing'),
                                'shipped' => __('resource.order.status.shipped'),
                                'delivered' => __('resource.order.status.delivered'),
                                'canceled' => __('resource.order.status.canceled'),
                            ])
                            ->colors([
                                'new' => 'info',
                                'processing' => 'warning',
                                'shipped' => 'success',
                                'delivered' => 'success',
                                'canceled' => 'danger',
                            ])
                            ->icons([
                                'new' => 'heroicon-m-sparkles',
                                'processing' => 'heroicon-m-arrow-path',
                                'shipped' => 'heroicon-m-truck',
                                'delivered' => 'heroicon-m-check-badge',
                                'canceled' => 'heroicon-m-x-circle',
                            ])
                            ->required()
                            ->inline()
                            ->default('new')
                            ->columnSpanFull(),

                        Select::make('currency')
                            ->label(__('resource.shared.fields.currency'))
                            ->options([
                                'mdl' => 'MDL',
                                'rub' => 'RUB',
                                'usd' => 'USD',
                                'eur' => 'EUR'
                            ])
                            ->required()
                            ->default('mdl')
                            ->placeholder('Select desiered option'),

                        Select::make('shipping_method')
                            ->label(__('resource.shared.fields.shipping_method'))
                            ->options([
                                'fedex' => 'FedEx',
                                'ups' => 'UPS',
                                'dhl' => 'DHL',
                                'usps' => 'USPS',
                            ]),

                        Textarea::make('notes')
                            ->label(__('resource.shared.fields.notes'))
                            ->columnSpanFull(),
                    ])->columns(2),

                    Section::make(__('resource.shared.sections.order_items'))->schema([
                        Repeater::make('items')
                            ->label(__('resource.shared.fields.items'))
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->label(__('resource.shared.fields.item'))
                                    ->relationship('product', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->distinct()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->columnSpan(4)
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Set $set) {
                                        $price = Product::find($state)?->price ?? 0;

                                        $set('unit_amount', $price);
                                        $set('total_amount', $price);
                                        $set('quantity', 1);

                                    }),

                                TextInput::make('quantity')
                                    ->label(__('resource.shared.fields.quantity'))
                                    ->required()
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1)
                                    ->columnSpan(2)
                                    ->reactive()
                                    ->afterStateUpdated(fn($state, Set $set, Get $get) => $set('total_amount', $state * $get('unit_amount'))),

                                TextInput::make('unit_amount')
                                    ->label(__('resource.shared.fields.unit_amount'))
                                    ->required()
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(3),

                                TextInput::make('total_amount')
                                    ->label(__('resource.shared.fields.total_amount'))
                                    ->required()
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(3),

                            ])->columns(12),

                        Group::make()->schema([
                            Placeholder::make('grand_total_placeholder')
                                ->label(__('resource.shared.fields.grand_total'))
                                ->content(function (Get $get, Set $set) {
                                    $items = $get('items') ?? [];

                                    $total = collect($items)
                                        ->pluck('total_amount')
                                        ->sum();

                                    $set('grand_total', $total);

                                    return Number::currency($total, 'MDL');
                                }),
                        ])
                            ->extraAttributes(['class' => 'flex justify-end'])
                            ->columnSpanFull(),

                        Hidden::make('grand_total')
                            ->default(0),
                    ])

                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([

                TextColumn::make('id')
                    ->label(__('resource.shared.fields.id'))
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label(__('resource.shared.fields.created_at'))
                    ->sortable()
                    ->formatStateUsing(
                        fn($state) => $state
                        ? \Carbon\Carbon::parse($state)->translatedFormat('d F, Y H:i:s')
                        : null
                    )
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('resource.shared.fields.updated_at'))
                    ->sortable()
                    ->formatStateUsing(
                        fn($state) => $state
                        ? \Carbon\Carbon::parse($state)->translatedFormat('d F, Y H:i:s')
                        : null
                    )
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('user.name')
                    ->label(__('resource.shared.fields.user_name'))
                    ->sortable(),

                TextColumn::make('grand_total')
                    ->label(__('resource.shared.fields.grand_total'))
                    ->sortable()
                    ->numeric()
                    ->money('MDL'),

                TextColumn::make('payment_method')
                    ->label(__('resource.shared.fields.payment_method'))
                    ->formatStateUsing(fn($state): string => __('resource.order.payment_method.' . $state))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('payment_status')
                    ->label(__('resource.shared.fields.payment_status'))
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
                    })
                    ->badge()
                    ->sortable(),

                TextColumn::make('currency')
                    ->label(__('resource.shared.fields.currency'))
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'mdl' => 'MDL',
                        'rub' => 'RUB',
                        'usd' => 'USD',
                        'eur' => 'EUR'
                    })
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('shipping_method')
                    ->label(__('resource.shared.fields.shipping_method'))
                    ->formatStateUsing(fn($state) => match ($state) {
                        'fedex' => 'FedEx',
                        'ups' => 'UPS',
                        'dhl' => 'DHL',
                        'usps' => 'USPS',
                        'none' => '',
                    })
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                SelectColumn::make('status')
                    ->label(__('resource.shared.fields.status'))
                    ->options([
                        'new' => __('resource.order.status.new'),
                        'processing' => __('resource.order.status.processing'),
                        'shipped' => __('resource.order.status.shipped'),
                        'delivered' => __('resource.order.status.delivered'),
                        'canceled' => __('resource.order.status.canceled'),
                    ])
                    ->sortable(),

            ])
            ->filters([
                SelectFilter::make('user')
                    ->label(__('resource.shared.fields.user_name'))
                    ->relationship('user', 'name'),

                SelectFilter::make('status')
                    ->label(__('resource.shared.fields.status'))
                    ->options([
                        'new' => __('resource.order.status.new'),
                        'processing' => __('resource.order.status.processing'),
                        'shipped' => __('resource.order.status.shipped'),
                        'delivered' => __('resource.order.status.delivered'),
                        'canceled' => __('resource.order.status.canceled'),
                    ])
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                        ->color('info'),

                    EditAction::make()
                        ->color('success'),

                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AddressRelationManager::class,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|null
    {
        return static::getModel()::count() > 0 ? 'success' : 'danger';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
