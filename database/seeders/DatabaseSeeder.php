<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a company
        $company = Company::create(['name' => 'Default Company']);

        // Create SuperAdmin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'company_id' => $company->id,
        ]);
        $superAdmin->assignRole('SuperAdmin');

        // Assign permissions
        $superAdmin->givePermissionTo(['view-all-short-urls', 'invite-user']);
    }
}
