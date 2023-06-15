<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\student;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Course::factory(10)->create();
        student::factory(50)->create();
        $this->call([
            UserSeeder::class,
        ]);
    }
}
