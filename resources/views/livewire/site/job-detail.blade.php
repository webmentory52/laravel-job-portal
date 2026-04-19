<div class="container">

    @if($job->isExpired())
        <div class="p-3 bg-red-100 text-red-700 rounded-md mb-5 flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            <span class="text-sm">Sorry, This job is no longer available</span>
        </div>
    @endif

    <div class="mx-auto py-16 px-6">

        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6 mb-10">
            <div class="flex items-start gap-4">
                <!-- Company Logo -->
                @if($job->company?->logo ?? false)
                    <img src="{{ $job->company->logo_url }}" alt="{{ $job->company->company_name  }}" onerror="this.src='{{ asset('assets/images/logo-dummy.png') }}'" class="w-16 h-16 rounded-full object-cover border shadow-sm" />
                @else
                    <img src="{{ asset('assets/images/logo-dummy.png') }}" class="w-16 h-16 rounded-full object-cover border shadow-sm" alt="{{ $job->company->company_name  }}" />
                @endif

                <div class="flex flex-col gap-1">
                    <h1 class="font-bold text-3xl text-gray-900 leading-tight">
                        {{$job->title}}
                    </h1>
                    <p class="text-gray-600 text-sm">
                        {{$job->company->company_name ?? 'Unknown Company'}}
                        <span class="text-gray-400">-</span>
                        {{$job->location}}
                    </p>
                    <p class="text-xs text-gray-500 mt-2">
                        Published:
                        <span class="font-medium text-gray-600">{{$job->created_at->diffForHumans()}}</span>
                    </p>

                    <div class="flex mt-2 gap-1">
                        @if($job->jobType)
                            <div class="tag">{{$job->jobType->name}}</div>
                        @endif

                        @if($job->workPlace)
                            <div class="tag">{{$job->workPlace->name}}</div>
                        @endif
                    </div>

                </div>

            </div>

            <div class="flex flex-col text-right">
                <span class="text-gray-400 text-xs tracking-wide">Salary</span>
                <span class="font-normal text-sm text-gray-800">{{$job->salary ?: '-'}}</span>
            </div>

        </div>

        <!-- Job Description -->
        <div class="prose job-description">
            @foreach($job->description as $description)
                <div class="mb-7">
                    <h2 class="font-semibold text-[17px] mb-2">{{$description['title']}}</h2>
                    <div class="text-gray-700">
                        {!! nl2br($description['content']) !!}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Apply To Job Form -->
        @if($job->isApproved())
            <h2 class="text-xl font-semibold mb-5 mt-[4rem]">Apply Now</h2>

            @auth
                <livewire:site.job-apply-form :job="$job" />
            @else
                <p><a href="{{url('/login')}}" wire:navigate class="underline text-blue-500">Sign in to submit application.</a></p>
            @endauth
        @else
            <div class="text-red-400 text-sm mt-10 flex gap-2">

              <flux:icon.exclamation-circle class="size-5" />

              <span>You can't apply to this job at this moment.</span>
            </div>
        @endif

    </div>
</div>
