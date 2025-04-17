<?php

namespace App\Http\Controllers;

use App\Models\JournalActivites;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class journalactivitesController extends Controller
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
        $record = journalActivites::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Ligne non trouvée.');
        }
        
        $record->delete();

        Log::channel('user_actions')->info('Suppression', [
            'user_id' => Auth::id(),
            'action'  => 'DELETE Activités',
            'data'    => $record
        ]);

        return redirect()->back()->with('success', 'Ligne supprimée avec succès.');
    
    }

    
    }

