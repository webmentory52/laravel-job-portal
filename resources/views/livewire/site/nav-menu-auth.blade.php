<div class="flex flex-col md:flex-row md:justify-end md:items-center gap-0.5 md:gap-1">

    <flux:navbar>
        @foreach($navItems as $item)
            @if(!isset($item['show_only']) || (isset($item['show_only']) && $item['show_only']))
                <x-shared.nav-item wire:key="{{'item'.$loop->iteration}}" :item="$item" />
            @endif
        @endforeach
    </flux:navbar>

{{--    <a class="p-2 md:px-3 flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 " href="#" wire:navigate>--}}
{{--        Dashboard--}}
{{--    </a>--}}

    <form method="POST" action="{{ route('logout') }}" class="w-full">
        @csrf
        <button type="submit" class="p-2 md:px-3 items-center text-sm text-gray-800 rounded-lg block hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300">
            {{ __('Log Out') }}
        </button>
    </form>

</div>
