<?php

namespace App\Http\Controllers;

use App\Models\TechniqueDeveloppementEntrepreunariat;;

use App\models\formationQual;
use App\models\formationContinue;
use App\models\trimestre;
use App\models\secteur;
use App\models\qualification;
use App\models\DetailsFQ;
use App\models\realisationFQ;
use App\models\competence;
use App\models\metier;
use App\models\apprentissage;
use App\models\ped;
use App\Models\activites;
use App\Models\User;


use Illuminate\Support\Facades\Auth;

class AutreController extends Controller
{
    //

    public function index()
    {
       
        return view("autre.dashboard");
    }

    public function formationQualifiante()
    {

       $direction = User::where("id", Auth::id())->pluck("direction")->first();
       $data = formationQual::all()->where("user_id",Auth::id());
       $data1= trimestre::all();
       $activites = activites::all()->where("direction", $direction);
       $data2= secteur::all();
       $data3= qualification::all();
       $data4= DetailsFQ::all();
      
       
       return view("autre.formationQualifiante",["activites" => $activites, "detailsFQ"=>$data4,"data" => $data,"trimestres"=>$data1,"secteurs" => $data2,"qualification" => $data3]);
    }

    public function tde()
    {
       $data = TechniqueDeveloppementEntrepreunariat::all()->where("type",0)->where("user_id",Auth::id());;
       $data1= trimestre::all();
       $data2= secteur::all();
       $data3= metier::all();
       
       
       return view("autre.tde",["data" => $data,"trimestres"=>$data1,"secteurs" => $data2,"metiers" => $data3]);
    }

    public function formationContinue()
    {
       $data = formationContinue::all()->where("user_id",Auth::id());;
       $data1= trimestre::all();
       $data2= secteur::all();
       $data3= competence::all();
    
       return view("autre.formationContinue",["data" => $data,"competence" => $data3, "trimestres" => $data1,"secteurs" => $data2]);
 
    }

    public function formation()
    {
       $data = TechniqueDeveloppementEntrepreunariat::all()->where("type",1)->where("user_id",Auth::id());
       $trim = trimestre::all();
       return view("autre.formation",["data" => $data, "trimestres" => $trim]);


 
    }

    public function financement()
    {
       $data = TechniqueDeveloppementEntrepreunariat::all()->where("type",2)->where("user_id",Auth::id());
       $trim = trimestre::all();
       return view("autre.financement",["data" => $data, "trimestres" => $trim]);


 
    }


    public function apprentissage()
    {
       $data = apprentissage::all()->where("user_id",Auth::id());
       $data1= trimestre::all();
       $data2= secteur::all();
       $data3= qualification::all();
    
       return view("autre.apprentissage",["data" => $data,"qualification" => $data3, "trimestres" => $data1,"secteurs" => $data2]);
    
    }

    public function ped()
    {
       $data = ped::all()->where("user_id",Auth::id());
       $data1= trimestre::all();
       $data2= secteur::all();
       $data3= qualification::all();
    
       return view("autre.ped",["data" => $data,"qualifications" => $data3, "trimestres" => $data1,"secteurs" => $data2]);
    
    }
    public function detailsfq(){

       $id= $_REQUEST["id"];
       $data1= trimestre::all();
       $data2= secteur::all();
       $data3= qualification::all();
       $data = formationQual::where("id",$id)->firstOrFail();

       $details = detailsFQ::where("formation_qual_id",$id)->firstOrFail();
       $realisation = realisationFQ::where("formation_qual_id",$id)->firstOrFail();

        return view('autre.detailsfq',["data" => $data,"trimestres" => $data1, "secteurs"=>$data2, "qualifications" => $data3, "details" => $details, "realisations" => $realisation] );
    }

    public function detailsfc(){

       $id= $_REQUEST["id"];
       $data1= trimestre::all();
       $data2= secteur::all();
  
       $data = formationContinue::where("id",$id)->firstOrFail();

       $details = detailsFC::where("formation_continue_id",$id)->firstOrFail();
       $realisation = realisationFC::where("formation_continue_id",$id)->firstOrFail();

        return view('autre.detailsfc',["data" => $data,"trimestres" => $data1, "secteurs"=>$data2, "details" => $details, "realisations" => $realisation]);
    }

    public function compte(){

      $data = User::where("id",Auth::id())->firstOrFail();
       return view('autre.compte',["data" => $data]);
   }
}
