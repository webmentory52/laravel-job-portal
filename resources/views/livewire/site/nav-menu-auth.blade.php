<div class="flex flex-col md:flex-row md:justify-end md:items-center gap-0.5 md:gap-1">

    <a class="p-2 md:px-3 flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 " href="#" wire:navigate>
        Dashboard
    </a>

    <a href="{{route('company.jobs.index')}}" wire:navigate class="p-2 md:px-3 flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 " >
        Company Jobs
    </a>

    @if(auth()->user()->currentUserBelongsToCompany() && auth()->user()->isCurrentUserCompanyAdmin())
        <a class="p-2 md:px-3 flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 {{ request()->routeIs('company.join-requests') ? 'bg-gray-200' : '' }}" href="{{ route('company.join-requests') }}" wire:navigate>
            Join Requests @if($pendingJoinRequestsCount) <span class="bg-red-600 text-white text-xs rounded-[50%] px-2">{{$pendingJoinRequestsCount}}</span>  @endif
        </a>
    @endif

    <form method="POST" action="{{ route('logout') }}" class="w-full">
        @csrf
        <button type="submit" class="p-2 md:px-3 items-center text-sm text-gray-800 rounded-lg block hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300">
            {{ __('Log Out') }}
        </button>
    </form>

</div>
