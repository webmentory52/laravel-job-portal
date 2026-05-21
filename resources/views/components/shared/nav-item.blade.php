@if($item['children'] ?? false)
    <flux:dropdown>
        <flux:navbar.item icon:trailing="chevron-down" :badge="isset($item['badge']) && $item['badge'] ? $item['badge'] > 0 : ''" badge:color="red">{{$item['name']}}</flux:navbar.item>

        <flux:navmenu>
            @foreach($item['children'] as $subitem)
                @if(!isset($subitem['show_only']) || (isset($subitem['show_only']) && $subitem['show_only']))
                    <x-shared.nav-item wire:key="{{'subitem-'.$loop->iteration}}" :item="$subitem" />
                @endif
            @endforeach
        </flux:navmenu>
    </flux:dropdown>
@else
    <flux:navbar.item :href="$item['url'] ?? ''" wire:navigate :icon="$item['icon'] ?? ''" class="data-current:after:h-[0px]!" :badge="isset($item['badge']) && $item['badge'] ? $item['badge'] > 0 : ''" badge:color="red">{{$item['name']}}</flux:navbar.item>
@endif
