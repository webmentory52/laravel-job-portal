@props(['count', 'label', 'icon'])
<!-- Card -->
<div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
    <div class="p-4 md:p-5 flex justify-between gap-x-3">
        <div>
            <!-- Label -->
            <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                {{$label}}
            </p>
            <div class="mt-1 flex items-center gap-x-2">
                <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                    {{$count}}
                </h3>

            </div>
        </div>
        <div class="shrink-0 flex justify-center items-center size-11 bg-blue-600 text-white rounded-full dark:bg-blue-900 dark:text-blue-200">
            <flux:icon name="{{$icon}}" class="size-6" />
        </div>
    </div>

    <a class="py-3 px-4 md:px-5 inline-flex justify-between items-center text-sm text-gray-600 border-t border-gray-200 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 rounded-b-xl dark:border-neutral-800 dark:text-neutral-400 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#" wire:navigate>
        View
        <flux:icon.eye class="size-6" />
    </a>
</div>
<!-- End Card -->
