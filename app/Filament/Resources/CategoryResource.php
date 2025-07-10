<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Resources\Concerns\Translatable;

class CategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
         return __('resource.shared.navigation.content');
    }

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return __('resource.category.title.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resource.category.title.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(
                    [
                        Grid::make()
                            ->schema([
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
                                    ->unique(Category::class, 'slug', ignoreRecord: true),

                            ]),

                        FileUpload::make('image')
                            ->label(__('resource.shared.fields.image'))
                            ->image()
                            ->directory('categories'),

                        Toggle::make('is_active')
                            ->label(__('resource.shared.fields.is_active'))
                            ->required()
                            ->default(true),
                    ]
                ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('resource.shared.fields.name'))
                    ->searchable(),

                ImageColumn::make('image')
                    ->label(__('resource.shared.fields.image')),

                TextColumn::make('slug')
                    ->label(__('resource.shared.fields.slug'))
                    ->searchable(),

                IconColumn::make('is_active')
                    ->label(__('resource.shared.fields.is_active'))
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label(__('resource.shared.fields.created_at'))
                  ->formatStateUsing(
                        fn($state) => $state
                        ? \Carbon\Carbon::parse($state)->translatedFormat('d F, Y H:i:s')
                        : null
                    )
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('resource.shared.fields.updated_at'))
                  ->formatStateUsing(
                        fn($state) => $state
                        ? \Carbon\Carbon::parse($state)->translatedFormat('d F, Y H:i:s')
                        : null
                    )
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
