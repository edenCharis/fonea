<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\direction;
use App\Models\role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
           // SecteursTableSeeder::class,
            //MetiersTableSeeder::class
        ]);


     /*   Direction::insert([
            [
                'libelle' => "Direction des services informatiques et de la prospective",
                'code' => "DSIP",
            ],
            [
                'libelle' => "Direction de l'employabilité",
                'code' => "DE",
            ],
            [
                'libelle' => "Direction de l'apprentissage",
                'code' => "DA",
            ],
            [
                'libelle' => "Direction des études et l'analyse des projets",
                'code' => "DEAP",
            ],
            [
                'libelle' => "Délégation Controle Budgetaire",
                'code' => "DCB",
            ],
            [
                'libelle' => "Direction des affaires juridiques, financières et des ressources humaines",
                'code' => "DAJFRH",
            ],
        ]);*/

        User::factory()->create([
            'name' => 'Eden',
            'email' => 'edenngouanda@gmail.com',
            'password' => Hash::make('Fonea@2025*'),
            'role' => "administrateur",
            'direction' => "DSIP"
            
        ]);

       


       /*Role::insert([
        [
            'name' => "Agent DSIP"
        
        ],
        [
            'name' => "Agent DE"
        ],
        [
            'name' => "Agent DA"
        ],
        [
            'name' => "Agent DEAP"
        ],
        [
            'name' => "Agent DCB"
        ],
        [
            'name' => "directeur général"
        ],
        [
            'name' => "Délégué au Contrôle Budgetaire"
        ],
    ]);*/



        
    }
}
