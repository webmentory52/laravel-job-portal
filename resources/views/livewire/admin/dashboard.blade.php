<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        <x-statistic-item :count="$totalJobs" label="Total Jobs" icon="briefcase" />
        <x-statistic-item :count="$totalUsers" label="Total Users" icon="users" />
        <x-statistic-item :count="$totalCompany" label="Total Company" icon="building-office" />
        <x-statistic-item :count="$totalJobApplications" label="Total Applications" icon="document-check" />
    </div>

    <!-- Recent Jobs -->
    <div class="mt-5">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl mb-4">Recent Jobs</h2>
            <a href="#" wire:navigate class="underline text-blue-500">View All</a>
        </div>
        <ul class="space-y-3">
            @forelse($recentJobs as $job)
                <!-- Job Item -->
                <li class="border p-3 rounded bg-gray-50 flex justify-between items-center">
                    <div>
                        <p class="font-medium"><a href="{{route('job-detail', $job->id)}}" target="_blank" class="text-blue-600">{{$job->title}}</a></p>
                        <p class="text-sm text-gray-600">{{$job->company->company_name}} - {{$job->location}}</p>
                    </div>
                    @if(View::exists('components.job-status.job-'.$job->status))
                        <x-dynamic-component :component="'job-status.job-' . $job->status" />
                    @endif
                </li>
            @empty
                <p class="text-sm text-gray-700">No job listing added yet.</p>
            @endforelse

        </ul>
    </div>
</div>
