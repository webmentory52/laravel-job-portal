<div class="mt-8 p-6">
    <h2 class="text-2xl font-bold mb-6">Company Jobs</h2>

    <flux:table :paginate="$candidateJobs">
        <flux:table.columns>
            <flux:table.column>Job</flux:table.column>
            <flux:table.column>Location</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column>Category</flux:table.column>
            <flux:table.column>Salary</flux:table.column>
            <flux:table.column>Date</flux:table.column>
            <flux:table.column></flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse($candidateJobs as $candidateJob)
                <flux:table.row :key="$candidateJob->id">
                    <flux:table.cell class="whitespace-nowrap">
                        @if($candidateJob->isApproved())
                            <a href="{{ route('job-detail', $candidateJob) }}" class="text-blue-500 hover:underline">
                                {{ ucwords($candidateJob->title) }}
                            </a>
                        @else
                            {{ ucwords($candidateJob->title) }}
                        @endif
                    </flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">
                        {{ $candidateJob->location }}
                    </flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">
                        @if(View::exists('components.job-status.job-'.$candidateJob->status))
                            <x-dynamic-component :component="'job-status.job-' . $candidateJob->status" />
                        @endif
                    </flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">
                        {{ $candidateJob->category->name }}
                    </flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">
                        {{ $candidateJob->salary }}
                    </flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">
                        {{ $candidateJob->created_at->format('d M, Y') }}
                    </flux:table.cell>
                    <flux:table.cell>
                        <div class="flex gap-2">
                            @if($candidateJob->isApproved())
                                <button
                                    wire:click.prevent="openExpireModal({{ $candidateJob->id }})"
                                    class="px-3 py-1 text-sm cursor-pointer transition bg-yellow-500 text-white hover:text-black hover:bg-yellow-600 rounded"
                                >
                                    Expired
                                </button>
                            @endif

                            @if(!$candidateJob->isExpired())
                                <a class="text-sm mx-2  decoration-2 hover:underline transition focus:underline font-medium text-blue-600" href="{{route('company.jobs.create', $candidateJob->id)}}">
                                    Edit
                                </a>
                            @endif
                            <a href="#" wire:click.prevent="showRemoveModal({{$candidateJob->id}})" class="text-sm mx-2  decoration-2 hover:underline transition focus:underline font-medium text-red-600">
                                Delete
                            </a>
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @empty

            @endforelse
        </flux:table.rows>
    </flux:table>

    <flux:modal name="expire-job-modal" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Expire Job?</flux:heading>
                <flux:text class="mt-2">
                    You're about to update the job as expired.<br>
                    This action cannot be reversed.
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="button" wire:click.prevent="expireJob" variant="danger">Expire</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="remove-job-modal" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Remove Job?</flux:heading>
                <flux:text class="mt-2">
                    You're about to remove.<br>
                    This action cannot be reversed.
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="button" wire:click.prevent="removeJob" variant="danger">Remove</flux:button>
            </div>
        </div>
    </flux:modal>

</div>
