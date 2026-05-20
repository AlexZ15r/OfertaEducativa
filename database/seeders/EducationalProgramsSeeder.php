<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EducationalProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get timestamp creation dates
        $now = Carbon::now();

        // database inserts
        DB::table('public.educational_programs')->insert([
            ['type' => '', 'key' => '', '_key' => '', '__key' => '', 'name' => '', 'active' => '', 'with_terminals' => '', 'created_at' => '', 'updated_at' => ''],
        ]);
    }
}
