<?php

namespace App\Http\Controllers;
use App\Models\ods;

use Illuminate\Http\Request;

class odsController extends Controller
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
            'direction' => 'required|exists:direction,code',
          
        ]);

        try {
            ods::create([
                'libelle' => $request->name,
                'direction'=> $request->direction
              
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
        $ods = ods::findOrFail($id);
        $request->validate([
            'libelle' => 'required|unique:competence,libelle,' . $id,
            'name' => 'required|exists:direction,libelle',
        ]);
        $ods->update([
            'libelle' => $request->libelle,
            'direction' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Competence mise à jour avec succès!');
    }
    /**
     * Remove the specified resource from storage.
     */
     public function destroy(string $id)
    {
        $ods = ods::findOrFail($id);
        $ods->delete();

        return redirect()->back()->with('success', 'Competence supprimée avec succès!');
    }
}
