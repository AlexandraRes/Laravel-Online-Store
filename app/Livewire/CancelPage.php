<?php

namespace App\Livewire;

use Livewire\Component;

class CancelPage extends Component
{
    public function render()
    {
        return view('livewire.cancel_page')
        ->title(__('cancel.page_title') . config('app.name'));
    }
}
