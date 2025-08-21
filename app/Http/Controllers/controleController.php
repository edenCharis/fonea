<?php

namespace App\Http\Controllers;

use App\Models\activites;
use App\Models\Annee;
use App\Models\Direction;
use Illuminate\Http\Request;
use App\Models\journalActivites;
use Illuminate\Support\Facades\Auth;

class controleController extends Controller
{
    //

    public function index()
    {
        $data = activites::all();
        $directions = Direction::all();
        $annees=Annee::all(); 
        return view("controle.dashboard",["data" => $data, "directions" => $directions, "annees" => $annees]);
    }

    public function editer(){
        $id= $_REQUEST["id"];
      
        $annees= annee::all();
        $directions= direction::all();
        $data = activites::where("id",$id)->firstOrFail();

         return view('controle.edit',[ "activite" => $data, "annees"=>$annees, "directions" => $directions]);
   


    }

    public function activite(){
     
      
       if(Auth::user()->Direction->code === "DCB"){

               $data = journalActivites::all();

             return view('controle.journal',[ "data" => $data]);
       }else{

          $direction = Auth::user()->Direction->code;

           $data = journalActivites::where("direction",$direction)->get();

         return view('dg.journal',[ "data" => $data]);
       }
     
   


    }

}
