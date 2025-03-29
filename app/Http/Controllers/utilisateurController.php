<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class utilisateurController extends Controller
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
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required',
            'role' => 'required',
            'direction' => 'required',
        ]);

        try {
            User::create([
                'name' => $request->nom,
                'lastName' => $request->prenom,
                'email' => $request->email,
                'password' =>  Hash::make("Fonea@2025*"),
                "direction" => $request->direction,
                "role" =>$request->role
            ]);
            Log::channel('user_actions')->info('Création d\' un utilisateur', [
                'user_id' => Auth::id(),
                'action'  => 'Create utilisateur',
                'data'    => $request->all()
            ]);


            return redirect()->back()->with('status', 'success')->with('message', 'opération effectuée avec succès!');
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

        $record = user::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Ligne non trouvée.');
        }

        // Delete the record
        $record->delete();

        return redirect()->back()->with('success', 'Ligne supprimée avec succès.');
    
    
    }
}
