<div class="container lg:px-4 sm:px-0">
    <div class="shadow p-6 rounded bg-white">
        <h1 class="font-bold text-2xl mb-6">My Applications</h1>

        <!-- Filters -->
        <div class="flex gap-3 mb-6">
            <button wire:click="setFilter('')" class="px-3 py-1 cursor-pointer rounded {{$filter === '' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700'}} ">All</button>
            @foreach(array_column(\App\Library\Enums\JobApplicationStatusEnum::cases(), 'value') as $i => $value)
                <button wire:click="setFilter('{{$value}}')" wire:key="{{$i}}" class="px-3 py-1 cursor-pointer rounded {{$filter === $value ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700'}}">{{ucfirst($value)}}</button>
            @endforeach
        </div>

        @if($applications->count())
        <!--Applications-->
        <div class="grid gap-6">

            @foreach($applications as $application)
                <!-- Application Card -->
                <div wire:key="{{$application->id}}" class="border rounded-lg p-5 bg-gray-50 flex justify-between items-start">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">
                            {{$application->candidateJob->title}}
                        </h2>
                        <p class="text-sm text-gray-500">{{$application->candidateJob?->company?->company_name}} — {{$application->candidateJob->location}}</p>

                        @if($application->cover_letter)
                            <p class="mt-2 text-sm text-gray-600 line-clamp-2">
                               {!! $application->cover_letter !!}
                            </p>
                        @endif

                        <p class="mt-2 text-sm">
                            <span class="font-medium">Status:</span>
                            @if(View::exists('components.application-status.application-'.$application->status))
                                <x-dynamic-component :component="'application-status.application-' . $application->status" />
                            @endif
                        </p>

                        @if($application->resume)
                            <p class="mt-2 text-sm flex gap-2">
                                <span class="font-medium">Resume:</span>
                                <a href="{{route('resumes.show', $application)}}"
                                   title="Download"
                                   target="_blank"
                                   class="text-blue-600 underline">
                                    <flux:icon.arrow-down-tray size="6" />
                                </a>
                            </p>
                         @endif
                    </div>
                    <a href="{{route('job-detail', $application->candidateJob)}}" class="text-blue-600 text-sm hover:underline">
                        View Job
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {!! $applications->links() !!}
        </div>
        @else
            @if($filter)
                <p class="text-gray-500">You have not have any {{$filter }} jobs yet.</p>
            @else
                <p class="text-gray-500">You have not applied to any jobs yet.</p>
            @endif
        @endif
    </div>
</div>
