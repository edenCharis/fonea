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
                        ->with("success", "Welcome, Autre!");
                case 'directeur général':
                    Log::channel('user_actions')->info('connexion', [
                        'user_id' => Auth::id(),
                        'action'  => 'connexion',
                        'data'    => $request->all()
                    ]);
                            return redirect()
                                ->route("dg.dg")
                                ->with("success", "Welcome, Autre!");
                case 'Délégué au Contrôle Budgetaire':
                                    Log::channel('user_actions')->info('connexion', [
                                        'user_id' => Auth::id(),
                                        'action'  => 'connexion',
                                        'data'    => $request->all()
                                    ]);
                                            return redirect()
                                                ->route("controle.controle")
                                                ->with("success", "Welcome, Autre!");
                              
              
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
