<div class="grid gap-4 lg:gap-6">
    <div class="mb-4 sm:mb-8">
        <label for="title" class="block mb-2 text-sm font-medium text-foreground">Job Title</label>
        <input type="text" id="title" name="title" wire:model.live.blur="form.title" class="input" placeholder="Job Title">
        @error('form.title')
        <div class="text-red-500 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="mb-4 sm:mb-8">
        <label for="category" class="block mb-2 text-sm font-medium text-foreground">Job Category</label>
        <flux:select wire:model.live.blur="form.category_id" placeholder="Choose category...">
            @foreach(\App\Models\Category::all() as $category)
                <flux:select.option value="{{$category->id}}" wire:key="{{$category->id}}">{{$category->name}}</flux:select.option>
            @endforeach
        </flux:select>
        @error('form.category_id')
        <div class="text-red-500 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>

    @if(auth()->user()->isAdmin())
        <livewire:shared.autocomplete label="Company" :list="$companies" key="autocomplete-key" />
        @error('form.company_id')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
    @endif

    <div class="mb-4 sm:mb-8">
        <label for="location" class="block mb-2 text-sm font-medium text-foreground">Job Location</label>
        <input type="text" id="location" name="location" wire:model.live.blur="form.location" class="input" placeholder="Job Location">
        @error('form.location')
        <div class="text-red-500 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="mb-4 sm:mb-8">
        <label for="salary" class="block mb-2 text-sm font-medium text-foreground">Job Salary</label>
        <input type="text" id="salary" name="salary" wire:model.live.blur="form.salary" class="input" placeholder="Job Salary">
    </div>

    <div class="mb-4 sm:mb-8">
        <label for="job_type_id" class="block mb-2 text-sm font-medium text-foreground">Job Type</label>
        <flux:select placeholder="Choose job type..." wire:model.live.blur="form.job_type_id">
            @foreach(\App\Models\JobType::all() as $jobType)
                <flux:select.option value="{{$jobType->id}}" wire:key="{{$jobType->id}}">{{$jobType->name}}</flux:select.option>
            @endforeach
        </flux:select>
        @error('form.job_type_id')
        <div class="text-red-500 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="mb-4 sm:mb-8">
        <label for="work_place_id" class="block mb-2 text-sm font-medium text-foreground">Work Place</label>
        <flux:select wire:model.live.blur="form.work_place_id" placeholder="Choose work place...">
            @foreach(\App\Models\WorkPlace::all() as $workPlace)
                <flux:select.option value="{{$workPlace->id}}" wire:key="{{$workPlace->id}}">{{$workPlace->name}}</flux:select.option>
            @endforeach
        </flux:select>
        @error('form.work_place_id')
        <div class="text-red-500 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="mb-4 sm:mb-8">
        <label for="expires_at" class="block mb-2 text-sm font-medium text-foreground">Auto Expire Job</label>
        <input type="date" id="expires_at" wire:model.live.blur="form.expires_at" name="expires_at" class="input">
    </div>

    <h2 class="font-semibold text-2xl">Job Descriptions</h2>
    <hr class="mb-3"/>

    @foreach($form->description as $i => $description)
        <div class="mb-4 sm:mb-8" wire:key="job-section-{{ $loop->iteration }}-{{ $description['title'] }}">
            <div class="flex gap-2 items-center" wire:show="form.description[{{$i}}].title_editable == false">
                <label for="description" class="block mb-2 text-sm font-medium text-foreground">{{ $description['title'] ?: 'N/A' }}</label>
                <flux:icon.pencil wire:click="toggleSectionTitleEditable({{$i}})" class="size-4 cursor-pointer" title="Edit Title" />
            </div>

            <div class="flex gap-2 items-center" wire:show="form.description[{{$i}}].title_editable">
                <input
                    type="text"
                    wire:model="form.description.{{ $i }}.title"
                    class="py-1 sm:py-2 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500"
                >

                <div class="flex gap-1">
                    <button type="button" wire:click.prevent="toggleSectionTitleEditable({{$i}})" class="px-2 py-1 text-white bg-gray-600 rounded-md hover:bg-gray-700 text-xs ml-2 cursor-pointer">Save</button>
                </div>
            </div>

            <x-shared.trix wire:model="form.description.{{ $i }}.content" />
            {{--                        <textarea id="description" name="description" wire:model.live.blur="form.description.{{ $i }}.content" class="input"></textarea>--}}

            <div class="text-end">
                <button
                    type="button"
                    wire:click.prevent="removeSection({{$i}})"
                    class="text-red-500 ml-2 text-xl cursor-pointer" title="remove section">
                    ✕
                </button>
            </div>

        </div>
    @endforeach

    <div>
        <button
            type="button"
            wire:click.prevent="addDescriptionSection"
            class="w-full mt-3 px-4 py-2 text-sm bg-gray-100 rounded hover:bg-gray-200">
            + Add description section
        </button>
    </div>

    @error('form.description')
        <div class="text-red-500 text-sm">
            {{$message}}
        </div>
    @enderror

    @if(!auth()->user()->isAdmin())
        <div class="flex mt-3">
            <div class="flex">
                <input type="checkbox" id="agreement_accepted" name="agreement_accepted" wire:model.defer.blur="form.agreement_accepted" value="1" {{$form->agreement_accepted == 1 ? 'checked' : ''}} class="shrink-0 mt-1.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500" />
            </div>
            <div class="ms-3">
                <label for="agreement_accepted" class="text-sm text-gray-600">By submitting this form I have read and acknowledged the terms and conditions</label>
            </div>
        </div>
        @error('form.agreement_accepted')
            <div class="text-red-500 text-sm">
                {{$message}}
            </div>
        @enderror
    @endif
</div>
