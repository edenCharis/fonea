<?php

namespace App\Http\Controllers;

use App\Models\secteur;

use Illuminate\Http\Request;

class SecteurController extends Controller
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
            'libelle' => 'required|unique:secteur,libelle',
        ]);

        Secteur::create($request->only('libelle'));

        return redirect()->back()->with('success', 'Secteur d\'activité Crée avec succès!');
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
         $request->validate([
        'libelle' => 'required|string|max:255|unique:secteur,libelle,' . $id,
    ]);

    $secteur = Secteur::findOrFail($id);
    $secteur->update([
        'libelle' => $request->libelle,
    ]);

    return redirect()->back()->with('status', 'success')->with('message', 'Secteur modifié avec succès!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $secteur = Secteur::findOrFail($id);
    $secteur->delete();
    
    return redirect()->back()->with('status', 'success')->with('message', 'Secteur supprimé avec succès!');

    }
}
