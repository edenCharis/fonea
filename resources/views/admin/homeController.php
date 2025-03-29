<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    //
    
    public function IndexFoneaApp () {

        return view ('connexion');
    }

    public function connexion(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
           ],[
            'email.required' => 'Entrez votre adresse email',
            'email.email' => 'le format est incorrect',
            'email.max' => 'L\' email ne peut pas dépasser 255 caractères .',
            'password.required' => 'le mot de passe est obligatoire.',
            'password.min' => '8 caractères au minimum.',
        ]
         );
           
            return redirect()
              ->route('administrateur.administrateur');
             
    }
}
