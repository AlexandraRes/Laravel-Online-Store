<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Resources\Concerns\Translatable;

class ProductResource extends Resource
{
    use Translatable;

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    public static function getNavigationGroup(): ?string
    {
         return __('resource.shared.navigation.content');
    }

    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return __('resource.product.title.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resource.product.title.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Group::make()->schema([
                    Section::make(__('resource.shared.sections.product_information'))->schema([
                        TextInput::make('name')
                            ->label(__('resource.shared.fields.name'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        TextInput::make('slug')
                            ->label(__('resource.shared.fields.slug'))
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->unique(Product::class, 'slug', ignoreRecord: true),

                        MarkdownEditor::make('description')
                            ->label(__('resource.shared.fields.description'))
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('products'),


                    ])->columns(2),
                ])->columnSpan(2),

                Group::make()->schema([
                    Section::make(__('resource.shared.sections.price'))->schema([
                        TextInput::make('price')
                            ->label(__('resource.shared.fields.price'))
                            ->required()
                            ->numeric()
                            ->prefix('MDL'),
                    ]),

                    Section::make(__('resource.shared.sections.associations'))->schema([
                        Select::make('category_id')
                            ->label(__('resource.shared.fields.category'))
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('category', 'name'),

                        Select::make('brand_id')
                            ->label(__('resource.shared.fields.brand'))
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('brand', 'name')
                    ]),

                ])->columnSpan(1)
                    ->extraAttributes(['class' => 'h-full flex']),

                Group::make()->schema([
                    Section::make(__('resource.shared.sections.images'))->schema([
                        FileUpload::make('images')
                            ->label(__('resource.shared.fields.images'))
                            ->multiple()
                            ->directory('products')
                            ->maxFiles(5)
                            ->reorderable(),

                    ])
                ])->columnSpan(2),

                Group::make()->schema([
                    Section::make(__('resource.shared.sections.status'))->schema([
                        Toggle::make('in_stock')
                            ->label(__('resource.shared.fields.in_stock'))
                            ->required()
                            ->default(true),

                        Toggle::make('is_active')
                            ->label(__('resource.shared.fields.is_active'))
                            ->required()
                            ->default(true),

                        Toggle::make('is_featured')
                            ->label(__('resource.shared.fields.is_featured'))
                            ->required(),

                        Toggle::make('on_sale')
                            ->label(__('resource.shared.fields.on_sale'))
                            ->required(),
                    ])

                ])->columnSpan(1),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('resource.shared.fields.name'))
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label(__('resource.shared.fields.category'))
                    ->sortable(),

                TextColumn::make('brand.name')
                    ->label(__('resource.shared.fields.brand'))
                    ->sortable(),

                TextColumn::make('price')
                    ->label(__('resource.shared.fields.price'))
                    ->money('MDL')
                    ->sortable(),

                IconColumn::make('is_featured')
                    ->label(__('resource.shared.fields.is_featured'))
                    ->boolean(),

                IconColumn::make('on_sale')
                    ->label(__('resource.shared.fields.on_sale'))
                    ->boolean(),

                IconColumn::make('in_stock')
                    ->label(__('resource.shared.fields.in_stock'))
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label(__('resource.shared.fields.is_active'))
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label(__('resource.shared.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('resource.shared.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                SelectFilter::make('category')
                    ->relationship('category', 'name'),
                SelectFilter::make('brand')
                    ->relationship('brand', 'name'),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                        ->label(__('resource.shared.fields.view'))
                        ->color('info'),
                    EditAction::make()
                        ->label(__('resource.shared.fields.edit'))
                        ->color('success'),
                    DeleteAction::make()
                        ->label(__('resource.shared.fields.delete')),
                ]),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
