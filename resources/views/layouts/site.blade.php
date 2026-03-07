<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-neutral-100 antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">

<header class="w-full text-sm mb-6 lg:px-6 sm:px-1 flex justify-between pt-2">
    <div class="flex justify-between items-center gap-x-1">
        <a href="{{ route('home') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
            <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
        </a>
    </div>

    <!-- Navigation -->
    <div>
        <nav x-data="{mobile_toggle: true}" x-init="if(document.documentElement.clientWidth <= 650) mobile_toggle = false;" class="flex flex-1 items-center justify-center md:justify-between">

            <div class="flex justify-between items-center gap-x-1">
                <!-- Collapse Button -->
                <button type="button" x-on:click="mobile_toggle = !mobile_toggle" class="hs-collapse-toggle md:hidden relative size-9 flex justify-center items-center font-medium text-sm rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-neutral-700 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" id="hs-header-base-collapse"  aria-expanded="false" aria-controls="hs-header-base" aria-label="Toggle navigation"  data-hs-collapse="#hs-header-base" >
                    <svg x-show="!mobile_toggle" class="hs-collapse-open:hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
                    <svg x-show="mobile_toggle" class="hs-collapse-open:block shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    <span class="sr-only">Toggle navigation</span>
                </button>
                <!-- End Collapse Button -->
            </div>

            <div x-show="mobile_toggle" id="hs-header-base" class="hs-collapse md:overflow-visible overflow-hidden transition-all duration-300 basis-full grow md:block" aria-labelledby="hs-header-base-collapse">
                <div class="md:overflow-visible overflow-hidden max-h-[75hv] ">
                    <div class="py-2 md:py-0 flex flex-col md:flex-row md:items-center gap-0.5 md:gap-1">
                        <div class="flex grow items-center justify-between gap-20">

                            <div class="flex flex-col md:flex-row md:justify-end md:items-center gap-4 md:gap-5">
                                <a href="#" class="inline-block px-2 py-1.5 text-[#1b1b18] border border-transparent text-sm rounded-sm leading-normal">Find Jobs</a>
                                <a href="#" class="inline-block px-2 py-1.5 text-[#1b1b18] border border-transparent text-sm rounded-sm leading-normal">Categories</a>
                                <a href="#" class="inline-block px-2 py-1.5 text-[#1b1b18] border border-transparent text-sm rounded-sm leading-normal">Companies</a>
                                <a href="{{ route('company.jobs.create') }}" wire:navigate class="py-[7px] px-2.5 inline-flex font-medium text-sm rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-100">Post Job</a>
                            </div>

                            <div class="flex flex-col md:flex-row md:justify-end md:items-center gap-0.5 md:gap-1">

                                <a
                                    href="{{ route('login') }}"
                                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                                >
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                        Register
                                    </a>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<div class="w-full flex-1">
    <main class="max-w-6xl mx-auto px-4 py-8">
        {{ $slot }}
    </main>
</div>

@fluxScripts
</body>
</html>
