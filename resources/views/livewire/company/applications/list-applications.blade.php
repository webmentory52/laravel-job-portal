<div class="mt-8 p-6">
    <h1 class="text-2xl font-bold mb-6">Job Applications</h1>

    <flux:table :paginate="$applications">
        <flux:table.columns>
            <flux:table.column>#</flux:table.column>
            <flux:table.column>User</flux:table.column>
            <flux:table.column>Email</flux:table.column>
            <flux:table.column>Phone</flux:table.column>
            <flux:table.column>Job Applied</flux:table.column>
            <flux:table.column>Date</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column align="center">
                Actions
            </flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @forelse($applications as $application)
                <flux:table.row wire:key="{{$application->id}}" class="@if($application->isPending()) bg-yellow-50 @endif">
                    <flux:table.cell>
                        {{$application->id}}
                    </flux:table.cell>
                    <flux:table.cell>
                        {{$application->user->name}}
                    </flux:table.cell>
                    <flux:table.cell>
                        {{$application->user->email}}
                    </flux:table.cell>
                    <flux:table.cell>
                        {{$application->phone}}
                    </flux:table.cell>
                    <flux:table.cell>
                        <a href="{{route('job-detail', $application->candidateJob)}}" class="text-blue-600">
                            {{ucfirst($application->candidateJob->title)}}
                        </a>
                    </flux:table.cell>
                    <flux:table.cell>
                        {{$application->created_at->diffForHumans()}}
                    </flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">
                        @if(View::exists('components.application-status.application-'.$application->status))
                            <x-dynamic-component :component="'application-status.application-' . $application->status" />
                        @endif
                    </flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap ">
                        <a href="#" class="text-blue-600 text-sm mx-2">View</a>

                        @if($application->isPending())
                            <button wire:click.prevent="approve({{$application->id}})" class="px-3 py-1.5 text-white bg-green-500 rounded-lg text-xs cursor-pointer hover:bg-green-700">
                                Approve
                            </button>

                            <flux:modal.trigger name="reject-application">
                                <button wire:click.prevent="setRejectedId({{$application->id}})" class="px-3 py-1.5 text-white bg-red-500 rounded-lg text-xs cursor-pointer hover:bg-red-700">
                                    Reject
                                </button>
                            </flux:modal.trigger>
                        @endif
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <div class="text-center text-gray-500 text-sm">
                        No job applications.
                    </div>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    <flux:modal name="reject-application" class="md:w-96">
        <div class="space-y-6">
            <h2 class="text-lg font-semibold">
                Reject Application
            </h2>
            <p class="text-sm text-gray-600">
                Please provide a reason for rejection. This will be sent to the applicant.
            </p>

            <textarea
                wire:model.live.blur.defer="rejection_reason"
                rows="5"
                class="w-full border rounded-md p-2"
                placeholder="Explain why the applicant was rejected..."
            ></textarea>

            @error('rejection_reason')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror

            <div class="flex">
                <flux:spacer />
                <div class="flex justify-end gap-2">
                    <button x-on:click="$flux.modal('reject-application').close()" class="btn-secondary">
                        Cancel
                    </button>
                    <button wire:click="reject" class="px-3 py-1 rounded-md bg-red-600 text-white hover:bg-red-700 cursor-pointer">
                        Reject
                    </button>
                </div>
            </div>
        </div>
    </flux:modal>
</div>
