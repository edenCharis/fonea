<?php

namespace App\Http\Controllers;

use App\Models\detailsFQ;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class detailsFQController extends Controller
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
            'ndai' => 'required|min:1',
            'ndaf' => 'required|min:1',
            'formation_qual_id' => 'required|exists:formation_qual,id',
            'qualification_id' => 'required|exists:qualification,id',
            'secteur_id' => 'required|exists:secteur,id' 
        ]);
        try {

            detailsFQ::create([
                'formation_qual_id' => $request->formation_qual_id,
                'qualification_id' => $request->qualification_id,
                'secteur_id' => $request->secteur_id,
                'ndai'=> $request->input("ndai"),
                'ndaf' => $request->input("ndaf"),
                'poste' => $request->input("poste")
            ]);

            Log::channel('user_actions')->info('Create', [
                'user_id' => Auth::id(),
                'action'  => 'Create DetailsFQ',
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
    public function show( Request $request,string $id)
    {
        //

            
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id)
    {
        //
        $request->validate([
            'ndai' => 'required|min:1',
            'ndaf' => 'required|min:1',
            'formation_qual_id' => 'required|exists:formation_qual,id',
            'qualification_id' => 'required|exists:qualification,id',
            'secteur_id' => 'required|exists:secteur,id',
        ]);
    
        try {
            $details = detailsFQ::findOrFail($id);
    
            $details->update([
                'formation_qual_id' => $request->formation_qual_id,
                'qualification_id' => $request->qualification_id,
                'secteur_id' => $request->secteur_id,
                'ndai' => $request->input("ndai"),
                'ndaf' => $request->input("ndaf"),
            ]);
    
            Log::channel('user_actions')->info('Update', [
                'user_id' => Auth::id(),
                'action'  => 'Update DetailsFQ',
                'data'    => $request->all(),
            ]);
    
            return redirect()->route('detailsFQ.index')->with('message', 'Modification effectuée avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
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
