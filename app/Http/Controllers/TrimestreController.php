<?php


namespace App\Http\Controllers;


use App\Models\Trimestre;

use Illuminate\Http\Request;

class TrimestreController extends Controller
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
        $request->validate([
            'name' => 'required',
            'annee_id' =>  'required|exists:annee,id'
        ]);

        Trimestre::create([
            'annee_id' => $request->annee_id,
            'libelle'=> $request->input("name")
        ]);

        return redirect()->back()->with('success', 'TRimestre Crée avec succès!');
   
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
           $trimestre = trimestre::findOrFail($id);
        
      $request->validate([
            'libelle' => 'required|unique:trimestre,libelle,',
            'annee_id' => 'required|exists:annee,id',
        ]);

      $trimestre->update([
            'libelle' => $request->libelle,
            'metier_id' => $request->metier_id,
        ]);

        return redirect()->back()->with('success', 'trimestre mise à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $trimestre = trimestre::findOrFail($id);
       $trimestre->delete();
    
        return redirect()->back()->with('status', 'success')->with('message', 'trimestre supprimé avec succès!');
    }
}
