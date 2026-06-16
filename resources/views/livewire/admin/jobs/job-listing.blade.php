<div class="p-6 rounded shadow container">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Job Listings</h1>
        <a href="{{route('admin.jobs.create')}}" wire:navigate class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <flux:icon name="plus" class="size-4 ml-2" />
            Create Job
        </a>
    </div>

    <div class="mb-4">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search jobs..." class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
    </div>

    <!-- Table Jobs -->
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

        <flux:table :paginate="$jobs">
            <flux:table.columns>
                <flux:table.column>
                    <label for="select-all" class="flex">
                        <input type="checkbox" for="select-all" value="all" x-on:change="toggleSelectAll" class="shrink-0 mt-1.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500">
                        <span class="sr-only">Checkbox</span>
                    </label>
                </flux:table.column>
                <flux:table.column>#</flux:table.column>
                <flux:table.column>Title</flux:table.column>
                <flux:table.column>Company</flux:table.column>
                <flux:table.column>Location</flux:table.column>
                <flux:table.column>Category</flux:table.column>
                <flux:table.column>Status</flux:table.column>
                <flux:table.column>Created At</flux:table.column>
                <flux:table.column>Action</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @forelse($jobs as $job)
                    <flux:table.row :key="$job->id">
                        <flux:table.cell>
                            <label for="select-row-{{$job->id}}" class="flex">
                                <input type="checkbox" for="select-row-{{$job->id}}" value="{{$job->id}}" x-model="selected_rows" class="shrink-0 mt-1.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500">
                                <span class="sr-only">Checkbox</span>
                            </label>
                        </flux:table.cell>
                        <flux:table.cell class="text-xs">
                            {{$job->id}}
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">
                            @if($job->isApproved())
                                <a href="{{ route('job-detail', $job) }}" class="text-blue-500 hover:underline">
                                    {{ ucwords($job->title) }}
                                </a>
                            @else
                                {{ ucwords($job->title) }}
                            @endif
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">
                            {{ ucwords($job->company->company_name) }}
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">
                            {{ ucwords($job->location) }}
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">
                            {{ ucwords($job->category->name) }}
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">

                            @if($job->status === \App\Library\Enums\JobStatusEnum::Pending->value)
                                <flux:select size="sm" placeholder="Status..." style="width: 150px"  wire:change="updateStatus({{$job->id}}, $event.target.value)">
                                    @foreach(array_filter(\App\Library\Enums\JobStatusEnum::cases(), fn($c) => $c->value !== 'expired') as $case)
                                         <flux:select.option :value="$case->value" wire:key="$case->value" :selected="$case->value == $job->status">{{$case->name}}</flux:select.option>
                                    @endforeach
                                </flux:select>
                            @else
                                @if(View::exists('components.job-status.job-'.$job->status))
                                    <x-dynamic-component :component="'job-status.job-' . $job->status" />
                                @endif
                            @endif
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">
                            {{ $job->created_at->diffForHumans() }}
                        </flux:table.cell>
                        <flux:table.cell>
                            <div class="flex gap-2">
                                @if($job->isApproved())
                                    <button
                                        wire:click.prevent="openExpireModal({{ $job->id }})"
                                        class="px-3 py-1 text-sm cursor-pointer transition bg-yellow-500 text-white hover:text-black hover:bg-yellow-600 rounded"
                                    >
                                        Expired
                                    </button>
                                @endif

                                <a href="{{route('admin.jobs.create', $job->id)}}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-hidden focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none ">
                                    <flux:icon name="pencil" class="size-4" />
                                </a>

                                <a href="#" wire:click.prevent="showRemoveModal({{$job->id}})" class="text-sm mx-2  decoration-2 transition focus:underline font-medium text-red-600">
                                    <flux:icon name="trash" class="size-4" />
                                </a>
                            </div>
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <div class="text-center text-gray-500 text-sm">
                            No job listings yet.
                        </div>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>
    </div>

    <x-modals.remove-job-modal />
    <x-modals.expire-job-modal />
    <x-modals.job-bulk-actions-modal />
</div>

<script>

    window.addEventListener('alpine:init', () => {
        const all_rows = {{json_encode($jobs->pluck('id'))}};

        Alpine.data('jobTable', () => ({
            all_rows: all_rows,
            selected_rows: [],
            toggleSelectAll(event) {
                if (event.target.checked) {
                    this.selected_rows = [...this.all_rows];
                } else {
                    this.selected_rows = [];
                }
            }

        }));
    })
</script>
