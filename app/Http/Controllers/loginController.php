<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class loginController extends Controller
{
    //
    public function home(){

        return view('home');

    }


    public function login():View{

        return view('login');

    }

    public function logout(){

        Auth::logout();

        return redirect()->route('login')->with('message', "Vous êtes déconnecté!");

    }


    public function postLogin(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(["email" => $request->email, "password" => $request->password,])) {

            $user = DB::table('users')->where('email','=',$request->email)->first();
            $id_etat_user_auto = DB::table('etat_users')->where('nom_etat_user','=','ACTIF')->first();
            $user = DB::table('users')->where('email','=',$request->email)->first();

            if($user->id_etat_user == $id_etat_user_auto->id){

                $today = date("Y-m-d");

                if($user->fin_souscription >= $today){


                    $request->session()->regenerate();
                    return redirect()->intended('dashboard')->with('message', "Vous êtes connecté!");


                }else{

                    return redirect()->route('login')->with('message', "Désoler votre période d'abonnement a expiré!");

                }

            }else{

                return redirect()->route('login')->with('message', "Désoler votre compte est Désactivé!");

            }

        }else{

            return redirect()->route('login')->with('message', "Une erreur s'est produite. Vérifiez vos informations!");

        }

    }
}
