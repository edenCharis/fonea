<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckDirection;
use App\Models\realisationPED;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;

Route::get('/', function () {
    return view('auth.login');
});



Route::match(['get','post'],'/register',[AuthController::class,'register'])->name("register");
Route::match(['get','post'],'/login',[AuthController::class,'login'])->name("login");
Route::get('/logout',[AuthController::class,'logout'])->name("logout");


Route::name("administrateur.")->middleware(CheckDirection::class.':DSIP' )->group(function () { 
    Route::get('administrateur', [AdminController::class,'index'])->name("administrateur")->middleware("auth");
    Route::get('annee', [AdminController::class,'annee'])->name("annee")->middleware("auth");
    Route::get('trimestre', [AdminController::class,'trimestre'])->name("trimestre")->middleware("auth");
    Route::get('secteur', [AdminController::class,'secteur'])->name("secteur")->middleware("auth");
    Route::get('metier', [AdminController::class,'metier'])->name("metier")->middleware("auth");
    Route::get('competence', [AdminController::class,'competence'])->name("competence")->middleware("auth");
    Route::get('qualification', [AdminController::class,'qualification'])->name("qualification")->middleware("auth");
    Route::get('directions', [AdminController::class,'direction'])->name("direction")->middleware("auth");
  
  });



  

Route::name("autre.")->middleware("auth")->group(function () { 
    Route::get('autre', [AutreController::class,'index'])->name("autre")->middleware("auth");
    Route::get('formationQualifiante', [AutreController::class,'formationQualifiante'])->name("formationQualifiante")->middleware(CheckDirection::class.':DE,DSIP',"auth");
    Route::get('formationContinue', [AutreController::class,'formationContinue'])->name("formationContinue")->middleware(CheckDirection::class.':DE,DSIP',"auth");
    Route::get('ped', [AutreController::class,'ped'])->name("ped")->middleware(CheckDirection::class.':DE,DSIP',"auth");
    Route::get('compte', [AutreController::class,'compte'])->name("compte")->middleware(CheckDirection::class.':DE,DSIP,DEAP,DA',"auth");
   
    Route::get('tde', [AutreController::class,'tde'])->name("tde")->middleware(CheckDirection::class.':DEAP,DSIP',"auth");
    Route::get('apprentissage', [AutreController::class,'apprentissage'])->name("apprentissage")->middleware(CheckDirection::class.':DA,DSIP');
    Route::get('formation', [AutreController::class,'formation'])->name("formation")->middleware(CheckDirection::class.':DEAP,DSIP');
    Route::get('realisation', [AutreController::class,'realisation'])->name("realisation")->middleware(CheckDirection::class.':DEAP,DSIP');
    Route::get('financement', [AutreController::class,'financement'])->name("financement")->middleware(CheckDirection::class.':DEAP,DSIP');
    Route::get('detailsfq', [ AutreController::class,'detailsfq'])->name("detailsfq")->middleware(CheckDirection::class.':DE,DSIP');
  });

  

