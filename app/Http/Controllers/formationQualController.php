<?php

namespace App\Http\Controllers;


use App\Models\formationQual;
use App\Models\journalActivites;
use App\Models\activites;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Log;
use Carbon\carbon;

class formationQualController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     use AuthorizesRequests;

  

     private $sequenceFile = 'sequence.txt';
    public function index()
    {
        //
    }

    


 
    public function generateSequentialCode()
    {
        
        $lastCode = DB::table('formation_qual') 
        ->orderBy('id', 'desc') 
        ->value('numero_identification'); 

    
    $lastSequence = $lastCode ? (int)substr($lastCode, 8) : 0;

    $nextSequence = $lastSequence + 1;

    $uniqueCode = 'FORMQUAL' . str_pad($nextSequence, 4, '0', STR_PAD_LEFT);

    return $uniqueCode;
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
    public function store(Request $request)
    {
        //

      
        
            $request->validate([
                'name' => 'required|string|max:255',
                'trimestre_id' => 'required|exists:trimestre,id',
            ]);

            $user = $request->user();

            try {



                $vrai = DB::table('activites')
                       ->whereRaw('LOWER(libelle) = ?', [strtolower($request->name)])
                       ->exists();


               $util = User::select("direction")->whereRaw("id=?", $user->id)->firstOrFail();


    if($vrai){

        journalActivites::create([
            "libelle" => $request->name,
            "trimestre_id" =>$request->trimestre_id,
            "statut" => "Budgetisé",
            "type" => "Formation qualifiante",
            "direction" => $util->direction,
            "user_id" => $user->id
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
            "type" => "Formation qualifiante",
            "direction" => $util->direction,
            "user_id" => $user->id
        ]);
    }

                formationQual::create([
                    'intitule' => $request->name,
                    'trimestre_id' => $request->trimestre_id,
                    'numero_identification'=> $this->generateSequentialCode(),
                    'user_id'=> $user->id,
                ]);
                Log::channel('user_actions')->info('Création', [
                    'user_id' => Auth::id(),
                    'action'  => 'Create FORM QUAL',
                    'data'    => $request->all()
                ]);
     
                return redirect()->back()->with('status', 'succes')->with('message', 'opération effectuée avec succès!');
            } catch (\Exception $e) {
                return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
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
        $request->validate([
            'intitule' => 'required|string|max:255',
            'trimestre_id' => 'required|exists:trimestre,id',
            
        ]);
        try{
            $record = formationQual::find($id);
            if (!$record) {
                return redirect()->back()->with('error', 'Ligne non trouvée.');
            }
    
        
            $record->Update(["intitule" => $request->input("intitule"),
                                "trimestre_id" => $request->input("trimestre_id")]);


                                Log::channel('user_actions')->info('Mis à Jour', [
                                    'user_id' => Auth::id(),
                                    'action'  => 'UPDATE FORM QUAL',
                                    'data'    => $request->all()
                                ]);
    
            return redirect()->back()->with('success', 'Ligne supprimée avec succès.');
    
        }catch (\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }

  }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,formationQual $formationQual)
    {
        //
       
        $record = formationQual::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Ligne non trouvée.');
        }

        // Delete the record
        $record->delete();

        Log::channel('user_actions')->info('Suppression', [
            'user_id' => Auth::id(),
            'action'  => 'DELETE FORM QUAL',
            'data'    => $record
        ]);

        return redirect()->back()->with('success', 'Ligne supprimée avec succès.');
    }
    
}
