<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;


class RegisterPage extends Component
{
    public $name;
    public $email;
    public $password;

    protected function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|max:255',
        ];
    }

    public function updated($property) {
        $this->validateOnly($property, $this->rules());
    }

    public function save()
    {
        $this->validate($this->rules());

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        auth()->login($user);

        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.auth.register_page')
            ->title( __('register.page_title') . config('app.name'));
    }
}
