<?php

namespace App\Http\Controllers;

use App\Models\secteur;
use App\Models\metier;
use App\Models\qualification;
use App\Models\Trimestre;
use App\Models\Annee;
use App\Models\stat_formation_qual;
use App\Models\competence;
use App\Models\statFormContinue;
use App\Models\statApprentissage;
use App\Models\statTDE;
use App\Models\statPED;
use Illuminate\Support\Facades\DB;

class dgController extends Controller
{
    //

    public function index()
    {

        $secteurs = secteur::all();
        $annees = annee::all();
        $metiers = metier::all();
        $qualifications =qualification::all();
        $trimestres = trimestre::all();
       
        return view("dg.dashboard", ["secteurs" => $secteurs, "annees" => $annees, "metiers" => $metiers, "qualifications" => $qualifications, "trimestres" => $trimestres]);
    }


    public function formationQual()
    {
        $secteurs = secteur::all();
        $annees = annee::all();
        $metiers = metier::all();
        $qualifications =qualification::all();
        $trimestres = trimestre::select("libelle")->distinct()->get();
        $data = stat_formation_qual::select("trimestre_id","secteur_id","qualification_id", DB::raw('SUM(ndf) as total_formation'),DB::raw('SUM(ndi) as total_insertion'),DB::raw('SUM(decrochage) as total_decrochage'))
        ->groupBy("secteur_id","trimestre_id")
        ->get();


        return view("dg.formQual", ["data" => $data,"secteurs" => $secteurs, "annees" => $annees, "metiers" => $metiers, "qualifications" => $qualifications, "trimestres" => $trimestres]);
   
    }
    public function formationContinue()
    {
        $secteurs = secteur::all();
        $annees = annee::all();
        $metiers = metier::all();
        $competences =competence::all();
        $qualifications =qualification::all();
        $trimestres = trimestre::select("libelle")->distinct()->get();
 
        


        $data = statFormContinue::select("trimestre_id","poste","qualification_id","secteur_id","competence_id","entreprise", DB::raw('SUM(ned) as total_employes'))
       ->groupBy("secteur_id","trimestre_id","poste")
        ->get();


        return view("dg.formCont", ["data" => $data,"secteurs" => $secteurs,"qualifications" => $qualifications, "annees" => $annees, "metiers" => $metiers, "competences" => $competences, "trimestres" => $trimestres]);
   
    }


    public function apprentissage()
    {
        $secteurs = secteur::all();
        $annees = annee::all();
        $metiers = metier::all();
        $qualifications =qualification::all();
        $trimestres = trimestre::select("libelle")->distinct()->get();
        $data = statApprentissage::select("trimestre_id","secteur_id","qualification_id",DB::raw('SUM(ndf) as total_formation'),DB::raw('SUM(ndi) as total_insertion'),DB::raw('SUM(decrochage) as total_decrochage'))
        ->groupBy("secteur_id","trimestre_id")
        ->get();
        return view("dg.apprentissage", ["data" => $data,"secteurs" => $secteurs, "annees" => $annees, "metiers" => $metiers, "qualifications" => $qualifications, "trimestres" => $trimestres]);
    }

    public function tde(){

        $secteurs = secteur::all();
        $annees = annee::all();
        $metiers = metier::all();
        $trimestres = trimestre::select("libelle")->distinct()->get();
        $data = statTDE::select("trimestre_id","secteur_id","metier_id",DB::raw('SUM(nipi) as total_projet'),DB::raw('SUM(npf) as total_formation'),DB::raw('SUM(nrb) as total_financement'))
        ->groupBy("secteur_id","trimestre_id")
        ->get();
        return view("dg.tde", ["data" => $data,"secteurs" => $secteurs, "annees" => $annees, "metiers" => $metiers, "trimestres" => $trimestres]);
    }

    public function ped(){

        $secteurs = secteur::all();
        $annees = annee::all();
        $metiers = metier::all();
        $trimestres = trimestre::select("libelle")->distinct()->get();
        $data = statPED::select("departement","entreprise","trimestre_id","secteur_id","metier_id",DB::raw('SUM(npa) as total_placement'))
        ->groupBy("departement","trimestre_id")
        ->get();
        return view("dg.ped", ["data" => $data,"secteurs" => $secteurs, "annees" => $annees, "metiers" => $metiers, "trimestres" => $trimestres]);
    }

}

