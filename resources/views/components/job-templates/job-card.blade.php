<!-- Job Card -->
<div class="flex flex-col h-full border rounded-xl p-3 bg-white shadow-sm hover:shadow-md">
    <div class="flex items-center gap-3 mb-3 justify-between">
        <div class="flex items-center gap-3">
            @if($job->company?->logo ?? false)
                <img src="{{ $job->company->logo_url }}" alt="{{ $job->company->company_name  }}" onerror="this.src='{{ asset('assets/images/logo-dummy.png') }}'" class="w-12 h-12 rounded-full object-cover" />
            @else
                <img src="{{ asset('assets/images/logo-dummy.png') }}" class="w-12 h-12 rounded-full object-cover" alt="{{ $job->company->company_name  }}" />
            @endif
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="font-semibold text-lg text-gray-800 group-hover:text-blue-600">
                        <a href="{{ route('job-detail', [$job->id, \Illuminate\Support\Str::slug($job->title)]) }}">
                            {{$job->title}}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-500">{{$job->company->company_name}} - {{$job->location}}</p>
                </div>
            </div>
        </div>
        <button
            type="button"
            @click="$store.jobs.toggleSave({{$job->id}})"
            :class="$store.jobs.isSaved({{$job->id}}) && 'text-yellow-400'"
            class="ml-2 cursor-pointer hover:text-yellow-500 transition" title="Save Job">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M5.05 4.05a7 7 0 1 1 9.9 9.9l-4.95 4.95-4.95-4.95a7 7 0 0 1 0-9.9z"/></svg>
        </button>
    </div>

    <div class="mt-auto text-end">
        <a href="{{ route('job-detail', [$job->id, \Illuminate\Support\Str::slug($job->title)]) }}" class="cursor-pointer inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:underline">
            View Details
            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8h10m0 0L9 4m4 4-4 4"/></svg>
        </a>
    </div>

</div>
