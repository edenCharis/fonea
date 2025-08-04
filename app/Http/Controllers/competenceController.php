<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competences = Competence::with('qualification')->get();
        return view('competence', compact('competences'));
    }

    /**
     * Show the form for creating a new resource.
     */


    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|unique:competence,libelle',
            'qualification_id' => 'required|exists:qualification,id',
        ]);

        Competence::create([
            'libelle' => $request->libelle,
            'qualification_id' => $request->qualification_id,
        ]);

        return redirect()->back()->with('success', 'Competence créée avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $competence = Competence::with('qualification')->findOrFail($id);
        return view('competences.show', compact('competence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $competence = Competence::findOrFail($id);
        return view('competences.edit', compact('competence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $competence = Competence::findOrFail($id);
        
        $request->validate([
            'libelle' => 'required|unique:competence,libelle,' . $id,
            'qualification_id' => 'required|exists:qualification,id',
        ]);

        $competence->update([
            'libelle' => $request->libelle,
            'qualification_id' => $request->qualification_id,
        ]);

        return redirect()->back()->with('success', 'Competence mise à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $competence = Competence::findOrFail($id);
        $competence->delete();

        return redirect()->back()->with('success', 'Competence supprimée avec succès!');
    }
}