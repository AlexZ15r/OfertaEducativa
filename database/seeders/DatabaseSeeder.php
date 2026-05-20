<?php

namespace Database\Seeders;

use App\Models\AcademicUnit;
use App\Models\MainArea;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        MainArea::find(1)->update([
            'nombre' => 'Ciencias Sociales y Humanidades',
            'color_titulo' => '#C38FF2',
            'color_fondo_high' => '#a86be8',
            'color_fondo_low' => '#e3caf2',
            'color_borde' => '#6749DF',
            'aparicion' => 5,
            'class' => 'ciencias-sociales-humanidades',
            'img' => 'images/arena-buap.jpg',
            'icon' => 'images/iconos/ciencias-sociales-humanidades.png'
        ]);
        MainArea::find(2)->update([
            'nombre' => 'Ingenierías y Ciencias Exactas',
            'color_titulo' => '#F9B06E',
            'color_fondo_high' => '#f9af6e',
            'color_fondo_low' => '#f2d3aa',
            'color_borde' => '#FF8800',
            'aparicion' => 6,
            'class' => 'ingenieria-ciencias-exactas',
            'img' => 'images/administracion.jpg',
            'icon' => 'images/iconos/ingenieria-ciencias-exactas.png'
        ]);
        MainArea::find(3)->update([
            'nombre' => 'Económico Administrativa',
            'color_titulo' => '#F9DD64',
            'color_fondo_high' => '#f9dd63',
            'color_fondo_low' => '#fdf5b2',
            'color_borde' => '#FFCF1F',
            'aparicion' => 7,
            'class' => 'economico-administrativas',
            'img' => 'images/arena-buap.jpg',
            'icon' => 'images/iconos/economico-administrativas.png'
        ]);
        MainArea::find(4)->update([
            'nombre' => 'Ciencias Naturales y de la Salud',
            'color_titulo' => '#86C16B',
            'color_fondo_high' => '#71b745',
            'color_fondo_low' => '#cff9bd',
            'color_borde' => '#006837',
            'aparicion' => 8,
            'class' => 'ciencias-naturales-salud',
            'img' => 'images/administracion.jpg',
            'icon' => 'images/iconos/ciencias-naturales-salud.png'
        ]);
        MainArea::find(6)->update([
            'nombre' => 'Nueva Oferta Educativa',
            'color_titulo' => '#122e48',
            'color_fondo_high' => '#a50000',
            'color_fondo_low' => '#e5c3c4',
            'color_borde' => '#122e48',
            'aparicion' => 0,
            'class' => 'nueva-oferta-educativa',
            'img' => 'images/arena-buap.jpg',
            'icon' => 'images/iconos/reloj.png'
        ]);
        MainArea::find(7)->update([
            'nombre' => 'Complejos regionales',
            'color_titulo' => '#122e48',
            'color_fondo_high' => '#b4b4b4',
            'color_fondo_low' => '#e8e8e8',
            'color_borde' => '#122e48',
            'aparicion' => 1,
            'class' => 'complejos-regionales',
            'img' => 'images/administracion.jpg',
            'icon' => 'images/iconos/reloj.png'
        ]);
        MainArea::find(8)->update([
            'nombre' => 'CU2',
            'color_titulo' => '#122e48',
            'color_fondo_high' => '#3fe0d0',
            'color_fondo_low' => '#9df6f2',
            'color_borde' => '#122e48',
            'aparicion' => 2,
            'class' => 'cu2',
            'img' => 'images/arena-buap.jpg',
            'icon' => 'images/iconos/reloj.png'
        ]);
        MainArea::find(9)->update([
            'nombre' => 'Carrera técnica',
            'color_titulo' => '#122e48',
            'color_fondo_high' => '#e988cd',
            'color_fondo_low' => '#fcc0e6',
            'color_borde' => '#122e48',
            'aparicion' => 4,
            'class' => 'carrera-tecnica',
            'img' => 'images/administracion.jpg',
            'icon' => 'images/iconos/carrera-tecnica.png'
        ]);
        // $this->call(CampusSeeder::class);
        // $this->call(AcademicUnitSeeder::class);
        // $this->call(PermissionSeeder::class);
    }
}
