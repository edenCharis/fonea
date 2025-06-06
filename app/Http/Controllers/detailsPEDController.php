<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\detailsPED;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class detailsPEDController extends Controller
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
            'nc' => 'required|min:1',
            'npd' => 'required|min:1',
            'ped_id' => 'required|exists:ped,id',
            'qualification_id' => 'required|exists:qualification,id',
            'nip' => 'required|min:1'
            
        ]);
        try {

            detailsPED::create([
                'ped_id' => $request->ped_id,
                'qualification_id' => $request->qualification_id,
                'nc' => $request->nc,
                'poste' => $request->input("poste"),
                'nip'=> $request->input("nip"),
                'npd' => $request->input("npd"),
                'nce' => $request->input("nce")
            ]);

            Log::channel('user_actions')->info('Create', [
                'user_id' => Auth::id(),
                'action'  => 'Create Details PED',
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
