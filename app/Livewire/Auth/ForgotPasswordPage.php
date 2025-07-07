<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPasswordPage extends Component
{

    public $email;

    protected function rules()
    {
        return [
            'email' => 'required|email|max:255|exists:users,email',
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules());
    }

    public function save()
    {
        $this->validate($this->rules());

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('success', __('forgot_password.flash.text'));
            $this->email = '';
        }

        return;
    }


    public function render()
    {
        return view('livewire.auth.forgot_password_page')
            ->title(__('forgot_password.page_title') . config('app.name'));
    }
}
