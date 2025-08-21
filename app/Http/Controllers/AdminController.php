<?php


namespace App\Http\Controllers;



use  App\Models\JournalActivites;
use  App\Models\User;
use  App\Models\Annee;
use App\Models\secteur;
use  App\Models\Trimestre;
use  App\Models\metier;
use  App\Models\Direction;
use Illuminate\Support\Facades\Auth;
use  App\Models\qualification;
use  App\Models\competence;
use  App\Models\role;
use  App\Models\ods;

class AdminController extends Controller
{
    //
    public function index()
    {
        $actions= JournalActivites::count();
        $users=User::count();

        $data = JournalActivites::all();
        $directions = Direction::all();
        $roles = role::all();
        return view("admin.dashboard",["data" => $data, "directions" => $directions, "roles" => $roles, "actions" =>$actions, "users" => $users]);
    }

    public function annee()
    {
         $actions= JournalActivites::count();
        $users=User::count();
        $data = Annee::all();
        return view("admin.annee",["data" => $data]);
    }


     public function utilisateur()
    {
        $actions= JournalActivites::count();
        $users=User::count();
        $data = User::all();
        $directions = Direction::all();
        $roles = role::all();
        return view("admin.users",["data" => $data, "directions" => $directions, "roles" => $roles,"actions" =>$actions, "users" => $users]);
    }

    public function trimestre()
    {
        $actions= JournalActivites::count();
        $users=User::count();
        $data = Trimestre::all();
        $data1 = Annee::all();
        return view("admin.trimestre",["data" => $data,"annees" => $data1,"actions" =>$actions, "users" => $users]);
    }

    public function secteur()
    {
        $actions= JournalActivites::count();
        $users=User::count();
        $data = secteur::all();
    
        return view("admin.secteur",["data" => $data,"actions" =>$actions, "users" => $users]);
    }


    public function metier()
    {
        $actions= JournalActivites::count();
        $users=User::count();
        $data = metier::all();
        $data1 = secteur::all();
        return view("admin.metier",["data" => $data,"secteurs" => $data1,"actions" =>$actions, "users" => $users]);
    }


    public function profil (){
        $actions= JournalActivites::count();
        $users=User::count();

        $direction = Auth::user()->Direction->code;
        $role = Auth::user()->role;
        $data =  $data = User::where("id",Auth::user()->id)->get()->first();



             return view("admin.compte", ["data" => $data, "actions" =>$actions, "users" => $users]);

       
       
    }


    public function competence()
    {
        $actions= JournalActivites::count();
        $users=User::count();
        $data = competence::all();
        $qualifications = qualification::all();
        
        return view("admin.competence",["data" => $data, "qualifications"=> $qualifications,"actions" =>$actions, "users" => $users]);
    }

    public function qualification()
    {
        $actions= JournalActivites::count();
        $users=User::count();
        $data = qualification::all();
        $data1 = metier::all();
        return view("admin.qualification",["data" => $data,"metiers" => $data1,"actions" =>$actions, "users" => $users]);
    }

    public function direction()
    {
        $actions= JournalActivites::count();
        $users=User::count();
        $data = Direction::all();

        return view("admin.direction",["data" => $data,"actions" =>$actions, "users" => $users]);
    }

    
    public function ods()
    {
        $actions= JournalActivites::count();
        $users=User::count();

        $data = ods::all();
        $directions = Direction::all();
        return view("admin.ods",["data" => $data, "directions" => $directions,"actions" =>$actions, "users" => $users]);
    }
}
