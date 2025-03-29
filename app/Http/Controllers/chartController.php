<?php

namespace App\Http\Controllers;

use App\Models\stat_formation_qual;
use App\Models\Annee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class chartController extends Controller
{

    public function index(){

        $annees= Annee::all();

        $data = DB::table('stat_form_qual')
        ->join('trimestre', 'stat_form_qual.trimestre_id', '=', 'trimestre.id')
        ->join('annees', 'trimestre.annee_id', '=', 'annees.id')
        ->join("qualification", "stat_form_qual.qualification_id", "=", "qualification.id")
        ->join("metier", "qualification.metier_id", "=", "metier.id")
        ->select(
            'trimestre.libelle as trimestre',
            'annees.libelle as annee',
            'metier.libelle as metier',
            DB::raw('COUNT(DISTINCT stat_form_qual.id) as total_offres')
        )
        ->groupBy('annees.libelle', 'trimestre.libelle', 'metier.libelle')
        ->orderBy('annees.libelle', 'asc')
        ->orderBy('trimestre.libelle', 'asc')
        ->orderBy('metier.libelle', 'asc')
        ->get();
        return view('dg.dashboard', compact('data','annees'));
    } 
    
    public function fq_recherche_annee(Request $request){

        $annees= Annee::all();

        $data = DB::table('stat_form_qual')
        ->join('trimestre', 'stat_form_qual.trimestre_id', '=', 'trimestre.id')
        ->join('annees', 'trimestre.annee_id', '=', 'annees.id')
        ->join("qualification", "stat_form_qual.qualification_id", "=", "qualification.id")
        ->join("metier", "qualification.metier_id", "=", "metier.id")
        ->select(
            'trimestre.libelle as trimestre',
            'annees.libelle as annee',
            'metier.libelle as metier',
            DB::raw('COUNT(DISTINCT stat_form_qual.id) as total_offres')
        )
        ->groupBy('annees.libelle', 'trimestre.libelle', 'metier.libelle')
        ->orderBy('annees.libelle', 'asc')
        ->orderBy('trimestre.libelle', 'asc')
        ->orderBy('metier.libelle', 'asc')
        ->where('annees.id',$request->annee_id)
        ->get();
        return view('dg.dashboard', compact('data','annees'));
    }


    public function fq_stat_insertion(){

        $annees= Annee::all();
        $data = DB::table('stat_form_qual')
        ->join('trimestre', 'stat_form_qual.trimestre_id', '=', 'trimestre.id')
        ->join('annees', 'trimestre.annee_id', '=', 'annees.id')
        ->join("qualification", "stat_form_qual.qualification_id", "=", "qualification.id")
        ->join("metier", "qualification.metier_id", "=", "metier.id")
        ->select(
            'trimestre.libelle as trimestre',
            'annees.libelle as annee',
            'metier.libelle as metier',
            DB::raw('SUM(stat_form_qual.ndi) as total_insertions'),
            DB::raw('SUM(stat_form_qual.ndf) as total_formations'),
           
        )
        ->groupBy('annees.libelle', 'trimestre.libelle', 'metier.libelle')
        ->orderBy('annees.libelle', 'asc')
        ->orderBy('trimestre.libelle', 'asc')
        ->orderBy('metier.libelle', 'asc')
        ->get();
        return view('dg.fqstatinsertion', compact('data','annees'));
   



    }

    public function fq_insertion_formation_recherche(Request $request)
    {

        $annees= Annee::all();
        $data = DB::table('stat_form_qual')
        ->join('trimestre', 'stat_form_qual.trimestre_id', '=', 'trimestre.id')
        ->join('annees', 'trimestre.annee_id', '=', 'annees.id')
        ->join("qualification", "stat_form_qual.qualification_id", "=", "qualification.id")
        ->join("metier", "qualification.metier_id", "=", "metier.id")
        ->select(
            'trimestre.libelle as trimestre',
            'annees.libelle as annee',
            'metier.libelle as metier',
            DB::raw('SUM(stat_form_qual.ndi) as total_insertions'),
            DB::raw('SUM(stat_form_qual.ndf) as total_formations'),
           
        )
        ->groupBy('annees.libelle', 'trimestre.libelle', 'metier.libelle')
        ->orderBy('annees.libelle', 'asc')
        ->orderBy('trimestre.libelle', 'asc')
        ->orderBy('metier.libelle', 'asc')
        ->where('annees.id',$request->annee_id)
        ->get();
        return view('dg.fqstatinsertion', compact('data','annees'));
   

    }

    public function fq_stat_secteur()
    {

        $annees= Annee::all();
        $data = DB::table('stat_form_qual')
        ->join('trimestre', 'stat_form_qual.trimestre_id', '=', 'trimestre.id')
        ->join('annees', 'trimestre.annee_id', '=', 'annees.id')
        ->join("qualification", "stat_form_qual.qualification_id", "=", "qualification.id")
        ->join("metier", "qualification.metier_id", "=", "metier.id")
        ->join("secteur", "metier.secteur_id","=","secteur.id")
        ->select(
            'trimestre.libelle as trimestre',
            'annees.libelle as annee',
            'secteur.libelle as secteur',
            DB::raw('SUM(stat_form_qual.ndi) as total_insertions'),
            DB::raw('SUM(stat_form_qual.ndf) as total_formations'),
           
        )
        ->groupBy('annees.libelle', 'trimestre.libelle', 'secteur.libelle')
        ->orderBy('annees.libelle', 'asc')
        ->orderBy('trimestre.libelle', 'asc')
        ->orderBy('secteur.libelle', 'asc')
        ->get();
        return view('dg.fqstatsecteur', compact('data','annees'));
   


    }

}


