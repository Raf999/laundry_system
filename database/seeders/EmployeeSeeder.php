<?php

namespace Database\Seeders;

use App\Enum\EmployeeRoleEnum;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'full_name' => 'John Doe',
            'role' => EmployeeRoleEnum::ADMIN->value,
            'phone' => '+233290000000',
            'email' => 'email@gmail.com',
            'password' => 'pass9999',
        ]);

       Employee::factory()->create(['role' => EmployeeRoleEnum::FRONTDESK->value]);
       Employee::factory()->create(['role' => EmployeeRoleEnum::IRONER->value]);
       Employee::factory()->create(['role' => EmployeeRoleEnum::WASHER->value]);
    }
}
