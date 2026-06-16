<div
    x-data="{ open: false }"
    @click.outside="open = false"
    class="relative"
>
    <label class="block mb-2 text-sm font-medium dark:text-white">{{$label}}</label>

    {{-- Search Input --}}
    <input
        type="text"
        x-on:focus="open = true"
        wire:model.live.debounce.150ms="query"
        class="input"
        placeholder="Start typing..."
    >
    {{-- Dropdown --}}
    <div
        x-show="open && $wire.list.length > 0"
        x-transition
        class="absolute left-0 right-0 mt-2 bg-white border rounded-lg shadow-lg z-20 max-h-60 overflow-y-auto"
    >
        @foreach($list as $item)
            <div
                wire:key="item-{{ $item['id'] }}"
                class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
                wire:click="selectItem({{ $item['id'] }})"
                x-on:click="open = false"
            >
                <div class="font-medium">{{ $item['name'] }}</div>
            </div>
        @endforeach
    </div>

    {{-- Clear Button --}}
    @if($selected)
        <button
            wire:click="clearSelection"
            type="button"
            class="text-xs text-red-600 mt-1 hover:underline flex gap-1 items-center"
        >
             <flux:icon name="x-mark" size="2" />

             <span>Clear selection</span>
        </button>
    @endif
</div>
