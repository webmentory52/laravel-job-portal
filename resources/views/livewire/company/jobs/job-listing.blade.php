<div class="mt-8 p-6">
    <h2 class="text-2xl font-bold mb-6">Company Jobs</h2>

    <div x-data="jobTable">
        <div class="inline-flex gap-x-2 mb-2" x-show="selected_rows.length > 0">
            <div class="flex ">
                <select class="input  px-5 py-3" x-on:change="$dispatch('bulk-action', { action: $event.target.value, ids: selected_rows })">
                    <option value="">Bulk Actions</option>
                    <option value="delete_all">Delete All</option>
                    <option value="expire_all">Set Expired</option>
                </select>
            </div>
            <span class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium bg-white text-red-500 shadow-2xs " >
                <span x-text="`(${selected_rows.length}) Rows Selected`"></span>
            </span>
        </div>

        <flux:table :paginate="$candidateJobs">
            <flux:table.columns>
                <flux:table.column>
                    <label for="select-all" class="flex">
                        <input type="checkbox" for="select-all" value="all" x-on:change="toggleSelectAll" class="shrink-0 mt-1.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500">
                        <span class="sr-only">Checkbox</span>
                    </label>
                </flux:table.column>
                <flux:table.column>#</flux:table.column>
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
                        <flux:table.cell>
                            <label for="select-row-{{$candidateJob->id}}" class="flex">
                                <input type="checkbox" for="select-row-{{$candidateJob->id}}" value="{{$candidateJob->id}}" x-model="selected_rows" class="shrink-0 mt-1.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500">
                                <span class="sr-only">Checkbox</span>
                            </label>
                        </flux:table.cell>
                        <flux:table.cell class="text-xs">
                            {{$candidateJob->id}}
                        </flux:table.cell>
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
                    <flux:table.row>
                        <div class="text-center text-gray-500 text-sm">
                            No job postings yet.
                        </div>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>


        <flux:modal name="bulk-action-modal" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Apply Bulk Action?</flux:heading>
                    <flux:text class="mt-2">
                        <span>There are <span x-text="selected_rows.length"></span> selected rows!</span>
                        Do you want to apply the bulk action?.<br>
                    </flux:text>
                </div>
                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="button" wire:click.prevent="processBulkAction" variant="danger">Yes</flux:button>
                </div>
            </div>
        </flux:modal>
    </div>

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
<script>

    window.addEventListener('alpine:init', () => {
        const all_rows = {{json_encode($candidateJobs->pluck('id'))}};

        Alpine.data('jobTable', () => ({
            all_rows: all_rows,
            selected_rows: [],
            toggleSelectAll(event) {
                console.log(event.target.checked);
                if (event.target.checked) {
                    this.selected_rows = [...this.all_rows];
                } else {
                    this.selected_rows = [];
                }
            }

        }));
    })
</script>
