<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class LoginPage extends Component
{
    public $email;
    public $password;

    protected function rules()
    {
        return [
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:6|max:255',
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules());
    }

    public function save()
    {
        $this->validate($this->rules());

        if (!auth()->attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->flash('error', __('login.form.flash'));
            $this->password = "";
            return;
        }

        return redirect()->intended();

    }

    public function render()
    {
        return view('livewire.auth.login_page')
            ->title(__('login.page_title') . config('app.name'));
    }
}
