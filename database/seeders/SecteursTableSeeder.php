<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SecteursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('secteur')->insert([
            ['libelle' => 'Agriculture'],
            ['libelle' => 'Industrie'],
            ['libelle' => 'Commerce'],
            ['libelle' => 'Transports'],
            ['libelle' => 'Santé'],
            ['libelle' => 'Éducation'],
            ['libelle' => 'Administration publique'],
            ['libelle' => 'Tourisme'],
            ['libelle' => 'Construction'],
            ['libelle' => 'Technologies de l\'information'],
        ]);
    }
}
