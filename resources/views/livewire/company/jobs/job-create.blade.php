<div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="max-w-xl mx-auto">
        <div class="text-center">
            <h1 class="font-bold text-3xl text-gray-800 sm:text-4xl">
                Post a New Job
            </h1>
        </div>

        <div class="mt-12">

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

                <div class="mt-6 grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
