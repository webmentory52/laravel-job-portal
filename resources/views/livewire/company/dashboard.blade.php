<div class="p-6 rounded shadow">

    <div class="flex">
        <h1 class="font-bold text-2xl mb-6">Welcome, {{ Auth::user()?->getCompany()?->company_name ?? Auth::user()->name }}</h1>
    </div>

    <!-- Statistics -->
    <div class="grid lg:grid-cols-4 sm:grid-cols-2 gap-6 mb-8">

        <!-- Total Jobs Card -->
        <div class="p-4 text-center border rounded bg-blue-50">
            <h2 class="text-2xl font-bold text-blue-700">{{ $totalJobs }}</h2>
            <p class="text-gray-600 text-sm">Total Jobs</p>
        </div>

        <!-- Pending Jobs Card -->
        <div class="p-4 text-center border rounded bg-blue-50">
            <h2 class="text-2xl font-bold text-gray-700">{{ $pendingJobs }}</h2>
            <p class="text-gray-600 text-sm">Pending Jobs</p>
        </div>

        <!-- Approved Jobs Card -->
        <div class="p-4 text-center border rounded bg-green-50">
            <h2 class="text-2xl font-bold text-green-700">{{ $approvedJobs }}</h2>
            <p class="text-gray-600 text-sm">Approved Jobs</p>
        </div>

        <!-- Rejected Jobs Card -->
        <div class="p-4 text-center border rounded bg-red-50">
            <h2 class="text-2xl font-bold text-red-700">{{ $rejectedJobs }}</h2>
            <p class="text-gray-600 text-sm">Rejected Jobs</p>
        </div>
    </div>

    <!-- Recent Jobs -->
    <div class="mt-4">
        <h2 class="font-semibold text-xl mb-4">Recent Jobs</h2>
        <div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-6">
            @forelse($recentJobs as $job)
                <x-job-templates.job-card :job="$job" wire:key="{{$job->id}}" />
            @empty
                <p class="text-gray-500">No Jobs Yet.</p>
            @endforelse
        </div>
    </div>
</div>
