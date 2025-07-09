<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\OrdersRelationManager;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return __('resource.user.title.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resource.user.title.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('resource.shared.fields.name'))
                    ->required(),

                TextInput::make('email')
                    ->label(__('resource.shared.fields.email'))
                    ->required()
                    ->email()
                    ->maxLength(255)
                    ->unique(User::class, 'email', ignoreRecord: true),

                DateTimePicker::make('email_verified_at')
                    ->label(__('resource.shared.fields.email_verified_at'))
                    ->default(now()),

                TextInput::make('password')
                    ->label(__('resource.shared.fields.password'))
                    ->password()
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('resource.shared.fields.name'))
                    ->searchable(),

                TextColumn::make('email')
                    ->label(__('resource.shared.fields.email'))
                    ->searchable(),

                TextColumn::make('email_verified_at')
                    ->label(__('resource.shared.fields.email_verified_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label(__('resource.shared.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                        ->label(__('resource.shared.fields.view')),
                    EditAction::make()
                        ->label(__('resource.shared.fields.edit')),
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
            OrdersRelationManager::class,
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
