<?php

namespace App\Livewire;

use App\Livewire\Partials\Navbar;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class MyAccount extends Component
{
    public $login;

    public $email;

    protected function rules()
    {
        return [
            'login' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules());
    }

    public function updateData()
    {

        $user = auth()->user();

        $this->validate($this->rules());

        $user->update([
            'name' => $this->login,
            'email' => $this->email,
        ]);

        $this->dispatch('update-user-login', login: $this->login)->to(Navbar::class);

        $this->login = '';
        $this->email = '';

        LivewireAlert::title('Success')
            ->text('Data has been successfully updated!')
            ->success()
            ->show();
    }

    public function render()
    {
        return view(
            'livewire.my_account',
            ['user' => auth()->user()]
        )
        ->title(__('my_account.page_title') . config('app.name'));
    }
}
