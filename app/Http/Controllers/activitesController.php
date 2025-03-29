<?php

namespace App\Http\Controllers;

use App\Models\activites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class activitesController extends Controller
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
    public function store(Request $request)
    {
        //

        $request->validate([
            'libelle' => 'required|string|max:255',
            'annee_id' => 'required|exists:annees,id',
            'direction_id' => 'required|exists:direction,code',
            'mtb' => 'required'

        ]);
        $user = $request->user();
        try {

            activites::create([
                'libelle' => $request->libelle,
                'annee_id' => $request->annee_id,
                'direction'=> $request->direction_id,
                'user_id'=> $user->id,
                'statut'=> 'En attente',
                'mtb' => $request->mtb
            ]);
            Log::channel('user_actions')->info('Création', [
                'user_id' => Auth::id(),
                'action'  => 'Create Activites',
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
            'direction' => 'required|exists:direction,code',
            'annee_id' => 'required|exists:annees,id',
            'libelle' => 'required|string|max:255',
            'mtb' => 'required|numeric|min:0',
            
        ]);
    
       
        $activite = activites::findOrFail($id);
    
      try{
        $activite->update([
            'direction' => $request->direction_id,
            'annee_id' => $request->annee_id,
            'libelle' => $request->libelle,
            'mtb' => $request->mtb,
            'taux_realisation' => $request->taux_realisation,
            'statut' => $request->statut
        ]);
    

        Log::channel('user_actions')->info('Update', [
            'user_id' => Auth::id(),
            'action'  => 'Update Activites',
            'data'    => $request->all()
        ]);

        return redirect()->back()->with('status', 'success')->with('message', 'opération effectuée avec succès!');
    } catch (\Exception $e) {
        return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
    }
       



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //


        $record = activites::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Ligne non trouvée.');
        }
        
        $record->delete();

        Log::channel('user_actions')->info('Suppression', [
            'user_id' => Auth::id(),
            'action'  => 'DELETE Activités',
            'data'    => $record
        ]);

        return redirect()->back()->with('success', 'Ligne supprimée avec succès.');
    
    }
}
