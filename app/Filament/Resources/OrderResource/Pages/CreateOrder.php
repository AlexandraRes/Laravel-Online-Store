<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;


    public function mount(): void
    {
        parent::mount();

        if (request()->has('user_id')) {
            $this->form->fill([
                'user_id' => request()->get('user_id'),
            ]);
        }
    }

    protected function getRedirectUrl(): string
{
    return session()->pull('orders.return_url', static::$resource::getUrl());
}

}
