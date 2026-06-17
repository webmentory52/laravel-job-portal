<div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="max-w-xl mx-auto">
        <div class="text-center">
            <h1 class="font-bold text-3xl text-gray-800 sm:text-4xl">
                {{$form->job ? 'Update Job #' . $form->job->id : 'Post a New Job'}}
            </h1>
        </div>

        <div class="mt-12">

            <x-auth-session-status :status="session('success')" />

            <!-- Form -->
            <form method="post" wire:submit.prevent="submit">

                @include('livewire.shared.job-form-fields', ['form' => $form])

                <div class="mt-6 grid">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                       {{$form->job ? 'Update' : 'Submit'}}

                        <svg wire:loading.delay.long class="ml-3 size-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
