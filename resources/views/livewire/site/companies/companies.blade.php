<div class="mt-8 p-6">
    <h1 class="font-semibold text-2xl mb-8">Companies</h1>

    <div class="grid lg:grid-cols-4 md:grid-cols-3 gap-6">

        @forelse($companies as $company)
            <!-- Company Card -->
            <a href="#" class="border rounded-xl p-6 hover:shadow-lg transition">
                <div class="flex items-center gap-4">

                    <img src="{{\Storage::url($company->logo)}}" alt="{{$company->company_name}} logo" onerror="this.src='{{ asset('assets/images/logo-dummy.png') }}'" class="w-12 h-12 object-cover rounded-full" />

                    <div>
                        <h3 class="text-lg font-semibold">{{$company->company_name}}</h3>
                    </div>
                </div>

                <div class="mt-4 text-sm text-blue-600 font-medium">
                    {{$company->jobs_count}} open jobs
                </div>
            </a>
        @empty
            <div class="text-center text-sm">No companies yet</div>
        @endforelse

    </div>
</div>
