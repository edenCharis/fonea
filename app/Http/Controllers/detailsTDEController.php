<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\detailsTDE;
use App\Models\formation;
use App\Models\financement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

 
class detailsTDEController extends Controller
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
        if($request->input("formation") == "formation"){

            $request->validate([
                'npaf' => 'required|min:1',
                'tde_id' => 'required|exists:tde,id',
            ]);
            try {
    
                formation::create([
              
                    'tde_id' => $request->input("tde_id"),
                    'npaf' => $request->input("npaf"),
                    
                ]);
    
                return redirect()
                ->back()
                ->with('status', 'success')->with('message', 'opération effectuée avec succès!');
            } catch (\Exception $e) {
                return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
            }


        }else if($request->input("financement") == "financement"){

            $request->validate([
                'nbp' => 'required|min:1',
                'tde_id' => 'required|exists:tde,id',
            ]);
            try {
    
                financement::create([
              
                    'tde_id' => $request->input("tde_id"),
                    'nbp' => $request->input("nbp"),
                    
                ]);
    
                return redirect()
                ->back()
                ->with('status', 'success')->with('message', 'opération effectuée avec succès!');
            } catch (\Exception $e) {
                return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
            }


        }else {
           
              $request->validate([
                'npipi' => 'required|min:1',
                'nipi' => 'required|min:1',
                'npipaf' => 'required|min:1',
                'npipai' => 'required|min:1',
                'nipv' => 'required|min:1',
                'operateur_formation' => 'required',
                'tde_id' => 'required|exists:tde,id',
                'metier_id' => 'required|exists:metier,id',
                'secteur_id' => 'required|exists:secteur,id' 
            ]);
            try {
    
                detailsTDE::create([
                    'npipi' => $request->input("npipi"),
                    'nipi' => $request->input("nipi"),
                    'npipaf' => $request->input("npipaf"),
                    'npipai'=> $request->input("npipai"),
                    'nipv' => $request->input("nipv"),
                    'intitule' => $request->input("nipv"),
                    'operateur_formation' => $request->input("operateur_formation"),
                    'tde_id' => $request->input("tde_id"),
                    'metier_id' => $request->input("metier_id"),
                    'secteur_id' => $request->input("secteur_id")
                ]);

                Log::channel('user_actions')->info('creation', [
                    'user_id' => Auth::id(),
                    'action'  => 'CREATE detailsTDE',
                    'data'    => $request->all()
                ]);
    
                return redirect()
                ->back()
                ->with('status', 'success')->with('message', 'opération effectuée avec succès!');
            } catch (\Exception $e) {
                
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
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
