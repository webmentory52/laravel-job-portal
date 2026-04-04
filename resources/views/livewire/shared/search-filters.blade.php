<aside class="col-span-12 md:col-span-3 space-y-6">
    <!-- Keyword Search -->
    <div>
        <label class="col-span-12 md:col-span-3 space-y-6">Keyword</label>
        <input type="search" placeholder="Search jobs..." wire:model.live="keyword" class="w-full p-2 px-3 border rounded mt-1" />
    </div>

    <!-- Categories -->
    <div x-data="{load_all: false}">
        <h4 class="font-semibold mb-2">Categories</h4>

        <div class="flex items-center mb-1">
            <input type="radio" id="category_all" name="category" wire:model.live="categoryId" class="radio" value="" />
            <label for="category_all" class="select-none ms-2 text-sm font-normal text-heading">All</label>
        </div>

        @foreach($this->getCategories() as $category)
            <div class="flex items-center mb-1" wire:key="{{$category->id}}">
                <input type="radio" id="cat_{{$category->id}}" name="category" wire:model.live="categoryId" class="radio" value="{{$category->id}}" />
                <label for="cat_{{$category->id}}" class="select-none ms-2 text-sm font-normal text-heading">{{$category->name}} ({{$category->candidate_jobs_count}})</label>
            </div>
        @endforeach

        <div class="mt-3 text-center">
            <a href="#" x-on:click.prevent="load_all = !load_all; $wire.toggleAllCategories()" class="text-sm text-blue-500 underline font-semibold text-primary hover:underline" x-text="load_all ? 'View Less' : 'View All'">View All</a>
        </div>
    </div>

    <!-- Job Types -->
    <div>
        <h4 class="font-semibold mb-2">Job Type</h4>

        <div class="flex items-center mb-1">
            <input type="radio" id="jobtype_all" name="jobtype" wire:model.live="jobTypeId" class="radio" value="" />
            <label for="jobtype_all" class="select-none ms-2 text-sm font-normal text-heading">All</label>
        </div>

        @foreach($this->jobTypes as $jobType)
            <div class="flex items-center mb-1" wire:key="{{$jobType->id}}">
                <input type="radio" id="jobtype_{{$jobType->id}}" name="jobtype" wire:model.live="jobTypeId" class="radio" value="{{ $jobType->id }}" />
                <label for="jobtype_{{$jobType->id}}" class="select-none ms-2 text-sm font-normal text-heading">{{$jobType->name}} ({{$jobType->candidate_jobs_count}})</label>
            </div>
        @endforeach
    </div>

    <!-- Work Place -->
    <div>
        <h4 class="font-semibold mb-2">Work Place</h4>

        <div class="flex items-center mb-1">
            <input type="radio" id="workplace_all" name="workplace" class="radio" wire:model.live="workPlaceId" value="" />
            <label for="workplace_all" class="select-none ms-2 text-sm font-normal text-heading">All</label>
        </div>

        @foreach($this->workPlaces as $workPlace)
            <div class="flex items-center mb-1" wire:key="{{$workPlace->id}}">
                <input type="radio" id="workplace_{{$workPlace->id}}" name="workplace" class="radio" wire:model.live="workPlaceId" value="{{ $workPlace->id }}" />
                <label for="workplace_{{$workPlace->id}}" class="select-none ms-2 text-sm font-normal text-heading">{{$workPlace->name}} ({{$workPlace->candidate_jobs_count}})</label>
            </div>
        @endforeach

    </div>
</aside>
