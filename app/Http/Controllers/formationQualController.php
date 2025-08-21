<?php

namespace App\Http\Controllers;

use App\Models\formationQual;
use App\Models\journalActivites;
use App\Models\activites;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class formationQualController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Implementation needed
    }

    /**
     * Generate a sequential code for formation qualification
     */
    private function generateSequentialCode()
    {
        $lastCode = DB::table('formation_qual')
            ->orderBy('id', 'desc')
            ->value('numero_identification');

        $lastSequence = $lastCode ? (int)substr($lastCode, 8) : 0;
        $nextSequence = $lastSequence + 1;
        $uniqueCode = 'FORMQUAL' . str_pad($nextSequence, 4, '0', STR_PAD_LEFT);

        return $uniqueCode;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Implementation needed
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'trimestre_id' => 'required|exists:trimestre,id',
        ]);

        $user = $request->user();

        try {
            // Check if activity exists (case-insensitive)
            $activityExists = DB::table('activites')
                ->whereRaw('LOWER(libelle) = ?', [strtolower($request->name)])
                ->exists();

            // Get user direction
            $userDirection = User::select('direction')
                ->where('id', $user->id)
                ->firstOrFail();

            // Create journal entry based on activity existence
            if ($activityExists) {
                journalActivites::create([
                    'libelle' => $request->name,
                    'trimestre_id' => $request->trimestre_id,
                    'statut' => 'Budgetisé',
                    'type' => 'Formation qualifiante',
                    'direction' => $userDirection->direction,
                    'user_id' => $user->id,
                    'date_enregistrement' => Carbon::now(),
                ]);

                // Update activity status to "Executé"
                $activity = activites::whereRaw('LOWER(libelle) = ?', [strtolower($request->name)])
                    ->firstOrFail();
                $activity->update(['statut' => 'Executé']);
            } else {
                journalActivites::create([
                    'libelle' => $request->name,
                    'trimestre_id' => $request->trimestre_id,
                    'statut' => 'Non Budgetisé',
                    'type' => 'Formation qualifiante',
                    'direction' => $userDirection->direction,
                    'user_id' => $user->id,
                    'date_enregistrement' => Carbon::now(),
                ]);
            }

            // Create formation qualification record
            formationQual::create([
                'intitule' => $request->name,
                'trimestre_id' => $request->trimestre_id,
                'numero_identification' => $this->generateSequentialCode(),
                'user_id' => $user->id,
            ]);

            // Log the action
            Log::channel('user_actions')->info('Création', [
                'user_id' => Auth::id(),
                'action' => 'Create FORM QUAL',
                'data' => $request->all(),
            ]);

            return redirect()->back()
                ->with('status', 'success')
                ->with('message', 'Opération effectuée avec succès!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('status', 'error')
                ->with('message', $e->getMessage());
        }
    }

    public function validate(Request $request, $id)
    {
        // Find the formation
        $f = formQual::find($id);

        if (!$f) {
           return redirect()->back()->with('error', 'Record not found.');
    
     }
        

        
        $f->valide = 1; // or 1 depending on your DB
        $f->save();

        return redirect()->back()->with('success', 'Record deleted successfully.');
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implementation needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Implementation needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'intitule' => 'required|string|max:255',
            'trimestre_id' => 'required|exists:trimestre,id',
        ]);

        try {
            $record = formationQual::find($id);
            
            if (!$record) {
                return redirect()->back()
                    ->with('status', 'error')
                    ->with('message', 'Enregistrement non trouvé.');
            }

            $record->update([
                'intitule' => $request->input('intitule'),
                'trimestre_id' => $request->input('trimestre_id'),
            ]);

            Log::channel('user_actions')->info('Mise à jour', [
                'user_id' => Auth::id(),
                'action' => 'UPDATE FORM QUAL',
                'data' => $request->all(),
            ]);

            return redirect()->back()
                ->with('status', 'success')
                ->with('message', 'Enregistrement mis à jour avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('status', 'error')
                ->with('message', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $record = formationQual::find($id);

            if (!$record) {
                return redirect()->back()
                    ->with('status', 'error')
                    ->with('message', 'Enregistrement non trouvé.');
            }

            // Store record data for logging before deletion
            $recordData = $record->toArray();
            
            // Delete the record
            $record->delete();

            Log::channel('user_actions')->info('Suppression', [
                'user_id' => Auth::id(),
                'action' => 'DELETE FORM QUAL',
                'data' => $recordData,
            ]);

            return redirect()->back()
                ->with('status', 'success')
                ->with('message', 'Enregistrement supprimé avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('status', 'error')
                ->with('message', $e->getMessage());
        }
    }
}