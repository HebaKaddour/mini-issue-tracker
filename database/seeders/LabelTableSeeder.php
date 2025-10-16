<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Label::truncate();
        Label::insert([
            ['name' => 'bug','description' => 'Indicates a bug in the system'],
            ['name' => 'feature', 'description' => 'Indicates a new feature request'],
            ['name' => 'documentation', 'description' => 'Indicates documentation-related tasks'],
        ]);
    }
}
