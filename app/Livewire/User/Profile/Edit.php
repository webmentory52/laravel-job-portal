<?php

namespace App\Livewire\User\Profile;

use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.site')]
#[Title('Edit Profile')]
class Edit extends Component
{
    public $name = "";

    public $email = "";

    public $password = "";

    public $password_confirmation = "";

    public $user;


    public function mount()
    {
        $this->user = auth()->user();
        $this->fill($this->user->only(['name', 'email']));
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'password' => 'string|min:6',
            'password_confirmation' => 'string|required_with:password|min:6|same:password',
        ];
    }

    public function submit()
    {
        $this->validate();

        try {
            $payload = $this->only(['name', 'email']);

            if($this->password) {
                $payload['password'] = Hash::make($this->password);
            }

            $this->user->update($payload);

            Toaster::success("User profile updated successfully.");

        } catch (\Throwable) {
            Toaster::error("Error updating user profile.");
        }
    }

    public function render()
    {
        return view('livewire.user.profile.edit');
    }
}
