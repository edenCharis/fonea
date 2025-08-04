<?php

namespace App\Http\Controllers;

use App\Models\metier;

use Illuminate\Http\Request;

class metierController extends Controller
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
            'name' => 'required|string|max:255',
            'secteur_id' => 'required|exists:secteur,id',
        ]);

        try {
            Metier::create([
                'libelle' => $request->name,
                'secteur_id' => $request->secteur_id,
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

      $metier = metier::findOrFail($id);
        
      $request->validate([
            'libelle' => 'required|unique:metier,libelle,',
            'secteur_id' => 'required|exists:secteur,id',
        ]);

      $metier->update([
            'libelle' => $request->libelle,
            'secteur_id' => $request->secteur_id,
        ]);

        return redirect()->back()->with('success', 'métier mise à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $record = metier::find($id);
        if (!$record) {
            return redirect()->back()->with('error', 'Ligne non trouvée.');
        }

        // Delete the record
        $record->delete();

        return redirect()->back()->with('success', 'Ligne supprimée avec succès.');
    }
}
