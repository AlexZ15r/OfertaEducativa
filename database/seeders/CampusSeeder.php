<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get timestamp creation dates
        $now = Carbon::now();

        // database inserts
        DB::table('public.campus')->insert([
            ['key' => 'CU2', 'name' => 'Ciudad Universitaria 2', 'created_at' => $now, 'updated_at' => $now],
            // ['key' => '7', 'name' => 'Preparatorias Urbanas', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '10', 'name' => 'Puebla - Atlixcayotl', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '2', 'name' => 'Puebla - Centro', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '1', 'name' => 'Puebla - Ciudad Universitaria', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '3', 'name' => 'Puebla - Salud', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'Y', 'name' => 'Regional Acajete', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'F', 'name' => 'Regional Acatzingo', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '17', 'name' => 'Regional Amozoc', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '4', 'name' => 'Regional Atlixco', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'L', 'name' => 'Regional Chiautla de Tapia', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'B', 'name' => 'Regional Chignahuapan', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'Q', 'name' => 'Regional Ciudad Serdan', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '15', 'name' => 'Regional Coyomeapan', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'O', 'name' => 'Regional Cuetzalan', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'I', 'name' => 'Regional Huauchinango', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '19', 'name' => 'Regional Ixtepec', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'X', 'name' => 'Regional Izucar de Matamoros', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'D', 'name' => 'Regional Libres', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '13', 'name' => 'Regional Los Reyes de Juárez', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '11', 'name' => 'Regional San Jose Chiapa', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'N', 'name' => 'Regional San Martín Texmelucan', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '21', 'name' => 'Regional San Pedro Zacachimalpa', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '14', 'name' => 'Regional San Salvador El Seco', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '5', 'name' => 'Regional Tecamachalco', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'A', 'name' => 'Regional Tehuacan', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'G', 'name' => 'Regional Tepeaca', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'M', 'name' => 'Regional Tetela de Ocampo', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '6', 'name' => 'Regional Teziutlan', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '18', 'name' => 'Regional Tlacotepec  de Benito Juárez', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '9', 'name' => 'Regional Tlatlauquitepec', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '16', 'name' => 'Regional Venustiano Carranza', 'created_at' => $now, 'updated_at' => $now],
            ['key' => '22', 'name' => 'Regional Vicente Guerrero', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'H', 'name' => 'Regional Zacapoaxtla', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'V', 'name' => 'Regional Zacatlan', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
