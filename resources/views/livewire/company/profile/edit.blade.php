<div class="container mx-auto px-4">
    <div class="max-w-xl mx-auto">
        <div class="text-center">
            <h1 class="font-bold text-3xl text-gray-800 sm:text-4xl">
                Edit Company Profile
            </h1>
        </div>

        <div class="mt-12">
            <form method="post" wire:submit.prevent="save" class="space-y-5">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-foreground">Company Name</label>
                    <input type="text" id="company_name" name="company_name" wire:model.live.blur="form.company_name" class="input" placeholder="" />
                    @error('form.company_name')
                        <div class="text-red-500 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-foreground">Website</label>
                    <input type="url" id="website" name="email" wire:model.live.blur="form.website" class="input" placeholder="https://example.com">
                    @error('form.website')
                    <div class="text-red-500 text-sm">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-foreground">Email</label>
                    <input type="email" id="email" name="email" wire:model.live.blur="form.email" class="input" placeholder="">
                    @error('form.email')
                    <div class="text-red-500 text-sm">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div x-data="{desc: $wire.entangle('form.bio'), bio_max_length: $wire.entangle('form.bioMaxLength')}">
                    <label class="block mb-2 text-sm font-medium dark:text-white">Bio</label>
                    <textarea rows="8" name="bio" x-model="desc" @input="if(desc.length > bio_max_length) desc = desc.substring(0, bio_max_length)" class="input border"></textarea>

                    <span class="block mb-2 text-sm text-gray-500 float-end mt-1"><span x-text="desc.length"></span> / <span x-text="bio_max_length"></span> characters</span>

                    @error('form.bio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium dark:text-white" for="company_logo">Company Logo</label>

                    @if ($form->existing_logo)
                        <div class="my-2">
                            <img src="{{ \Storage::url($form->existing_logo) }}" alt="Company Logo" class="h-20 w-20 object-cover rounded-md">
                        </div>
                    @endif

                    <input type="file" id="company_logo" wire:model="form.logo" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
    file:bg-gray-50 file:border-0
    file:me-4
    file:py-3 file:px-4" />

                    @error('form.logo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>


                <div class="mt-6 grid">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        Save Changes

                        <svg wire:loading.delay.long wire:target="save" class="ml-3  -ml-1 size-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
