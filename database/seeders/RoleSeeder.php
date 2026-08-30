<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {

            $roles = [
                [
                    'name' => 'Super Admin',
                    'slug' => 'super_admin',
                ],
                [
                    'name' => 'Owner',
                    'slug' => 'owner',
                ],
                [
                    'name' => 'Manager',
                    'slug' => 'manager',
                ],
                [
                    'name' => 'Developer',
                    'slug' => 'developer',
                ],
                [
                    'name' => 'Accountant',
                    'slug' => 'accountant',
                ],
            ];

            foreach ($roles as $role) {

                Role::firstOrCreate(
                    [
                        'company_id' => $company->id,
                        'slug' => $role['slug'],
                    ],
                    [
                        'name' => $role['name'],
                    ]
                );
            }
        }
    }
}
