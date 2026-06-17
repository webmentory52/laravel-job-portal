<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class HeaderNotifications extends Component
{
    public $notifications = [];

    public $unreadCount = 0;

    public function mount()
    {
        $this->notifications = auth()->user()->unreadNotifications()->take(10)->get();
        $this->unreadCount = auth()->user()->unreadNotifications()->count();
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);

        $notification?->markAsRead();

        if($notification->data['click_url'] ?? false) {
             return redirect()->to($notification->data['click_url']);
        }

        $this->mount();
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        $this->mount();
    }

    public function render()
    {
        return view('livewire.admin.header-notifications');
    }
}
