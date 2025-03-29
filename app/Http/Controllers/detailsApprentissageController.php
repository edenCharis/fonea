<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\detailsApprentissage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class detailsApprentissageController extends Controller
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

          //
          $request->validate([
            'ndai' => 'required|min:1',
            'ndaf' => 'required|min:1',
            'operateur_formation' => 'required',
            'apprentissage_id' => 'required|exists:apprentissage,id',
            'qualification_id' => 'required|exists:qualification,id',
            'secteur_id' => 'required|exists:secteur,id'
            
        ]);
        try {

            detailsApprentissage::create([
                'apprentissage_id' => $request->apprentissage_id,
                'qualification_id' => $request->qualification_id,
                'secteur_id' => $request->secteur_id,
                'ndai'=> $request->input("ndai"),
                'ndaf' => $request->input("ndaf"),
                'operateur_formation' => $request->input("ndaf")
            ]);

            Log::channel('user_actions')->info('creation', [
            'user_id' => Auth::id(),
            'action'  => 'CREATE detailsApprentissage',
            'data'    => $request->all()
        ]);

            return redirect()
            ->back()
            ->with('message', 'opération effectuée avec succès!');
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
