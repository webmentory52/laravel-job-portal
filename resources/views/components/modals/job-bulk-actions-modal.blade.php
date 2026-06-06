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
