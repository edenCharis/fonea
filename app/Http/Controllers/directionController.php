<?php

namespace App\Http\Controllers;

use App\Models\Direction;

use Illuminate\Http\Request;

class directionController extends Controller
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
            'code' => 'required|unique:direction,code',
            'libelle' => 'required',
        ]);

        Direction::create(
            [ "libelle" => $request->input("libelle"),
            "code" => $request->input("code")]
        );

        return redirect()->back()->with('success', 'Direction Crée avec succès!');
    
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

         $direction = direction::findOrFail($id);
        
        $request->validate([
            'libelle' => 'required|unique:direction,libelle,' . $id,
            'code' => 'required',
        ]);

        $direction->update([
            'libelle' => $request->libelle,
            'code' => $request->code,
        ]);

        return redirect()->back()->with('success', 'Direction mise à jour avec succès!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $record = Direction::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Ligne non trouvée.');
        }

        // Delete the record
        $record->delete();

        return redirect()->back()->with('success', 'Ligne supprimée avec succès.');
    
    }
}
