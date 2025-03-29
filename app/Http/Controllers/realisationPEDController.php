<?php

namespace App\Http\Controllers;

use App\Models\realisationPED;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class realisationPEDController extends Controller
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
            'npa' => 'required',
            'nbre_intra_entre' => 'required',
            'nbre_inter_entre' => 'required',
            'ped_id' => 'required|exists:ped,id'
        ]);
        try {
            realisationPED::create([
                'ped_id' => $request->ped_id,
                'npa'=> $request->input("npa"),
                'nbre_intra_entre' => $request->input("nbre_intra_entre"),
                'nbre_inter_entre' => $request->input("nbre_inter_entre")
            ]);


            Log::channel('user_actions')->info('Create', [
                'user_id' => Auth::id(),
                'action'  => 'Create Realisation PED',
                'data'    => $request->all()
            ]);
            return redirect()
            ->back()
            ->with('message', 'opération effectuée avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message',$e->getMessage());
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
