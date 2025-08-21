<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Models\ped;

use Illuminate\Support\Facades\Log;

class pedController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function validate(Request $request, $id)
    {
        // Find the formation
        $ped = ped::find($id);

        if (!$ped) {
           return redirect()->back()->with('error', 'Record not found.');
    
     }
        

        
        $ped->valide = 1; // or 1 depending on your DB
        $ped->save();

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

    public function generateSequentialCode()
    {
        
        $lastCode = DB::table('ped') 
        ->orderBy('id', 'desc') 
        ->value('numero_identification'); 

    
       $lastSequence = $lastCode ? (int)substr($lastCode, 4) : 0;

       $nextSequence = $lastSequence + 1;

       $uniqueCode = 'PED' . str_pad($nextSequence, 4, '0', STR_PAD_LEFT);

           return $uniqueCode;
    }
  
    public function store(Request $request)
    {
        //
        $request->validate([
            'departement' => 'required|string|max:255',
            'offre' => 'required|string|max:255',
            'entreprise' => 'required|string|max:255',
            'secteur_id' => 'required|exists:secteur,id',
            'trimestre_id' => 'required|exists:trimestre,id',
        ]);

        $user = $request->user();
        try {

            ped::create([
                'departement' => $request->departement,
                'offre' => $request->offre,
                'entreprise' => $request->entreprise,
                'secteur_id' => $request->secteur_id,
                'trimestre_id' => $request->trimestre_id,
                'numero_identification'=> $this->generateSequentialCode(),
                'user_id'=> $user->id,
            ]);


            Log::channel('user_actions')->info('Create', [
                'user_id' => Auth::id(),
                'action'  => 'Create PED',
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

        $request->validate([
            'departement' => 'required|string|max:255',
            'offre' => 'required|string|max:255',
            'entreprise' => 'required|string|max:255',
            'secteur_id' => 'required|exists:secteur,id',
            'trimestre_id' => 'required|exists:trimestre,id',
        ]);
        try{
            $record = ped::find($id);

            if (!$record) {
                return redirect()->back()->with('error', 'Ligne non trouvée.');
            }
    
        

            $record->update([
                'departement' => $request->departement,
                'offre' => $request->departement,
                'entreprise' => $request->departement,
                'secteur_id' => $request->secteur_id,
                'trimestre_id' => $request->trimestre_id
            ]);

           
            Log::channel('user_actions')->info('UPDATE', [
                'user_id' => Auth::id(),
                'action'  => 'Update PED',
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
    public function destroy(string $id)
    {
      

        $record = ped::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Ligne non trouvée.');
        }



      
        $record->delete();

        Log::channel('user_actions')->info('DELETE', [
            'user_id' => Auth::id(),
            'action'  => 'DELETE PED',
            'data'    => $record
        ]);

        return redirect()->back()->with('success', 'Ligne supprimée avec succès.');
    }
}
