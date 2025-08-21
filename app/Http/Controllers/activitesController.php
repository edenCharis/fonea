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
   
    // Get authenticated user
    $user = Auth::user();
    if (!$user) {
        return redirect()->back()
            ->with('status', 'error')
            ->with('message', 'Utilisateur non authentifié.');
    }

    try {
        // Create new activity
      activites::create([ 
            'libelle' => $request->libelle,
            'annee_id' => $request->annee_id,
            'direction_id' => $request->direction,
            'user_id' => $user->id,
            'mtb' => $request->mtb
        ]);

        // Log the action
        Log::channel('user_actions')->info('Création d\'activité', [
            'user_id' => $user->id,
            'user_name' => $user->name ?? $user->email, // Added user identification
            'action' => 'Create Activity',
             'data' => $request->only(['libelle', 'annee_id', 'direction', 'mtb']) // Only log relevant data
        ]);

        return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Activité créée avec succès!');

    } catch (\Illuminate\Database\QueryException $e) {
        // Handle database-specific errors
        Log::channel('user_actions')->error('Erreur de création d\'activité', [
            'user_id' => $user->id,
            'error' => $e->getMessage(),
            'data' => $request->only(['libelle', 'annee_id', 'direction', 'mtb'])
        ]);

        return redirect()->back()
            ->with('status', 'error')
            ->with('message', $e->getMessage());

    } catch (\Exception $e) {
        // Handle general errors
        Log::channel('user_actions')->error('Erreur générale', [
            'user_id' => $user->id,
            'error' => $e->getMessage(),
            'data' => $request->only(['libelle', 'annee_id', 'direction', 'mtb'])
        ]);

        return redirect()->back()
            ->with('status', 'error')
            ->with('message', $e->getMessage());
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

        $activite = activites::findOrFail($id);
    
      try{
        $activite->update([
            'direction' => $request->direction_id,
            'annee_id' => $request->annee_id,
            'libelle' => $request->libelle,
            'mtb' => $request->mtb,
            'taux' => $request->taux,
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
