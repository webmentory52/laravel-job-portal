<div class="container lg:px-4 sm:px-0">
    <div class="mb-5">
        <h2 class="text-xl font-semibold text-gray-800 ">
            Join Requests
        </h2>
    </div>

    <flux:table :paginate="$joinRequests">
        <flux:table.columns class="bg-gray-50">
            <flux:table.column align="center">User</flux:table.column>
            <flux:table.column align="center">Email</flux:table.column>
            <flux:table.column align="center">Date Requested</flux:table.column>
            <flux:table.column align="center">Status</flux:table.column>
            <flux:table.column align="center"></flux:table.column>
        </flux:table.columns>

        <flux:table.rows class="divide-y divide-gray-200">
            @foreach ($joinRequests as $joinRequest)
                <flux:table.row :key="$joinRequest->id" class="@if($joinRequest->isPending())
                            bg-yellow-50
                        @endif">
                    <flux:table.cell align="center">
                        {{ $joinRequest->user->name }}
                    </flux:table.cell>

                    <flux:table.cell align="center">
                        {{ $joinRequest->user->email }}
                    </flux:table.cell>

                    <flux:table.cell align="center">
                        {{ $joinRequest->created_at->diffForHumans() }}
                    </flux:table.cell>

                    <flux:table.cell align="center">
                        <span @class([
                               'px-2 py-1 rounded text-xs font-semibold',
                               'bg-yellow-200 text-yellow-800' => $joinRequest->isPending(),
                               'bg-green-200 text-green-800' => $joinRequest->isAccepted(),
                               'bg-red-200 text-red-800' => $joinRequest->isRejected()
                        ])>
                                {{ ucfirst($joinRequest->status) }}
                            </span>
                    </flux:table.cell>

                    <flux:table.cell align="center" class="whitespace-nowrap">
                        @if($joinRequest->isPending())
                            <button type="button" wire:click="approve({{$joinRequest->id}})" class="btn text-white bg-green-500 px-3 py-1.5 w-auto text-xs hover:bg-green-700 cursor-pointer">
                                Approve
                            </button>

                            <button type="button" wire:click="reject({{$joinRequest->id}})" class="btn text-white bg-red-500  px-3 py-1.5 w-auto text-xs hover:bg-red-700 cursor-pointer">
                                Reject
                            </button>
                        @endif
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>
