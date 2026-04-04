<div>
    <section class="p-6 bg-white rounded mt-8">

        <!-- Heading -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold flex-1">Job Search</h1>
            <div class="filter-controls flex flex-3 justify-between items-center gap-2 ">
                <div>
                    @foreach($this->selectedFilters as $type => $filter)
                        <x-shared.tag wire:key="{{$loop->iteration}}" :name="$filter['name']" wire:click="clearFilter('{{$type}}')"  />
                    @endforeach
                </div>

                <div class="display-mode flex gap-2">
                    <button wire:click="$set('viewMode', 'grid')" class="p-2 border rounded {{$viewMode === 'grid' ? 'bg-gray-200' : ''}} cursor-pointer">
                        <flux:icon.squares-2x2 />
                    </button>
                    <button wire:click="$set('viewMode', 'list')" class="p-2 border rounded {{$viewMode === 'list' ? 'bg-gray-200' : ''}} cursor-pointer">
                        <flux:icon.bars-3 />
                    </button>
                </div>
            </div>
        </div>


        <div class="grid grid-cols-12 gap-6">
            <!--Sidebar-->
            <livewire:shared.search-filters :$keyword :$categoryId :$jobTypeId :$workPlaceId  @filter="handleFilter($event.detail)"  />

            <!-- Job Listings -->
            <div class="col-span-12 md:col-span-9">

                @if($candidateJobs->count() > 0)
                    @if($viewMode === 'grid')
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($candidateJobs as $job)
                                <x-job-templates.job-card :job="$job" wire:key="{{$job->id}}" />
                            @endforeach
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($candidateJobs as $job)
                                <x-job-templates.job-card-list :job="$job" wire:key="{{$job->id}}" />
                            @endforeach
                        </div>
                    @endif
                @else
                    <p class="text-center text-gray-500">There is no job listings that match your search criteria</p>
                @endif



                <!-- Pagination -->
                <div class="mt-4">
                    {!! $candidateJobs->links() !!}
                </div>

            </div>
        </div>

    </section>
</div>
