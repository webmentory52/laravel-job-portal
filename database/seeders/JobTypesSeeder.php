<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobTypes = [
          "Full Time",
          "Part Time",
        ];

        foreach ($jobTypes as $jobType) {
            JobType::create([
                "name" => $jobType,
            ]);
        }
    }
}
