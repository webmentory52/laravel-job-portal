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
