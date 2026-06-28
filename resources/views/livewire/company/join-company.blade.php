<div>
{{--    <label class="block mb-2 text-sm font-medium dark:text-white">Select company</label>--}}

{{--    <flux:select wire:model="companyId" placeholder="Choose company...">--}}
{{--        @foreach($companies as $company)--}}
{{--            <flux:select.option value="{{$company['id']}}" wire:key="{{$company['id']}}">{{$company['name']}}</flux:select.option>--}}
{{--        @endforeach--}}
{{--    </flux:select>--}}
    <livewire:shared.autocomplete label="Select Company" :list="$companies" key="autocomplete-key" />

    <div class="pt-4 text-center">
        <button type="button" wire:click="join" class="btn btn-primary">
            Join
        </button>
    </div>
</div>
