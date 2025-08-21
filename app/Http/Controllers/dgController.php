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
use App\Models\activites;
use App\Models\Direction;
use App\Models\formationQual;
use App\Models\apprentissage;
use App\Models\formationContinue;
use App\Models\ped;
use Illuminate\Support\Facades\Auth;
use App\Models\TechniqueDeveloppementEntrepreunariat;

    function getActivityCompletionMetrics($directionId, $year)
{
    // Get all planned activities for the given direction and year


    if(Auth::user()->Direction->code =="DG"){
      $plannedActivities = DB::table('activites as a')
        ->join('direction as d', 'a.direction_id', '=', 'd.id')
        ->where('a.annee_id', $year)
       
        ->select(
            'a.libelle',
            'd.code as direction',
            'a.mtb',
            'a.taux',
            'a.statut as planned_statut'
        )
        ->get();

    
    $completedActivities = DB::table('journal_activites as j')
        ->join('trimestre as t','j.trimestre_id', '=', 't.id')
        ->join('direction as d', 'j.direction', '=', 'd.code')
    
        ->where('t.annee_id', $year)
      
        ->select(
            'j.libelle',
            'd.code as direction',
            'j.statut as statut_budget'
        )
        ->get();  

  
    }else{
          $plannedActivities = DB::table('activites as a')   
        ->where('a.direction_id', $directionId)
        ->where('a.annee_id', $year)
        ->select(
            'a.libelle',
            'a.mtb',
            'a.taux',
            'a.statut as planned_statut'
        )
        ->get();

    
    $completedActivities = DB::table('journal_activites as j')
        ->join('direction as d', 'j.direction', '=', 'd.code')
        ->join('trimestre as t','j.trimestre_id', '=', 't.id')
        ->where('d.id', $directionId)
        ->where('t.annee_id', $year)
        ->select(
            'j.libelle',
            'j.statut as statut_budget'
        )
        ->get();  

  
    }
    // Return as associative array
    return [
        'activities_planned'   => $plannedActivities->toArray(),
       'activities_completed' => $completedActivities->toArray()
    ];
}


class dgController extends Controller
{
    //


