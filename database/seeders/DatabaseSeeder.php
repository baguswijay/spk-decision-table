<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BobotKriteria;
use App\Models\Kalori;
use App\Models\Karbohidrat;
use App\Models\Natrium;
use App\Models\ProteinKriteria;
use App\Models\Usia;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $kriteria = new BobotKriteria();
        $protein = new ProteinKriteria();
        $karbo = new Karbohidrat();
        $kalori = new Kalori();
        $natrium = new Natrium();
        $usia = new Usia();

        BobotKriteria::insert($kriteria->fillTable());
        ProteinKriteria::insert($protein->fillTable());
        Karbohidrat::insert($karbo->fillTable());
        Kalori::insert($kalori->fillTable());
        Natrium::insert($natrium->fillTable());
        Usia::insert($usia->fillTable());
    }
}
