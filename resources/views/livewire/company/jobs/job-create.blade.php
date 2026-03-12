<div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="max-w-xl mx-auto">
        <div class="text-center">
            <h1 class="font-bold text-3xl text-gray-800 sm:text-4xl">
                Post a New Job
            </h1>
        </div>

        <div class="mt-12">

            <x-auth-session-status :status="session('success')" />

            <!-- Form -->
            <form method="post" wire:submit.prevent="submit">
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
                    <flux:select wire:model.live="form.category_id" placeholder="Choose category...">
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
                    <flux:select placeholder="Choose job type..." wire:model.live="form.job_type_id">
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
                    <flux:select wire:model.live="form.work_place_id" placeholder="Choose work place...">
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

                <div class="mb-4 sm:mb-8">
                    <label for="description" class="block mb-2 text-sm font-medium text-foreground">Job Descriptions</label>
                    <textarea id="description" name="description" wire:model.live.blur="form.description" class="input"></textarea>
                    @error('form.description')
                    <div class="text-red-500 text-sm">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="flex mt-3">
                    <div class="flex">
                        <input type="checkbox" id="agreement_accepted" name="agreement_accepted" wire:model.defer.blur="form.agreement_accepted" value="1" class="shrink-0 mt-1.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500" />
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

                <div class="mt-6 grid">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        Submit

                        <svg wire:loading.delay.long class="ml-3  -ml-1 size-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
