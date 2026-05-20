<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::firstOrCreate(['name' => 'academic-offer.catalogs.manage']);
        Permission::firstOrCreate(['name' => 'academic-offer.statistics.view']);
        Permission::firstOrCreate(['name' => 'academic-offer.public-offer.manage']);
    }
}
