<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use \App\Models\Utilisateur;

class LoginController extends Controller
{
    // Fonction pour afficher le formulaire de login
    public function showLoginForm() {
        return view('authentification.loginForm'); // Assurez-vous que ce fichier Blade existe
    }

    // Fonction pour se connecter
    public function login(Request $request) {
        // Validation des données du formulaire
        $validator = Validator::make($request->all(), [
            'login' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Si la validation échoue
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Authentification
        $credentials = $request->only('login','password');
   
     // Authentification
     $user = Utilisateur::where('login', $credentials['login'])->first();

     if ($user && $user->password === $credentials['password']) {
         // Si les mots de passe correspondent, authentifiez l'utilisateur
         Auth::login($user);
         return redirect()->route('dashboard');
     }

    // Authentification échouée
    return back()->withErrors(['login' => 'Login ou mot de passe incorrect.'])->withInput();
}

    // Fonction pour se déconnecter
    public function logout(Request $request) {
        Auth::logout(); // Déconnexion
        $request->session()->invalidate(); // Invalider la session
        $request->session()->regenerateToken(); // Regénère le token CSRF pour sécurité
        session()->flash('succés','Vous avez déconnecté! ');
        return redirect()->route('utilisateur.loginForm'); // Redirection vers la page de connexion
    }
}
