<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Superadmin
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@jobportal.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        // Company
        $company = Company::create([
            'company_name' => 'Company',
            'website' => 'https://www.company.com',
            'email' => 'info@company.com',
            'logo' => 'logo.png',
            'bio' => 'lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet',
        ]);

        // Company User
        $companyUser = User::factory()->create([
            'name' => 'company',
            'email' => 'admin@company.com',
            'password' => Hash::make('12345678'),
            'role' => 'user'
        ]);

        // Attach company user to company
        $company->users()->attach($companyUser, ['role' => 'admin']);
    }
}
