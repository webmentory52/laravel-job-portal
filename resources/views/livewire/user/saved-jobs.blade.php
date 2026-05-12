<div class="p-6">
    <h1 class="font-bold text-2xl mb-6">Favorite Jobs</h1>

    <template x-if="$store.jobs.saved.length">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($jobs as $job)
                <div wire:key="{{$job->id}}">
                    <div class="border rounded-xl px-3 py-5 bg-white shadow-sm">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">{{$job->title}}</h3>

                            <button
                                type="button"
                                @click="$store.jobs.toggleSave({{$job->id}}); $wire.loadJobs($store.jobs.saved);"
                                :class="$store.jobs.isSaved({{$job->id}}) && 'text-yellow-400'"
                                class="ml-2 cursor-pointer hover:text-yellow-500 transition" title="Save Job">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M5.05 4.05a7 7 0 1 1 9.9 9.9l-4.95 4.95-4.95-4.95a7 7 0 0 1 0-9.9z"/></svg>
                            </button>
                        </div>

                        <p class="text-sm text-gray-500">{{$job->company->company_name}}</p>
                        <a href="{{route('job-detail', $job->id)}}" class="text-sm text-blue-600 hover:underline">View Details</a>
                    </div>
                </div>
            @endforeach

        </div>
    </template>

    <p x-show="!$store.jobs.saved.length" class="text-gray-500">No saved jobs yet.</p>
</div>

@script
    <script>
        // Load the jobs at the component first loading
        $wire.loadJobs($store.jobs.saved);
    </script>
@endscript
