<?php

namespace App\Http\Controllers;

use App\models\formationContinue;

use App\models\User;
use App\models\journalActivites;
use App\models\activites;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;

class formationContinueController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    
public function validate(Request $request, $id)
    {
        // Find the formation
        $f = formationContinue::find($id);

        if (!$f) {
           return redirect()->back()->with('error', 'Record not found.');
    
     }
        

        
        $f->valide = 1; // or 1 depending on your DB
        $f->save();

        return redirect()->back()->with('success', 'Record deleted successfully.');
        }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

     public function generateSequentialCode()
     {
         
         $lastCode = DB::table('formation_continue') 
         ->orderBy('id', 'desc') 
         ->value('numero_identification'); 
 
     
          $lastSequence = $lastCode ? (int)substr($lastCode, 12) : 0;
 
          $nextSequence = $lastSequence + 1;
 
          $uniqueCode = 'FORMCONTINUE' . str_pad($nextSequence, 4, '0', STR_PAD_LEFT);
 
          return $uniqueCode;
     }
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'trimestre_id' => 'required|exists:trimestre,id',
        ]);
        try {


            $vrai = DB::table('activites')
            ->whereRaw('LOWER(libelle) = ?', [strtolower($request->name)])
            ->exists();


            $util = User::select("direction")->whereRaw("id=?", Auth::id())->firstOrFail();


if($vrai){

journalActivites::create(attributes: [
 "libelle" => $request->name,
 "trimestre_id" =>$request->trimestre_id,
 "statut" => "Budgetisé",
 "type" => "Formation continue",
 "direction" => $util->direction,
 "user_id" => Auth::id(),
 "date_enregistrement" => Carbon::now(),
]);

$record = activites::select("id")
->whereRaw('LOWER(libelle) = ?', [strtolower($request->name)])
->firstOrFail();

$activite = activites::findOrFail($record->id);


$activite->update([
   'statut' => "Executé"
]);

}else{
journalActivites::create([
 "libelle" => $request->name,
 "trimestre_id" =>$request->trimestre_id,
 "statut" => "Non Budgetisé",
 "type" => "Formation continue",
 "direction" => $util->direction,
 "user_id" =>Auth::id(),
 "date_enregistrement" => Carbon::now()
]);
}


            formationContinue::create([
                'intitule' => $request->name,
                'trimestre_id' => $request->trimestre_id,
                'secteur_id' => $request->secteur_id,
                'ned' => $request->ned,
                'user_id'=>Auth::id(),
                'numero_identification'=> $this->generateSequentialCode()
            ]);
            Log::channel('user_actions')->info('Création', [
                'user_id' => Auth::id(),
                'action'  => 'Create Form Cont',
                'data'    => $request->all()
            ]);
            return redirect()->back()->with('status', 'success')->with('message', 'opération effectuée avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $record = formationContinue::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Ligne non trouvée.');
        }
        // Delete the record
        $record->delete();

        Log::channel('user_actions')->info('Suppression', [
            'user_id' => Auth::id(),
            'action'  => 'DELETE FORM CONT',
            'data'    => $record
        ]);

        return redirect()->back()->with( 'success', 'Ligne supprimée avec succès.');
    }
    
    
}
