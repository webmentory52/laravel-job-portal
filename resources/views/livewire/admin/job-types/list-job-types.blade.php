<div class="p-6 bg-white rounded-xl shadow-sm">
    <h2 class="text-2xl font-semibold mb-4">Job Types</h2>

    <form wire:submit.prevent="save" class="mb-6 flex flex-col gap-3">
        <div class="flex gap-3">
            <input wire:model="jobTypeName" type="text" placeholder="Job type name"
                   class="input" />
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">
                {{ $editJobType ? 'Update' : 'Add' }}
            </button>
        </div>
        @error('jobTypeName') <span class="text-red-500">{{ $message }}</span> @enderror

    </form>

    <table class="min-w-full divide-y divide-gray-200">
        <thead>
        <tr class="bg-gray-50 text-left text-sm font-medium text-gray-500">
            <th class="px-4 py-2">#</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
        @foreach($jobTypes as $jobType)
            <tr wire:key="{{$jobType->id}}">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $jobType->name }}</td>
                <td class="px-4 py-2">
                    <button wire:click="edit({{ $jobType->id }})" class="text-blue-600 hover:underline">Edit</button>
                    <button wire:click="delete({{ $jobType->id }})" wire:confirm="Are you sure you want to delete this item?" class="text-red-600 hover:underline ml-2">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
