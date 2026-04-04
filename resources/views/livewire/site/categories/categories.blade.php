<div class="p-6 mt-8">
    <h1 class="text-2xl font-semibold mb-8">Categories</h1>

    <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-6">
        @forelse($categories as $category)
            <a href="{{route('categories.detail', [$category->id, $category->slug])}}" class="border rounded-lg p-6 hover:shadow-lg transition bg-white">
                <h3 class="text-lg font-semibold">
                    {{$category->name}}
                </h3>

                <p class="text-gray-500 text-sm mt-2">
                    {{$category->candidate_jobs_count}} jobs
                </p>
            </a>
        @empty
            <div class="text-center text-sm">Not categories found.</div>
        @endforelse
    </div>
</div>
