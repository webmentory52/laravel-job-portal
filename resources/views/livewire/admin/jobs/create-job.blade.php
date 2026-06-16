<div class="container px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="mx-auto ">
        <div class="text-center">
            <h2 class="text-xl text-gray-800 font-bold sm:text-3xl dark:text-white">
                {{ isset($form->job) ? 'Edit Job' : 'Create Job' }}
            </h2>
        </div>

        <!-- Card -->
        <div class="mt-5 p-4 relative z-10 bg-white border border-gray-200 rounded-xl sm:mt-10 md:p-10 ">
            <form wire:submit.prevent="submit" method="post">

                @include('livewire.shared.job-form-fields', ['form' => $form])

                <div class="mt-6 grid">
                    <button type="submit" wire:loading.attr="disabled" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        {{isset($form->job) ? 'Update' : 'Submit'}}

                        <svg wire:loading.delay.long class="ml-3  size-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    </button>
                </div>
            </form>
        </div>
        <!-- End Card -->
    </div>
</div>
