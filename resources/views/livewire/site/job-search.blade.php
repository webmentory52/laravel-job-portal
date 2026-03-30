<div>
    <section class="p-6 bg-white rounded mt-8">

        <!-- Heading -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold flex-1">Job Search</h1>
            <div class="filter-controls">
                <div>

                </div>

                <div class="display-mode flex gap-2">
                    <button class="p-2 border rounded bg-gray-200 cursor-pointer">
                        <flux:icon.squares-2x2 />
                    </button>
                    <button class="p-2 border rounded cursor-pointer">
                        <flux:icon.bars-3 />
                    </button>
                </div>
            </div>
        </div>


        <div class="grid grid-cols-12 gap-6">
            <!--Sidebar-->
            <aside class="col-span-12 md:col-span-3 space-y-6">
                <!-- Keyword Search -->
                <div>
                    <label class="col-span-12 md:col-span-3 space-y-6">Keyword</label>
                    <input type="search" placeholder="Search jobs..." class="w-full p-2 px-3 border rounded mt-1" />
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="font-semibold mb-2">Categories</h4>

                    <div class="flex items-center mb-1">
                        <input type="radio" id="all" class="radio" value="" checked />
                        <label for="all" class="select-none ms-2 text-sm font-normal text-heading">All</label>
                    </div>

                    <div class="flex items-center mb-1">
                        <input type="radio" id="all" class="radio" value="" checked />
                        <label for="all" class="select-none ms-2 text-sm font-normal text-heading">Accounting</label>
                    </div>

                    <div class="flex items-center mb-1">
                        <input type="radio" id="all" class="radio" value="" checked />
                        <label for="all" class="select-none ms-2 text-sm font-normal text-heading">Human Resources</label>
                    </div>

                    <div class="flex items-center mb-1">
                        <input type="radio" id="all" class="radio" value="" checked />
                        <label for="all" class="select-none ms-2 text-sm font-normal text-heading">Medical</label>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="#" class="text-sm text-blue-500 underline font-semibold text-primary hover:underline">View All</a>
                    </div>
                </div>

                <!-- Job Types -->
                <div>
                    <h4 class="font-semibold mb-2">Job Type</h4>

                    <div class="flex items-center mb-1">
                        <input type="radio" id="all" class="radio" value="" checked />
                        <label for="all" class="select-none ms-2 text-sm font-normal text-heading">All</label>
                    </div>

                    <div class="flex items-center mb-1">
                        <input type="radio" id="all" class="radio" value="" />
                        <label for="all" class="select-none ms-2 text-sm font-normal text-heading">Full Time</label>
                    </div>

                    <div class="flex items-center mb-1">
                        <input type="radio" id="all" class="radio" value="" />
                        <label for="all" class="select-none ms-2 text-sm font-normal text-heading">Part Time</label>
                    </div>
                </div>

                <!-- Work Place -->
                <div>
                    <h4 class="font-semibold mb-2">Work Place</h4>

                    <div class="flex items-center mb-1">
                        <input type="radio" id="all" class="radio" value="" checked />
                        <label for="all" class="select-none ms-2 text-sm font-normal text-heading">All</label>
                    </div>

                    <div class="flex items-center mb-1">
                        <input type="radio" id="all" class="radio" value="" />
                        <label for="all" class="select-none ms-2 text-sm font-normal text-heading">Onsite</label>
                    </div>

                    <div class="flex items-center mb-1">
                        <input type="radio" id="all" class="radio" value="" />
                        <label for="all" class="select-none ms-2 text-sm font-normal text-heading">Remote</label>
                    </div>
                </div>
            </aside>

            <!-- Job Listings -->
            <div class="col-span-12 md:col-span-9">

                @if($candidateJobs->count() > 0)
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($candidateJobs as $job)
                            <x-job-templates.job-card :job="$job" wire:key="{{$job->id}}" />
                        @endforeach
                    </div>
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
