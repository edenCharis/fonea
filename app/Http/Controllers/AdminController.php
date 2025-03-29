<?php


namespace App\Http\Controllers;




use  App\Models\User;
use  App\Models\Annee;
use App\Models\secteur;
use  App\Models\Trimestre;
use  App\Models\metier;
use  App\Models\Direction;

use  App\Models\qualification;
use  App\Models\competence;
use  App\Models\role;

class AdminController extends Controller
{
    //
    public function index()
    {
        $data = User::all();
        $directions = Direction::all();
        $roles = role::all();
        return view("admin.dashboard",["data" => $data, "directions" => $directions, "roles" => $roles]);
    }

    public function annee()
    {
        $data = Annee::all();
        return view("admin.annee",["data" => $data]);
    }

    public function trimestre()
    {
        $data = Trimestre::all();
        $data1 = Annee::all();
        return view("admin.trimestre",["data" => $data,"annees" => $data1]);
    }

    public function secteur()
    {
        $data = secteur::all();
    
        return view("admin.secteur",["data" => $data]);
    }


    public function metier()
    {
        $data = metier::all();
        $data1 = secteur::all();
        return view("admin.metier",["data" => $data,"secteurs" => $data1]);
    }

    public function competence()
    {
        $data = competence::all();
        
        return view("admin.competence",["data" => $data]);
    }

    public function qualification()
    {
        $data = qualification::all();
        $data1 = metier::all();
        return view("admin.qualification",["data" => $data,"metiers" => $data1]);
    }

    public function direction()
    {
        $data = Direction::all();

        return view("admin.direction",["data" => $data]);
    }
}
