<?php

namespace Database\Seeders;

use App\Enum\CompanyStatus;
use App\Enum\StaffRoleEnum;
use App\Models\Company;
use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::create([
            'name' => 'Raf Laundry',
            'address' => 'Accra, Ghana',
            'phone' => '+233200000000',
            'email' => 'info@raflaundry.com',
            'status' => CompanyStatus::APPROVED->value,
        ]);

        Staff::create([
            'full_name' => 'John Doe',
            'role' => StaffRoleEnum::ADMIN->value,
            'phone' => '+233290000000',
            'email' => 'email@gmail.com',
            'password' => 'pass9999',
            'company_id' => $company->id,
        ]);

       Staff::factory()->create(['role' => StaffRoleEnum::FRONTDESK->value]);
       Staff::factory()->create(['role' => StaffRoleEnum::IRONER->value]);
       Staff::factory()->create(['role' => StaffRoleEnum::WASHER->value]);
    }
}
