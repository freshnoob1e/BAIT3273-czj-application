<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deptsTitle = [
            'Production',
            'R&D',
            'Purchasing',
            'Marketing',
            'Human Resource',
            'Accounting',
            'Finance'
        ];

        foreach ($deptsTitle as $dept) {
            Department::create([
                'title' => $dept
            ]);
        }
    }
}
