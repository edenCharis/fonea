<?php

namespace App\Http\Controllers;

use App\Models\realisationFQ;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class realisationFQController extends Controller
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
            'formation_qual_id' => 'required|exists:formation_qual,id'
        ]);
        try {
            realisationFQ::create([
                'formation_qual_id' => $request->formation_qual_id,
                'ndi'=> $request->input("ndi"),
                'ndf' => $request->input("ndf"),
                'decrochage' => $request->input("decrochage")
            ]);


            Log::channel('user_actions')->info('Create', [
                'user_id' => Auth::id(),
                'action'  => 'Create Realisation FQ',
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
    public function edit(Request $request, string $id)
    {
        //
          $request->validate([
            'ndi' => 'required|min:1',
            'ndf' => 'required|min:1',
            'decrochage' => 'required|min:0',
            'form_qual_id' => 'required|exists:formation_qual,id'
        ]);
    
        try {

            $realisation = realisationFQ::findOrFail($id);
            $realisation->update([
                'formation_qual_id' => $request->form_qual_id,
                'decrochage' => $request->decrochage,
                'ndf' => $request->ndf,
                'ndi' => $request->input("ndi") 
            ]);
    
            Log::channel('user_actions')->info('Update', [
                'user_id' => Auth::id(),
                'action'  => 'Update Realisation FQ',
                'data'    => $request->all(),
            ]);
            return redirect()->back()->with('message', 'Modification effectuée avec succès!');
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