Route::middleware("auth")->group(function () {

  //Traitement pour l'administrateur

  Route::resource('traitementAnnee', AnneeController::class)->middleware(CheckDirection::class.':DSIP');
  Route::resource('traitementTrimestre', TrimestreController::class)->middleware(CheckDirection::class.':DSIP');
  Route::resource('traitementSecteur', SecteurController::class)->middleware(CheckDirection::class.':DSIP');
  Route::resource('traitementMetier', MetierController::class)->middleware(CheckDirection::class.':DSIP');
  Route::resource('traitementCompetence', competenceController::class)->middleware(CheckDirection::class.':DSIP');
  Route::resource('traitementQualification', qualificationController::class)->middleware(CheckDirection::class.':DSIP');
  Route::resource('utilisateur', utilisateurController::class)->middleware(CheckDirection::class.':DSIP');
  Route::resource('direction', directionController::class)->middleware(CheckDirection::class.':DSIP');


  // Traitement pour les autres rôles
  Route::resource('formation_qualifiante', formationQualController::class)->middleware(CheckDirection::class.':DE,DSIP');
  Route::resource('detailsFQ', detailsFQController::class)->middleware(CheckDirection::class.':DE,DSIP');
  Route::resource('realisationFQ',realisationFQController::class)->middleware(CheckDirection::class.':DE,DSIP');
  Route::resource('formation_continue', formationContinueController::class)->middleware(CheckDirection::class.':DE,DSIP');
  Route::resource('detailsFC', detailsFCcontroller::class)->middleware(CheckDirection::class.':DE,DSIP');
  Route::resource('realisationFC', realisationFCcontroller::class)->middleware(CheckDirection::class.':DE,DSIP');
  Route::resource('programme_emploi_diplome', pedController::class)->middleware(CheckDirection::class.':DE,DSIP');
  Route::resource('detailsPED', detailsPEDController::class)->middleware(CheckDirection::class.':DE,DSIP');
  Route::resource('realisationPED', realisationPEDController::class)->middleware(CheckDirection::class.':DE,DSIP');
  
  Route::resource('TDE', TDEController::class)->middleware(CheckDirection::class.':DEAP,DSIP');
  Route::resource('detailsTDE', detailsTDEController::class)->middleware(CheckDirection::class.':DEAP,DSIP');
  Route::resource('realisationTDE', realisationTDEController::class)->middleware(CheckDirection::class.':DEAP,DSIP');
  Route::resource('apprentissageMetier', apprentissageController::class)->middleware(CheckDirection::class.':DA,DSIP');
  Route::resource('detailsApprentissage', detailsApprentissageController::class)->middleware(CheckDirection::class.':DA,DSIP');
  Route::resource('realisationApprentissage', realisationApprentissageController::class)->middleware(CheckDirection::class.':DA,DSIP');
 

  Route::resource('activites', activitesController::class)->middleware(CheckDirection::class.':DCB');


});


  Route::name( "dg.")->middleware("auth")->group(function () { 

    Route::get('dg', [chartController::class,'index'])->name("dg")->middleware(CheckDirection::class.':DG,DSIP');
    Route::get('tab1', [dgController::class,'formationQual'])->name("tab1")->middleware(CheckDirection::class.':DSIP,DG,DE');
    Route::get('tab2', [dgController::class,'formationContinue'])->name("tab2")->middleware(CheckDirection::class.':DSIP,DG');
    Route::get('tab3', [dgController::class,'tde'])->name("tab3")->middleware(CheckDirection::class.':DSIP,DEAP,DG');
    Route::get('tab4', [dgController::class,'apprentissage'])->name("apprentissage")->middleware(CheckDirection::class.':DSIP,DG,DA');
    Route::get('tab5', [dgController::class,'ped'])->name("tab5")->middleware(CheckDirection::class.':DSIP,DG,DE');
    Route::post('fq.recherche.annee', [chartController::class,'fq_recherche_annee'])->name("fq.recherche.annee")->middleware(CheckDirection::class.':DSIP,DG,DE');
    Route::get('fq.stat.insertion', [chartController::class,'fq_stat_insertion'])->name("fq.stat.insertion")->middleware(CheckDirection::class.':DSIP,DG,DE');
    Route::get('fq.stat.insertion', [chartController::class,'fq_stat_insertion'])->name("fq.stat.insertion")->middleware(CheckDirection::class.':DSIP,DG,DE');
    Route::get('fq.stat.secteur', [chartController::class,'fq_stat_secteur'])->name("fq.stat.secteur")->middleware(CheckDirection::class.':DSIP,DG,DE');

    Route::post('fq.insertion_formation.recherche', [chartController::class,'fq_insertion_formation_recherche'])->name("fq.insertion_formation.recherche")->middleware(CheckDirection::class.':DSIP,DG,DE');
  
   
  });
  
  Route::name( "controle.")->middleware("auth")->group(function () { 
    Route::get('controle', [controleController::class,'index'])->name("controle")->middleware(CheckDirection::class.':DCB');
    Route::get('editer', [controleController::class,'editer'])->name("editer")->middleware(CheckDirection::class.':DCB');
    Route::get('activite', [controleController::class,'activite'])->name("activite")->middleware(CheckDirection::class.':DCB');
 
  });