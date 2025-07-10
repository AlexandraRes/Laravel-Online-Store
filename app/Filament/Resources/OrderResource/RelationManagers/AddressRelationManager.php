<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

     public static function getModelLabel(): string
    {
        return __('resource.address.title.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resource.address.title.plural');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('first_name')
                    ->label(__('resource.shared.fields.first_name'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('last_name')
                    ->label(__('resource.shared.fields.last_name'))
                    ->required()
                    ->maxLength(255),

                Textarea::make('street_address')
                    ->label(__('resource.shared.sections.address'))
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('phone')
                    ->label(__('resource.shared.fields.phone'))
                    ->required()
                    ->tel()
                    ->maxLength(20)
                    ->columnSpanFull(),

                Grid::make(3)->schema([
                    TextInput::make('city')
                        ->label(__('resource.shared.fields.city'))
                        ->required()
                        ->maxLength(255),

                    TextInput::make('state')
                        ->label(__('resource.shared.fields.state'))
                        ->required()
                        ->maxLength(255),

                    TextInput::make('zip_code')
                        ->label(__('resource.shared.fields.zip_code'))
                        ->required()
                        ->numeric()
                        ->maxLength(10),
                ])->columnSpanFull(),

            ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('resource.shared.sections.address'))
            ->recordTitleAttribute('street_address')
            ->columns([

                TextColumn::make('fullname')
                    ->label(__('resource.shared.fields.full_name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('first_name')
                    ->label(__('resource.shared.fields.first_name'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('last_name')
                    ->label(__('resource.shared.fields.last_name'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('phone')
                    ->label(__('resource.shared.fields.phone'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('city')
                    ->label(__('resource.shared.fields.city'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('state')
                    ->label(__('resource.shared.fields.state'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('zip_code')
                    ->label(__('resource.shared.fields.zip_code'))
                    ->searchable()
                    ->sortable()
                    ->numeric(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label(__('resource.shared.fields.edit'))
                    ->color('success'),
                Tables\Actions\DeleteAction::make()
                    ->label(__('resource.shared.fields.delete')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
