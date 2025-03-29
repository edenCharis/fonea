<?php

namespace App\Http\Controllers;

use App\Models\realisationFinancement;
use App\Models\realisationFormation;
use App\Models\realisationTDE;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class realisationTDEController extends Controller
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


        if($request->input("realisation") == "realisationTDE")
        {
            $request->validate([
                'nipi' => 'required|min:1',
                'tde_id' => 'required|exists:tde,id'
            ]);



            
            try {
                realisationTDE::create([
                    'tde_id' => $request->tde_id,
                    'nipi'=> $request->input("nipi"),
                ]);

                Log::channel('user_actions')->info('Create', [
                    'user_id' => Auth::id(),
                    'action'  => 'Create Realisation TDE',
                    'data'    => $request->all()
                ]);
                return redirect()
                ->back()
                ->with('message', 'opération effectuée avec succès!');
            } catch (\Exception $e) {
                return redirect()->back()->with('status', 'error')->with('message',$e->getMessage());
            }
        }else if($request->input("realisationFinancement") == "realisationFinancement"){

            $request->validate([
                'nrb' => 'required|min:1',
                'tde_id' => 'required|exists:tde,id'
            ]);
            try {
                realisationFinancement::create([
                    'tde_id' => $request->tde_id,
                    'nrb'=> $request->input("nrb"),
                ]);
                Log::channel('user_actions')->info('Create', [
                    'user_id' => Auth::id(),
                    'action'  => 'Create Realisation Financement',
                    'data'    => $request->all()
                ]);
                return redirect()
                ->back()
                ->with('message', 'opération effectuée avec succès!');
            } catch (\Exception $e) {
                return redirect()->back()->with('status', 'error')->with('message',$e->getMessage());
            }
        }else{


            $request->validate([
                'npf' => 'required|min:1',
                'tde_id' => 'required|exists:tde,id'
            ]);
            try {
                realisationFormation::create([
                    'tde_id' => $request->tde_id,
                    'npf'=> $request->input("npf"),
                ]);

                Log::channel('user_actions')->info('Create', [
                    'user_id' => Auth::id(),
                    'action'  => 'Create Realisation Formation',
                    'data'    => $request->all()
                ]);
                return redirect()
                ->back()
                ->with('message', 'opération effectuée avec succès!');
            } catch (\Exception $e) {
                return redirect()->back()->with('status', 'error')->with('message',$e->getMessage());
            }
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
