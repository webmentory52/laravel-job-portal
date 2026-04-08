<div class="mt-8 p-6">

    <div class="flex items-center gap-6">
        <img src="{{\Storage::url($company->logo)}}" class="w-24 h-24 object-cover rounded-full border" alt="{{$company->company_name}} logo" />

        <div>
            <h1 class="font-bold text-3xl">{{$company->company_name}}</h1>
        </div>
    </div>

    <!-- Bio -->
    @if($company->bio)
        <div class="bg-gray-50 rounded-xl border p-6 mt-5">
            <h2 class="mb-2 font-semibold text-xl">About {{$company->company_name}}</h2>
            <p class="text-gray-700 text-[14px] leading-relaxed">
                {!! nl2br(e($company->bio)) !!}
            </p>
        </div>
    @endif

    <!-- Company Jobs -->
      <div class="mt-15">
         <h3 class="font-semibold mb-6 text-xl">Latest Company Jobs</h3>

          <div class="space-y-4">
             @forelse($jobs as $job)
                <x-job-templates.job-card-list :job="$job" wire:key="{{$job->id}}" />

                 @empty
                  <p class="text-gray-500">No open positions at the moment.</p>

              @endforelse
          </div>
      </div>
</div>