    public function get(){

      
    
    $userDirection = Auth::user()->Direction->code;
    $userDirectionId = Auth::user()->Direction->id;
    $data = [];
    $currentYear = date('Y');

   $year = annee::where('libelle', $currentYear)->first();
   $year = $year->id;

   
        // Formation Qualifiante Data
        $fq_stats = stat_formation_qual::select(
            DB::raw('SUM(total_formes) as total_formes'),
            DB::raw('SUM(total_inseres) as total_inseres'),
            DB::raw('COUNT(DISTINCT qualification_nom) as nb_qualifications'),
            DB::raw('COUNT(DISTINCT secteur.libelle) as nb_secteurs')
        )
        ->join('qualification', 'stat_form_qual.qualification_nom', '=', 'qualification.libelle')
        ->join('metier', 'qualification.metier_id', '=', 'metier.id')
        ->join('secteur', 'metier.secteur_id', '=', 'secteur.id')
        ->where('annee', $currentYear)
        ->first();
        
        $data['fq_data'] = [
            'total_formes' => $fq_stats->total_formes ?? 0,
            'taux_insertion' => $fq_stats->total_formes > 0 ? 
                round(($fq_stats->total_inseres / $fq_stats->total_formes) * 100) : 0,
            'nb_secteurs' => $fq_stats->nb_secteurs ?? 0
        ];
        
        $data['fq_details'] = stat_formation_qual::select(
            'secteur.libelle as secteur_nom',
            DB::raw('SUM(total_formes) as total_formation'),
            DB::raw('SUM(total_inseres) as total_insertion')
        )
        ->join('qualification', 'stat_form_qual.qualification_nom', '=', 'qualification.libelle')
       ->join('metier', 'qualification.metier_id', '=', 'metier.id')
       ->join('secteur', 'metier.secteur_id', '=', 'secteur.id')
       ->where('annee', $currentYear)
       ->groupBy('secteur.libelle')
       ->limit(10)
       ->get();

       // Formation Continue Data - FIXED
       $fc_stats = statFormContinue::select(
           DB::raw('COUNT(DISTINCT entreprises) AS nb_entreprises'),
           DB::raw('SUM(total_developes) as total_participants'),
           DB::raw('SUM(total_prevus) as total_prevus')
       )->first();
       
       $data['fc_data'] = [
           'total_participants' => $fc_stats->total_participants ?? 0,
           'taux' => $fc_stats->nb_entreprises > 0 ? 
               round($fc_stats->total_participants / $fc_stats->nb_entreprises, 2) : 0,
           'entreprises' => $fc_stats->nb_entreprises ?? 0
       ];
       
       $data['fc_details'] = statFormContinue::select(
           'qualification_nom',
           DB::raw('SUM(total_developes) as total_participants'),
           DB::raw('SUM(total_prevus) as total_prevus')
       )
       ->groupBy('qualification_nom')
       ->limit(10)
       ->get();

       // Programme Emploi Diplômé Data - FIXED
       $ped_stats = statPED::select(
           DB::raw('SUM(placement_prevus) as total_placement_prevus'),
           DB::raw('SUM(placements) as total_placements')
       )->first();
       
       $data['ped_data'] = [
           'total_placements' => $ped_stats->total_placements ?? 0,
           'taux_reussite' => $ped_stats->total_placement_prevus > 0 ? 
               round(($ped_stats->total_placements / $ped_stats->total_placement_prevus) * 100) : 0
       ];
       
       $data['ped_details'] = statPED::select(
           'departement',
           DB::raw('SUM(placements) as total_placements')
       )
       ->groupBy('departement')
       ->limit(10)
       ->get();
 
       // Apprentissage Data
       $am_stats = statApprentissage::select(
           DB::raw('SUM(formations) as total_apprentis'),
           DB::raw('SUM(insertions) as total_inseres'),
           DB::raw('COUNT(DISTINCT secteur_nom) as nb_secteurs'),
           DB::raw('COUNT(DISTINCT qualification_nom) as nb_metiers')
       )->first();
       
       $data['am_data'] = [
           'total_apprentis' => $am_stats->total_apprentis ?? 0,
           'nb_metiers' => $am_stats->nb_metiers ?? 0,
           'taux_reussite' => $am_stats->total_apprentis > 0 ? 
               round(($am_stats->total_inseres / $am_stats->total_apprentis) * 100) : 0
       ];
       
       $data['am_details'] = statApprentissage::leftJoin('qualification', 'stat_apprentissage.qualification_nom', '=', 'qualification.libelle')
           ->join('metier', 'qualification.metier_id', '=', 'metier.id')
           ->join('secteur', 'metier.secteur_id', '=', 'secteur.id')
           ->select(
               'qualification.libelle as qualification_nom',
               DB::raw('SUM(formations) as total_formation'),
               DB::raw('SUM(insertions) as total_insertion'),
               DB::raw('COUNT(DISTINCT secteur.id) as nb_maitres'),
               DB::raw('CASE WHEN SUM(formations) > 0 THEN ROUND((SUM(insertions) / SUM(formations)) * 100) ELSE 0 END as taux_reussite')
           )
           ->groupBy('qualification.libelle')
           ->limit(10)
           ->get();
  
       // TDE Data
       $tde_stats = statTDE::select(
       
          DB::raw( 'SUM(nbre_emploi_cree) as emplois_crees'),
           DB::raw('SUM(formations) as total_formes'),
           DB::raw('SUM(idees_projets) as total_projets'),
           DB::raw('SUM(financements) as total_financement')
       )
       ->first();
       
       $data['tde_data'] = [
           'total_formes' => $tde_stats->total_formes ?? 0,
           'emplois_crees' => $tde_stats->emplois_crees ?? 0,
           'taux_creation' => $tde_stats->total_formes > 0 ? 
               round(($tde_stats->total_projets / $tde_stats->total_formes) * 100) : 0
       ];

$distinctSecteurs = statTDE::leftJoin('secteur', 'stat_tde.secteur_nom', '=', 'secteur.libelle')
    ->whereNotNull('stat_tde.formations')
    ->distinct('secteur.libelle')
    ->count('secteur.libelle');


$data['tde_details'] = statTDE::leftJoin('secteur', 'stat_tde.secteur_nom', '=', 'secteur.libelle')
    ->select(
        'secteur.libelle as secteur_nom',
        DB::raw('SUM(formations) as total_formation')
    )
     ->whereNotNull('stat_tde.formations')
    ->groupBy('secteur.libelle')
    ->limit(10)
    ->get();

$data['distinct_secteurs'] = $distinctSecteurs;


          
$distinctSecteurs2 = statTDE::leftJoin('secteur', 'stat_tde.secteur_nom', '=', 'secteur.libelle')
    ->whereNotNull('stat_tde.idees_projets')
    ->distinct('secteur.libelle')
    ->count('secteur.libelle');
       // Idées de Projets Data - FIXED
       $data['ip_data'] = [
           'total_idees' => $tde_stats->total_projets ?? 0,
           'nb_secteurs' => $distinctSecteurs2 
       ];
       
     $ip_details = DB::table('stat_tde as t')
    ->join('secteur as s', 't.secteur_nom', '=', 's.libelle')
    ->select(
        's.libelle as secteur_nom',
        DB::raw('SUM(t.idees_projets) as nb_idees'),
        DB::raw('SUM(t.nbre_emploi_cree) as emplois_crees')
    )
    ->groupBy('s.libelle')
    ->get();

$data['ip_details'] = $ip_details;

       // Financement Data - Mock data for now
   $fin_details = DB::table('stat_tde')
    ->selectRaw("
        CASE 
            WHEN montant_financement < 500000 THEN '0-500K XAF'
            WHEN montant_financement >= 500000 AND montant_financement < 1000000 THEN '500K-1M XAF'
            WHEN montant_financement >= 1000000 AND montant_financement < 2000000 THEN '1M-2M XAF'
            ELSE '2M+ XAF'
        END as tranche_montant,
        secteur_nom as secteur,
        SUM(nbre_emploi_cree) as emplois_crees,
        SUM(financements) as financements
    ")
    ->whereNotNull('montant_financement')
    ->groupBy('tranche_montant', 'secteur_nom')
    ->get();


$data['fin_data'] = [
    'total_emploi_crees' => $fin_details->sum('emplois_crees'),
    'total_financements' => $fin_details->count('financements'),
    'rendement' => $fin_details->sum('emplois_crees') > 0 ? round(($fin_details->count('financements') / $fin_details->sum('emplois_crees')) * 100, 2) : 0
];

$data['fin_details'] = $fin_details;


return $data;
  }

public function index()
{
    $secteurs = secteur::all();
    $annees = annee::all();
    $metiers = metier::all();
    $qualifications = qualification::all();
    $trimestres = trimestre::all();
    
    $userDirection = Auth::user()->Direction->code;
    $userDirectionId = Auth::user()->Direction->id;
    $data = [];
    $currentYear = date('Y');

   $year = annee::where('libelle', $currentYear)->first();
   $year = $year->id;

    if ($userDirection == 'DE') {
        // Formation Qualifiante Data
        $fq_stats = stat_formation_qual::select(
            DB::raw('SUM(total_formes) as total_formes'),
            DB::raw('SUM(total_inseres) as total_inseres'),
            DB::raw('COUNT(DISTINCT qualification_nom) as nb_qualifications'),
            DB::raw('COUNT(DISTINCT secteur.libelle) as nb_secteurs')
        )
        ->join('qualification', 'stat_form_qual.qualification_nom', '=', 'qualification.libelle')
        ->join('metier', 'qualification.metier_id', '=', 'metier.id')
        ->join('secteur', 'metier.secteur_id', '=', 'secteur.id')
        ->where('annee', $currentYear)
        ->first();
        
        $data['fq_data'] = [
            'total_formes' => $fq_stats->total_formes ?? 0,
            'taux_insertion' => $fq_stats->total_formes > 0 ? 
                round(($fq_stats->total_inseres / $fq_stats->total_formes) * 100) : 0,
            'nb_secteurs' => $fq_stats->nb_secteurs ?? 0
        ];
        
        $data['fq_details'] = stat_formation_qual::select(
            'secteur.libelle as secteur_nom',
            DB::raw('SUM(total_formes) as total_formation'),
            DB::raw('SUM(total_inseres) as total_insertion')
        )
        ->join('qualification', 'stat_form_qual.qualification_nom', '=', 'qualification.libelle')
       ->join('metier', 'qualification.metier_id', '=', 'metier.id')
       ->join('secteur', 'metier.secteur_id', '=', 'secteur.id')
       ->where('annee', $currentYear)
       ->groupBy('secteur.libelle')
       ->limit(10)
       ->get();

       // Formation Continue Data - FIXED
       $fc_stats = statFormContinue::select(
           DB::raw('COUNT(DISTINCT entreprises) AS nb_entreprises'),
           DB::raw('SUM(total_developes) as total_participants'),
           DB::raw('SUM(total_prevus) as total_prevus')
       )->first();
       
       $data['fc_data'] = [
           'total_participants' => $fc_stats->total_participants ?? 0,
           'taux' => $fc_stats->nb_entreprises > 0 ? 
               round($fc_stats->total_participants / $fc_stats->nb_entreprises, 2) : 0,
           'entreprises' => $fc_stats->nb_entreprises ?? 0
       ];
       
       $data['fc_details'] = statFormContinue::select(
           'qualification_nom',
           DB::raw('SUM(total_developes) as total_participants'),
           DB::raw('SUM(total_prevus) as total_prevus')
       )
       ->groupBy('qualification_nom')
       ->limit(10)
       ->get();

       // Programme Emploi Diplômé Data - FIXED
       $ped_stats = statPED::select(
           DB::raw('SUM(placement_prevus) as total_placement_prevus'),
           DB::raw('SUM(placements) as total_placements')
       )->first();
       
       $data['ped_data'] = [
           'total_placements' => $ped_stats->total_placements ?? 0,
           'taux_reussite' => $ped_stats->total_placement_prevus > 0 ? 
               round(($ped_stats->total_placements / $ped_stats->total_placement_prevus) * 100) : 0
       ];
       
       $data['ped_details'] = statPED::select(
           'departement',
           DB::raw('SUM(placements) as total_placements')
       )
       ->groupBy('departement')
       ->limit(10)
       ->get();
   }
   
   if ($userDirection == 'DA') {
       // Apprentissage Data
       $am_stats = statApprentissage::select(
           DB::raw('SUM(formations) as total_apprentis'),
           DB::raw('SUM(insertions) as total_inseres'),
           DB::raw('COUNT(DISTINCT secteur_nom) as nb_secteurs'),
           DB::raw('COUNT(DISTINCT qualification_nom) as nb_metiers')
       )->first();
       
       $data['am_data'] = [
           'total_apprentis' => $am_stats->total_apprentis ?? 0,
           'nb_metiers' => $am_stats->nb_metiers ?? 0,
           'taux_reussite' => $am_stats->total_apprentis > 0 ? 
               round(($am_stats->total_inseres / $am_stats->total_apprentis) * 100) : 0
       ];
       
       $data['am_details'] = statApprentissage::leftJoin('qualification', 'stat_apprentissage.qualification_nom', '=', 'qualification.libelle')
           ->join('metier', 'qualification.metier_id', '=', 'metier.id')
           ->join('secteur', 'metier.secteur_id', '=', 'secteur.id')
           ->select(
               'qualification.libelle as qualification_nom',
               DB::raw('SUM(formations) as total_formation'),
               DB::raw('SUM(insertions) as total_insertion'),
               DB::raw('COUNT(DISTINCT secteur.id) as nb_maitres'),
               DB::raw('CASE WHEN SUM(formations) > 0 THEN ROUND((SUM(insertions) / SUM(formations)) * 100) ELSE 0 END as taux_reussite')
           )
           ->groupBy('qualification.libelle')
           ->limit(10)
           ->get();
   }
   
   if ($userDirection == 'DEAP') {
       // TDE Data
       $tde_stats = statTDE::select(
       
          DB::raw( 'SUM(nbre_emploi_cree) as emplois_crees'),
           DB::raw('SUM(formations) as total_formes'),
           DB::raw('SUM(idees_projets) as total_projets'),
           DB::raw('SUM(financements) as total_financement')
       )
       ->first();
       
       $data['tde_data'] = [
           'total_formes' => $tde_stats->total_formes ?? 0,
           'emplois_crees' => $tde_stats->emplois_crees ?? 0,
           'taux_creation' => $tde_stats->total_formes > 0 ? 
               round(($tde_stats->total_projets / $tde_stats->total_formes) * 100) : 0
       ];

$distinctSecteurs = statTDE::leftJoin('secteur', 'stat_tde.secteur_nom', '=', 'secteur.libelle')
    ->whereNotNull('stat_tde.formations')
    ->distinct('secteur.libelle')
    ->count('secteur.libelle');


$data['tde_details'] = statTDE::leftJoin('secteur', 'stat_tde.secteur_nom', '=', 'secteur.libelle')
    ->select(
        'secteur.libelle as secteur_nom',
        DB::raw('SUM(formations) as total_formation')
    )
     ->whereNotNull('stat_tde.formations')
    ->groupBy('secteur.libelle')
    ->limit(10)
    ->get();

$data['distinct_secteurs'] = $distinctSecteurs;


          
$distinctSecteurs2 = statTDE::leftJoin('secteur', 'stat_tde.secteur_nom', '=', 'secteur.libelle')
    ->whereNotNull('stat_tde.idees_projets')
    ->distinct('secteur.libelle')
    ->count('secteur.libelle');
       // Idées de Projets Data - FIXED
       $data['ip_data'] = [
           'total_idees' => $tde_stats->total_projets ?? 0,
           'nb_secteurs' => $distinctSecteurs2 
       ];
       
     $ip_details = DB::table('stat_tde as t')
    ->join('secteur as s', 't.secteur_nom', '=', 's.libelle')
    ->select(
        's.libelle as secteur_nom',
        DB::raw('SUM(t.idees_projets) as nb_idees'),
        DB::raw('SUM(t.nbre_emploi_cree) as emplois_crees')
    )
    ->groupBy('s.libelle')
    ->get();

$data['ip_details'] = $ip_details;

       // Financement Data - Mock data for now
   $fin_details = DB::table('stat_tde')
    ->selectRaw("
        CASE 
            WHEN montant_financement < 500000 THEN '0-500K XAF'
            WHEN montant_financement >= 500000 AND montant_financement < 1000000 THEN '500K-1M XAF'
            WHEN montant_financement >= 1000000 AND montant_financement < 2000000 THEN '1M-2M XAF'
            ELSE '2M+ XAF'
        END as tranche_montant,
        secteur_nom as secteur,
        SUM(nbre_emploi_cree) as emplois_crees,
        SUM(financements) as financements
    ")
    ->whereNotNull('montant_financement')
    ->groupBy('tranche_montant', 'secteur_nom')
    ->get();


$data['fin_data'] = [
    'total_emploi_crees' => $fin_details->sum('emplois_crees'),
    'total_financements' => $fin_details->count('financements'),
    'rendement' => $fin_details->sum('emplois_crees') > 0 ? round(($fin_details->count('financements') / $fin_details->sum('emplois_crees')) * 100, 2) : 0
];

$data['fin_details'] = $fin_details;
   }else if  ($userDirection == 'DG'){


    $data = $this->get();


     $activities = getActivityCompletionMetrics($userDirectionId, $year);

   return view("management.index", array_merge([
       "secteurs" => $secteurs, 
       "annees" => $annees, 
       "metiers" => $metiers, 
       "qualifications" => $qualifications, 
       "trimestres" => $trimestres,
       "activities" => $activities
   ], $data));

   }


     // Add Activity Completion Metrics for all directions
    $activities = getActivityCompletionMetrics($userDirectionId, $year);

   return view("dg.dashboard", array_merge([
       "secteurs" => $secteurs, 
       "annees" => $annees, 
       "metiers" => $metiers, 
       "qualifications" => $qualifications, 
       "trimestres" => $trimestres,
       "activities" => $activities
   ], $data));
}


public function programme(){

        $data = activites::all();
        $directions = Direction::all();
        $annees=Annee::all(); 
        return view("management.programme",["data" => $data, "directions" => $directions, "annees" => $annees]);
 
}

public function suivi(){

    
    $annees = annee::all();
    $trimestres = trimestre::all();
    $userDirection = Auth::user()->Direction->code;
    $userDirectionId = Auth::user()->Direction->id;
    $data = [];
    $currentYear = date('Y');

   $year = annee::where('libelle', $currentYear)->first();
   $year = $year->id;

   
    $activities = getActivityCompletionMetrics($userDirectionId, $year);

   return view("management.suivi", array_merge([
      
       "annees" => $annees, 
       "trimestres" => $trimestres,
       "activities" => $activities
   ]));


}


     public function planning()
    {

        $direction= Auth::user()->Direction->id;

        $data = activites::where("direction_id",$direction)->get();
        $directions = Direction::all();
        $annees=Annee::all(); 
        return view("dg.planning",["data" => $data, "directions" => $directions, "annees" => $annees]);
     }


      public function validation()
    {

    $secteurs = secteur::all();
    $annees = annee::all();
    $metiers = metier::all();
    $qualifications = qualification::all();
    $trimestres = trimestre::all();
   $currentYear = date('Y');
   $year = annee::where('libelle', $currentYear)->first();
   $year = $year->id; 
    $userDirection = Auth::user()->Direction->code;
   
 $data = [];
  if ($userDirection == 'DE') {

    $data['formations_qualifiantes'] = formationQual::whereHas('trimestre', function($q) use ($year) {
        $q->where('annee_id', $year);
    })->get();

    $data['formations_continues'] = formationContinue::whereHas('trimestre', function($q) use ($year) {
        $q->where('annee_id', $year);
    })->get();

    $data['peds'] = ped::whereHas('trimestre', function($q) use ($year) {
        $q->where('annee_id', $year);
    })->get();


    //count the data 

       $data['valide'] = formationQual::where('valide', 1)
        ->whereHas('trimestre', fn($q) => $q->where('annee_id', $year))->count()
        +
        formationContinue::where('valide', 1)
        ->whereHas('trimestre', fn($q) => $q->where('annee_id', $year))->count()
        +
        ped::where('valide', 1)
        ->whereHas('trimestre', fn($q) => $q->where('annee_id', $year))->count();

    // Total invalide
    $data['invalide'] = formationQual::where('valide', 0)
        ->whereHas('trimestre', fn($q) => $q->where('annee_id', $year))->count()
        +
        formationContinue::where('valide', 0)
        ->whereHas('trimestre', fn($q) => $q->where('annee_id', $year))->count()
        +
        ped::where('valide', 0)
        ->whereHas('trimestre', fn($q) => $q->where('annee_id', $year))->count();

} else if ($userDirection == 'DEAP') {

    $data['tde'] = TechniqueDeveloppementEntrepreunariat::where('type', 0)
        ->whereHas('trimestre', function($q) use ($year) {
            $q->where('annee_id', $year);
        })->get();

    $data['formations'] = TechniqueDeveloppementEntrepreunariat::where('type', 1)
        ->whereHas('trimestre', function($q) use ($year) {
            $q->where('annee_id', $year);
        })->get();

    $data['financements'] = TechniqueDeveloppementEntrepreunariat::where('type', 2)
        ->whereHas('trimestre', function($q) use ($year) {
            $q->where('annee_id', $year);
        })->get();


         $data['valide'] = TechniqueDeveloppementEntrepreunariat::where('valide', 1)
        ->whereHas('trimestre', fn($q) => $q->where('annee_id', $year))->count();

    // Total invalide
    $data['invalide'] = TechniqueDeveloppementEntrepreunariat::where('valide', 0)
        ->whereHas('trimestre', fn($q) => $q->where('annee_id', $year))->count();


} else if ($userDirection == 'DA') {

    $data['apprentissages'] = apprentissage::whereHas('trimestre', function($q) use ($year) {
        $q->where('annee_id', $year);
    })->get();


     $data['valide'] = apprentissage::where('valide', 1)
        ->whereHas('trimestre', fn($q) => $q->where('annee_id', $year))->count();

    // Total invalide
    $data['invalide'] = apprentissage::where('valide', 0)
        ->whereHas('trimestre', fn($q) => $q->where('annee_id', $year))->count();
}


     return view("dg.validation",["data" => $data, "trimestres" => $trimestres, "annees" => $annees]);
    
    }


    public function rapport(){
        
        $trimestres = trimestre::all();
        $annees=Annee::all(); 
        return view("dg.rapport",["trimestres" => $trimestres,"annees" => $annees]);
    

    }


     public function management(){
        
        $trimestres = trimestre::all();
        $annees=Annee::all(); 
        return view("dg.rapport",["trimestres" => $trimestres,"annees" => $annees]);
    

    }


    public function formationQual()
    {
        $secteurs = secteur::all();
$annees = annee::all();
$metiers = metier::all();
$qualifications = qualification::all();
$trimestres = trimestre::select("libelle")->distinct()->get();

$data = stat_formation_qual::select(
        "trimestre_id",
        "trimestre_numero",
        "annee",
        "secteur_nom",
        "qualification_nom",
        DB::raw('SUM(total_formes) as total_formation'),
        DB::raw('SUM(total_inseres) as total_insertion'),
        DB::raw('SUM(total_decroches) as total_decrochage')
    )
    ->groupBy(
        "trimestre_id",
        "trimestre_numero",
        "annee",
        "secteur_nom",
        "qualification_nom"
    )
    ->get();

return view("dg.formQual", [
    "data" => $data,
    "secteurs" => $secteurs,
    "annees" => $annees,
    "metiers" => $metiers,
    "qualifications" => $qualifications,
    "trimestres" => $trimestres
]);
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

