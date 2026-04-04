<div class="bg-white border rounded-lg p-4 flex gap-4">
    <img src="{{ $job?->company?->logo_url}}" alt="{{ $job?->company?->company_name }} logo" onerror="this.src='{{ asset('assets/images/logo-dummy.png') }}'" class="w-12 h-12 rounded object-cover">
    <div class="flex-1">
        <h3 class="font-semibold">
            <a href="{{ route('job-detail', [$job->id, \Str::slug($job->title)]) }}">
                {{ $job->title }}
            </a>
        </h3>
        <p class="text-sm text-gray-500">{{ $job?->company?->company_name }} — {{ $job->location }}</p>
    </div>
    <a href="{{ route('job-detail', [$job->id, \Str::slug($job->title)]) }}" class="text-blue-600 flex gap-2 items-center">
        View
        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8h10m0 0L9 4m4 4-4 4"/></svg>
    </a>
</div>
