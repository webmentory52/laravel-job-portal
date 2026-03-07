<div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="max-w-xl mx-auto">
        <div class="text-center">
            <h1 class="font-bold text-3xl text-gray-800 sm:text-4xl">
                Post a New Job
            </h1>
        </div>

        <div class="mt-12">

            <!-- Form -->
            <form method="post">
                <div class="mb-4 sm:mb-8">
                    <label for="title" class="block mb-2 text-sm font-medium text-foreground">Job Title</label>
                    <input type="text" id="title" name="title" class="input" placeholder="Job Title">
                </div>

                <div class="mb-4 sm:mb-8">
                    <label for="category" class="block mb-2 text-sm font-medium text-foreground">Job Category</label>
                    <flux:select placeholder="Choose category...">
                        <flux:select.option>Photography</flux:select.option>
                        <flux:select.option>Design services</flux:select.option>
                        <flux:select.option>Web development</flux:select.option>
                        <flux:select.option>Accounting</flux:select.option>
                        <flux:select.option>Legal services</flux:select.option>
                        <flux:select.option>Consulting</flux:select.option>
                        <flux:select.option>Other</flux:select.option>
                    </flux:select>

                </div>

                <div class="mb-4 sm:mb-8">
                    <label for="location" class="block mb-2 text-sm font-medium text-foreground">Job Location</label>
                    <input type="text" id="location" name="location" class="input" placeholder="Job Location">
                </div>

                <div class="mb-4 sm:mb-8">
                    <label for="salary" class="block mb-2 text-sm font-medium text-foreground">Job Salary</label>
                    <input type="text" id="salary" name="salary" class="input" placeholder="Job Salary">
                </div>

                <div class="mb-4 sm:mb-8">
                    <label for="job_type_id" class="block mb-2 text-sm font-medium text-foreground">Job Type</label>
                    <flux:select placeholder="Choose job type...">
                        <flux:select.option>Full time</flux:select.option>
                        <flux:select.option>Part time</flux:select.option>
                    </flux:select>

                </div>

                <div class="mb-4 sm:mb-8">
                    <label for="work_place_id" class="block mb-2 text-sm font-medium text-foreground">Work Place</label>
                    <flux:select placeholder="Choose work place...">
                        <flux:select.option>Onsite</flux:select.option>
                        <flux:select.option>Remote</flux:select.option>
                    </flux:select>

                </div>

                <div class="mb-4 sm:mb-8">
                    <label for="expires_at" class="block mb-2 text-sm font-medium text-foreground">Auto Expire Job</label>
                    <input type="date" id="expires_at" name="expires_at" class="input">
                </div>

                <div class="mb-4 sm:mb-8">
                    <label for="description" class="block mb-2 text-sm font-medium text-foreground">Job Descriptions</label>
                    <textarea id="description" name="description" class="input"></textarea>
                </div>

                <div class="mt-6 grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
