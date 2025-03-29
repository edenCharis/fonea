<?php

namespace App\Http\Controllers;

use App\Models\realisationApprentissage;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class realisationApprentissageController extends Controller
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
            'ndi' => 'required|min:1',
            'ndf' => 'required|min:1',
            'decrochage' => 'required|min:0',
            'apprentissage_id' => 'required|exists:apprentissage,id'
        ]);
        try {
            realisationApprentissage::create([
                'apprentissage_id' => $request->apprentissage_id,
                'ndi'=> $request->input("ndi"),
                'ndf' => $request->input("ndf"),
                'decrochage' => $request->input("decrochage")
            ]);

            Log::channel('user_actions')->info('Create', [
                'user_id' => Auth::id(),
                'action'  => 'Create realisation apprentissage',
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
