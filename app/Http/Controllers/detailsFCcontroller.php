<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\detailsFC;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class detailsFCcontroller extends Controller
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
            
            'formation_continue_id' => 'required|exists:formation_continue,id',
         
            'competence_id' => 'required|exists:secteur,id',
            
        ]);
        try {

            detailsFC::create([
                'formation_continue_id' => $request->formation_continue_id,
                'competence_id' => $request->competence_id,
            ]);

            Log::channel('user_actions')->info('creation', [
                'user_id' => Auth::id(),
                'action'  => 'CREATE detailsFC',
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
