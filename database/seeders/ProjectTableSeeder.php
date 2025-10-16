<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::truncate();
        Project::insert([
            ['name' => 'Project A', 'description' => 'Description for Project A'],
            ['name' => 'Project B', 'description' => 'Description for Project B'],
        ]);

    }
}
