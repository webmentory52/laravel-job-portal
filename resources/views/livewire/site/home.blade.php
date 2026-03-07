<div>
    <!-- Hero Section -->
    <div class="bg-blue-50 py-20 text-center">
        <h1 class="font-bold text-4xl text-blue-800 mb-4">Find Your Dream Job</h1>
        <p class="text-blue-700 text-lg mb-6">
            Search through hundreds of job listings to find the perfect opportunity.
        </p>
        <div class="max-w-lg mx-auto">
                <input type="text" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Search jobs..." />
        </div>
    </div>

    <!-- Recent Jobs -->
    <div class="p-6 bg-white rounded shadow mt-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-semibold text-2xl">Latest Job Listings</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <x-job-templates.job-card />
            <x-job-templates.job-card />
            <x-job-templates.job-card />
            <x-job-templates.job-card />
            <x-job-templates.job-card />
            <x-job-templates.job-card />

        </div>

    </div>
</div>
