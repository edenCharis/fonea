<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MetiersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('metier')->insert([
            ['libelle' => 'Agriculteur', 'secteur_id' => 1],
            ['libelle' => 'Technicien agricole', 'secteur_id' => 1],
            ['libelle' => 'Ouvrier industriel', 'secteur_id' => 2],
            ['libelle' => 'Commerçant', 'secteur_id' => 3],
            ['libelle' => 'Chauffeur de bus', 'secteur_id' => 4],
            ['libelle' => 'Infirmier', 'secteur_id' => 5],
            ['libelle' => 'Enseignant', 'secteur_id' => 6],
            ['libelle' => 'Agent administratif', 'secteur_id' => 7],
            ['libelle' => 'Guide touristique', 'secteur_id' => 8],
            ['libelle' => 'Développeur informatique', 'secteur_id' => 10],
        ]);
    }
}
