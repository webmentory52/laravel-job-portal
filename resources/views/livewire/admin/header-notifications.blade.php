<div class="relative" x-data="{ open: false }">

    <button class="relative" @click="open = !open">
        <flux:icon name="bell" class="size-6" />

        @if($unreadCount > 0)
            <span
                class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 py-0.5 rounded-full">
               {{$unreadCount}}
             </span>
         @endif
    </button>

    <!--Dropdown-->
    <div x-show="open" @click.outside="open=false" x-transition class="absolute right-0 mt-2 w-72 bg-white border rounded-lg shadow-lg z-30">
        <div class="font-semibold border-b p-3">
            Notifications
        </div>

        @forelse($notifications as $index => $notification)

            <button
                wire:key="{{$index}}"
                wire:click="markAsRead('{{$notification->id}}')"
                class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700"
            >
                <div class="font-semibold text-sm">
                    {{$notification->data['notify_title'] ?? 'Untitled Notification'}}
                </div>
                <div class="text-sm">
                    {{$notification->data['notify_message'] ?? ''}}
                </div>
                <div class="text-xs text-gray-500">
                    {{$notification->created_at->diffForHumans()}}
                </div>
            </button>

        @empty

            <p class="px-3 py-4 text-center text-sm text-gray-500">No new notifications</p>

        @endforelse

        @if($unreadCount > 0)
            <button
                   wire:click.prevent="markAllAsRead"
                    class="w-full px-3 py-2 text-center text-sm text-blue-600 hover:bg-gray-100">
                Mark all as read
            </button>
        @endif
    </div>
</div>
