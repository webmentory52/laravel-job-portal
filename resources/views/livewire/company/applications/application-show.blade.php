<div class="py-6 mt-8">

    <!-- Header -->
    <div class="flex justify-between items-center">
        <div >
            <h1 class="font-bold text-2xl">Application Details #{{$application->id}}</h1>
            <p class="text-sm text-gray-500">
                Applied {{$application->created_at->diffForHumans()}}
            </p>
        </div>

        <div class="flex items-center justify-between gap-5">

            <a href="{{route('company.applications')}}"><flux:icon.arrow-left class="inline size-4"/> <span>Back</span></a>

            @if(View::exists('components.application-status.application-'.$application->status))
                <x-dynamic-component :component="'application-status.application-' . $application->status" />
            @endif
        </div>
    </div>

    <!-- Applicant Card -->
    <div class="bg-white border rounded-lg p-6 grid lg:grid-cols-1 md:grid-cols-2 gap-4 mt-8">
        <div>
            <p class="text-sm text-gray-500">Applicant</p>
            <p class="font-semibold">{{$application->user->name}}</p>
            <p class="text-gray-600"><a href="mailto:{{$application->user->email}}">{{$application->user->email}}</a></p>
            <p class="text-gray-600"><a href="tel:{{$application->phone}}">{{$application->phone}}</a></p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Job</p>
            <p class="font-semibold">{{$application->candidateJob->title}}</p>
            <p class="text-gray-600">{{$application->candidateJob->company?->company_name}}</p>
        </div>
    </div>

    <!-- Cover letter -->
    <div class="bg-white border rounded-lg p-6 mt-8">
        <h2 class="mb-2 font-semibold">Cover Letter</h2>
        <div class="max-w-none prose">
            {!! nl2br(e($application->cover_letter)) !!}
        </div>
    </div>

    <!-- Rejection reason -->
    @if($application->rejection_reason)
        <div class="bg-white border rounded-lg p-6 mt-8">
            <h2 class="mb-2 font-semibold">Rejection Reason</h2>
            <div class="max-w-none prose">
                {!! nl2br(e($application->rejection_reason)) !!}
            </div>
        </div>
    @endif

    @if($application->resume)
        <a href="{{route('resumes.show', $application)}}" target="_blank" class="text-blue-600 underline mb-3 block">Download Resume</a>
     @endif

    <!-- Actions -->
    @if($application->isPending())
        <div class="flex gap-3 mt-8">
            <button wire:click.prevent="approve"
                    class="px-4 py-2 rounded-md bg-green-600 text-white hover:bg-green-700 cursor-pointer">
                Approve
            </button>

            <flux:modal.trigger name="reject-application">
                <button class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 cursor-pointer">Reject</button>
            </flux:modal.trigger>
        </div>
    @endif

    <livewire:company.applications.application-reject :$application />
</div>
