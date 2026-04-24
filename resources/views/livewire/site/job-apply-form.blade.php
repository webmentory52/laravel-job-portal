<div>
    @if($job->hasUserApplied(auth()->user()->id))
        <div class="bg-green-200 rounded-xl p-3" wire:show="!isSubmitting">You already applied to this job.</div>
    @else
        <form method="post" class="space-y-4" wire:submit.prevent="submit">

            <div class="mb-5">
                <label for="name" class="block text-sm mb-2 font-medium text-gray-900">Your Name</label>
                <input type="text" id="name" name="name" wire:model="name" class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 disabled:cursor-not-allowed disabled:pointer-events-none" disabled />
            </div>

            <div class="mb-5">
                <label for="email" class="block text-sm mb-2 font-medium text-gray-900">Your Email</label>
                <input type="email" id="email" name="email" wire:model="email" class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 disabled:cursor-not-allowed disabled:pointer-events-none" disabled />
            </div>

            <div class="mb-5">
                <label for="phone" class="block text-sm mb-2 font-medium text-gray-900">Phone Number</label>
                <input type="text" id="phone" name="phone" wire:model.live.blur="phone" class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5">
                <label for="cover_letter" class="block text-sm mb-2 font-medium text-gray-900">Cover Letter</label>
                <textarea id="cover_letter" name="cover_letter" wire:model.live.blur="coverLetter" rows="8" class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" ></textarea>
                @error('coverLetter') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class=mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 " id="resume">Resume (PDF or Word)</label>

                <input type="file" name="resume" id="resume" wire:model.live.blur="resume" accept=".pdf, .doc, .docx, application/pdf, application/msword" class="input block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500
        file:bg-gray-50 file:border-0
        file:me-4
        file:py-3 file:px-4
       ">
                <p class="text-xs mt-2 text-gray-600">Max file size: 3MB</p>

                @error('resume') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary" wire:loading.class="opacity-50" wire:loading.attr="disabled">
                Apply
            </button>
            <div wire:loading.delay wire:target="submit">
                Submitting application...
            </div>

        </form>
    @endif
</div>
