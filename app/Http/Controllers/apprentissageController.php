<?php

namespace App\Http\Controllers;

use App\Models\apprentissage;
use App\Models\activites;
use App\Models\journalActivites;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class apprentissageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
         
         $lastCode = DB::table('apprentissage') 
         ->orderBy('id', 'desc') 
         ->value('numero_identification'); 
 
     
     $lastSequence = $lastCode ? (int)substr($lastCode, 14) : 0;
 
     $nextSequence = $lastSequence + 1;
 
     $uniqueCode = 'APPRENTISSAGE' . str_pad($nextSequence, 4, '0', STR_PAD_LEFT);
 
     return $uniqueCode;
     }
    public function store(Request $request)
    {
        //

        $request->validate([
            'name' => 'required|string|max:255',
            'trimestre_id' => 'required|exists:trimestre,id'
        ]);

       
        try {

            $vrai = DB::table('activites')
            ->whereRaw('LOWER(libelle) = ?', [strtolower($request->name)])
            ->exists();


    $util = User::select("direction")->whereRaw("id=?", Auth::id())->firstOrFail();


if($vrai){

journalActivites::create([
 "libelle" => $request->name,
 "trimestre_id" =>$request->trimestre_id,
 "statut" => "Budgetisé",
 "type" => "Apprentissage",
 "direction" => $util->direction,
 "user_id" => Auth::id()
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
 "type" => "Apprentissage",
 "direction" => $util->direction,
 "user_id" =>Auth::id()
]);
}

            
            apprentissage::create([
                'intitule' => $request->name,
                'trimestre_id' => $request->trimestre_id,
                'user_id' => Auth::id(),
                'numero_identification'=> $this->generateSequentialCode()
            ]);

            Log::channel('user_actions')->info('creation', [
                'user_id' => Auth::id(),
                'action'  => 'CREATE apprentissage',
                'data'    => $request->all()
            ]);

            return redirect()->back()->with('status', 'success')->with('message', 'opération effectuée avec succès!');
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
