<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\TechniqueDeveloppementEntrepreunariat;
use App\models\activites;
use App\models\journalActivites;
use App\models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class TDEController extends Controller
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
        
        $lastCode = DB::table('tde') 
        ->orderBy('id', 'desc') 
        ->value('numero_identification'); 

    
         $lastSequence = $lastCode ? (int)substr($lastCode, 3) : 0;

         $nextSequence = $lastSequence + 1;

         $uniqueCode = 'TDE' . str_pad($nextSequence, 4, '0', STR_PAD_LEFT);

         return $uniqueCode;
    }
    public function store(Request $request)
    {
        //
        $request->validate([
            'type' => 'required',
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
 "type" => "Technique de developpement d'entrepreunariat",
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
 "type" => "Technique de developpement d'entrepreunariat",
 "direction" => $util->direction,
 "user_id" =>Auth::id()
]);
}



            
            TechniqueDeveloppementEntrepreunariat::create([
                'type' => $request->type,

                'intitule' => $request->name,
                'trimestre_id' => $request->trimestre_id,
                'user_id' => Auth::id(),
                'numero_identification'=> $this->generateSequentialCode()
            ]);

            Log::channel('user_actions')->info('Create', [
                'user_id' => Auth::id(),
                'action'  => 'Create  TDE',
                'data'    => $request->all()
            ]);

            return redirect()->back()->with('status', 'success')->with('message', 'opération effectuée avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Echec !');
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

        $record = TechniqueDeveloppementEntrepreunariat::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Record not found.');
        }
        
        $record->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }
    
}
