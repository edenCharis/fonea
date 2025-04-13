<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetencesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('competence')->insert([
            ['libelle' => 'Communication orale'],
            ['libelle' => 'Gestion de projet'],
            ['libelle' => 'Analyse de données'],
            ['libelle' => 'Développement web'],
            ['libelle' => 'Conception graphique'],
            ['libelle' => 'Programmation en Python'],
            ['libelle' => 'Comptabilité générale'],
            ['libelle' => 'Gestion des stocks'],
            ['libelle' => 'Négociation commerciale'],
            ['libelle' => 'Service client'],
            ['libelle' => 'Maintenance informatique'],
            ['libelle' => 'Conduite de véhicules lourds'],
            ['libelle' => 'Rédaction technique'],
            ['libelle' => 'Traduction multilingue'],
            ['libelle' => 'Planification stratégique'],
        ]);
    }
}
