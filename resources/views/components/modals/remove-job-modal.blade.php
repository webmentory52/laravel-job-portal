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
