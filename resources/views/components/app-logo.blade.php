@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="Job Portal Administration" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <x-app-logo-icon class="size-7 w-10 h-10 object-cover fill-current text-white dark:text-black" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="Job Portal Administration" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <x-app-logo-icon class="size-7 w-10 h-10 object-cover fill-current text-white dark:text-black" />
        </x-slot>
    </flux:brand>
@endif
