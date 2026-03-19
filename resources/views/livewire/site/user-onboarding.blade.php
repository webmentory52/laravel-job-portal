<div class="max-w-xl mx-auto mt-20 bg-white p-8 rounded-xl shadow-md">

    <h1 class="text-2xl font-bold text-center mb-6">
        Choose Your Account Type
    </h1>

    <p class="text-center text-gray-600 mb-10">
        How would you like to use the platform?
    </p>

    <div class="space-y-6" x-data="{type: '', mode: ''}">

        <!-- Individual User -->
        <button
            wire:click="becomeIndividual"
            class="onboarding-btn"
            x-bind:class="type === 'user' ? 'bg-gray-100':''"
        >
            <div class="text-start">
                <h3 class="text-lg font-semibold">Individual User</h3>
                <p class="text-sm text-gray-500">Search and apply for jobs.</p>
            </div>
            <svg class="w-6 h-6 text-gray-400 size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
        </button>

        <div>
            <!-- Company -->
            <button
                x-on:click="type ='company';"
                class="onboarding-btn"
                x-bind:class="type === 'company' ? 'bg-gray-100':''"
            >
                <div class="text-start">
                    <h3 class="text-lg font-semibold">Company</h3>
                    <p class="text-sm text-gray-500">Post jobs and manage applications.</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 w-6 h-6 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                </svg>
            </button>

            <!-- Company options -->
            <div x-show="type === 'company'" x-transition x-cloak class="space-y-2">
                <!-- Create Company -->
                <button
                    x-on:click="mode = 'create'"
                    class="w-full text-left px-3 mt-1 py-2 text-sm border rounded-md hover:bg-gray-100 transition cursor-pointer"
                    x-bind:class="mode === 'create' ? 'bg-gray-50':''"
                >
                    ➕ Create a new company
                </button>

                <!-- Join Company -->
                <button
                    x-on:click="mode = 'join'"
                    class="w-full text-left px-3 py-2 text-sm border rounded-md hover:bg-gray-100 transition cursor-pointer"
                    x-bind:class="mode === 'join' ? 'bg-gray-50':''"
                >
                    🔗 Join existing company
                </button>
            </div>

            <div class="mt-6" x-show="type === 'company'">
                <div x-show="mode === 'join'">

                    <h3 class="font-semibold mb-2 text-center">Join company</h3>

                    <livewire:company.join-company />
                </div>

                <div x-show="mode === 'create'">
                     <h3 class="font-semibold mb-2 text-center">Create a new company</h3>
                     <livewire:company.create-company />
                </div>
            </div>
        </div>


    </div>
</div>
