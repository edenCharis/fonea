<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //


   
public function updateAccount(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validate incoming data
    $validated = $request->validate([
        'libelle' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'prenom' => 'required|string|max:255',
        'password' => 'nullable|string|min:6',
    ]);

    // Update fields
    $user->name = $validated['libelle'];
    $user->lastName = $validated['prenom'];
    $user->email = $validated['email'];

    // Only update password if provided
    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    $user->save();
        Log::channel('user_actions')->info('update_profile', [
            'user_id' => $user->id,
            'action'  => 'update_profile',
            'data'    => $request->except('password')
        ]);

        return redirect()
            ->back()
            ->with('success', 'Profil mis à jour avec succès.');

    }

    public function register(Request $request){

        if($request->isMethod('get')){
               return view("auth.register");
        }
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required',
           ],[
            'name.required' => 'Entrez votre nom',
            'email.unique'     => 'Cette adresse existe déja',
            'email.required' => 'Entrez votre adresse email',
            'email.email' => 'le format est incorrect',
            'email.max' => 'L\' email ne peut pas dépasser 255 caractères .',
            'password.required' => 'le mot de passe est obligatoire.',
            'password.min' => '8 caractères au minimum.',
        ]
         );
         $role_default = "administrateur";
         User::create([
            'name' => $request->input("name"),
            'email' => $request->input("email"),
            'password' =>  Hash::make($request->input("password") ),
            'role' => $role_default
         ]);

         return redirect()
             ->route('login')
             ->with("success", "Votre compte à été crée avec succès");
    }
    public function login(Request $request){
        if($request->isMethod('get')){
            return view("auth.login");
          } 

          $credentials = $request->validate([
            'password' => 'required',
            'email' => 'required',
          ],[
      
            'email.required' => 'Entrez votre adresse email',
            'email.email' => 'le format est incorrect',
            'email.max' => 'L\' email ne peut pas dépasser 255 caractères .',
            'password.required' => 'le mot de passe est obligatoire.',
            'password.min' => '8 caractères au minimum.',
        ]);

          if(Auth::attempt($credentials)){
          $email = $request->input("email");
          $user= User::where("email",$email)->first();
            switch ($user->role) {
                case 'administrateur':
                    Log::channel('user_actions')->info('connexion', [
                        'user_id' => Auth::id(),
                        'action'  => 'connexion',
                        'data'    => $request->all()
                    ]);
                    return redirect()
                        ->route("administrateur.administrateur")
                        ->with("success", "Welcome, Admin!");
                case (preg_match('/^Agent/', $user->role) ? true : false):
                    Log::channel('user_actions')->info('connexion', [
                        'user_id' => Auth::id(),
                        'action'  => 'connexion',
                        'data'    => $request->all()
                    ]);
                    return redirect()
                        ->route("autre.autre")
                        ->with("success", "welcome");
                case 'Directeur général':
                    Log::channel('user_actions')->info('connexion', [
                        'user_id' => Auth::id(),
                        'action'  => 'connexion',
                        'data'    => $request->all()
                    ]);
                            return redirect()
                                ->route("management.management")
                                ->with("success", "welcome");
                case 'Directeur':
                    Log::channel('user_actions')->info('connexion', [
                        'user_id' => Auth::id(),
                        'action'  => 'connexion',
                        'data'    => $request->all()
                    ]);
                            return redirect()
                                ->route("dg.directeur")
                                ->with("success", "welcome");
                case 'Délégué au Contrôle Budgetaire':
                                    Log::channel('user_actions')->info('connexion', [
                                        'user_id' => Auth::id(),
                                        'action'  => 'connexion',
                                        'data'    => $request->all()
                                    ]);
                                            return redirect()
                                                ->route("controle.controle")
                                                ->with("success", "welcome");
                              
              
                default:
                
                    Auth::logout(); 
                    }
          }
            Auth::logout();
            return redirect()
                ->route("login")
                ->withErrors( ['email' => 'Email incorrecte.',"password" => "Mot de passe incorrect."]);
            
               
    }

    public function logout(Request $request){

       Log::channel('user_actions')->info('deconnexion', [
            'user_id' => Auth::id(),
            'action'  => 'deconnexion',
            'data'    => $request->all()
        ]);

        Auth::logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()

        ->route("login")
        ->with("success", "Vous etes deconnecté !");

    }

}
