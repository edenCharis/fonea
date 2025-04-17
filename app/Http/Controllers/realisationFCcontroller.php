<?php

namespace App\Http\Controllers;

use App\Models\realisationFC;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class realisationFCcontroller extends Controller
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
            'ned' => 'required|min:1',
          
            'formation_continue_id' => 'required|exists:formation_continue,id'
        ]);
        try {
            realisationFC::create([
                'formation_continue_id' => $request->formation_continue_id,
                'ned'=> $request->input("ned"),
                'nepc' => $request->input("nepc"),
                'entreprise' => $request->input("entreprise")
                'entreprise' => $request->input("entreprise")
            ]);

            Log::channel('user_actions')->info('Create', [
                'user_id' => Auth::id(),
                'action'  => 'Create realisation FC',
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
