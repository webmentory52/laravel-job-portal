<?php

namespace Database\Seeders;

use App\Models\WorkPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkPlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $places = [
            "Onsite",
            "Remote",
        ];

        foreach ($places as $place) {
            WorkPlace::create([
                "name" => $place,
            ]);
        }
    }
}
