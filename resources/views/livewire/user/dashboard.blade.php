<div class="p-6 rounded shadow">
    <div class="flex">
        <h1 class="font-bold text-2xl mb-6">Welcome, {{ Auth::user()->name }}</h1>
    </div>

    <div class="grid lg:grid-cols-4 sm:grid-cols-2 gap-6 mb-8">
        <div class="p-4 bg-blue-50 border rounded text-center">
            <h2 class="text-2xl font-bold text-blue-700">{{$totalApplications}}</h2>
            <p class="text-gray-600 text-sm">Total Applications</p>
        </div>
        <div class="p-4 bg-green-50 border rounded text-center">
            <h2 class="text-2xl font-bold text-green-700">{{$acceptedApplications}}</h2>
            <p class="text-gray-600 text-sm">Accepted</p>
        </div>
        <div class="p-4 bg-red-50 border rounded text-center">
            <h2 class="text-2xl font-bold text-red-700">{{$rejectedApplications}}</h2>
            <p class="text-gray-600 text-sm">Rejected</p>
        </div>
        <div class="p-4 bg-yellow-50 border rounded text-center">
            <h2 class="text-2xl font-bold text-yellow-700">{{$pendingApplications}}</h2>
            <p class="text-gray-600 text-sm">Pending</p>
        </div>
    </div>

    <h2 class="text-xl font-semibold mb-4">Recent Applications</h2>
    <ul class="space-y-3">

         @forelse($recentApplications as $application)
             <li wire:key="{{$application->id}}" class="border rounded p-3 bg-gray-50 flex justify-between items-center">
                    <div>
                        <p class="font-medium">{{$application->candidateJob->title}}</p>
                        <p class="text-sm text-gray-500">{{$application->candidateJob->company->company_name}}</p>
                        @if(View::exists('components.application-status.application-' . $application->status))
                            <x-dynamic-component :component="'application-status.application-' . $application->status" />
                        @endif
                    </div>
                    <a href="{{route('job-detail', $application->candidateJob)}}" class="text-blue-600 text-sm hover:underline">
                        View Job
                    </a>
                </li>
        @empty
            <li>
                <p class="text-sm text-gray-700">No applications yet.</p>
            </li>

        @endforelse
    </ul>

    <div class="mt-6">
        <a href="{{ route('applications.my') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            View All Applications
        </a>
    </div>
</div>
