<form class="space-y-5" wire:submit.prevent="submit">
    <div>
        <label class="block mb-2 text-sm font-medium dark:text-white">Company Name</label>
        <input type="text" name="company_name" wire:model.blur="form.company_name" class="input border">
        @error('form.company_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium dark:text-white">Website</label>
        <input type="url" name="website" wire:model.blur="form.website" placeholder="https://example.com" class="input border">
        @error('form.website') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium dark:text-white">Email</label>
        <input type="email" name="email" wire:model.blur="form.email" class="input border" />
        @error('form.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div x-data="{desc: $wire.entangle('form.bio'), bio_max_length: $wire.entangle('form.bioMaxLength')}">
        <label class="block mb-2 text-sm font-medium dark:text-white">Bio</label>
        <textarea rows="8" name="bio" x-model="desc" @input="if(desc.length > bio_max_length) desc = desc.substring(0, bio_max_length)" class="input border"></textarea>

        <span class="block mb-2 text-sm text-gray-500 float-end mt-1"><span x-text="desc.length"></span> / <span x-text="bio_max_length"></span> characters</span>

        @error('form.bio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium dark:text-white" for="company_logo">Company Logo</label>
        <input type="file" id="company_logo" wire:model="form.logo" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
    file:bg-gray-50 file:border-0
    file:me-4
    file:py-3 file:px-4" />

        @error('form.logo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="pt-4 text-center">
        <button type="submit" class="btn btn-primary">
            Create
        </button>
    </div>
</form>
