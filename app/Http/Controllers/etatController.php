<?php

namespace App\Http\Controllers;

use App\Models\Etat_formule;
use App\Models\Etat_user;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class etatController extends Controller
{
    //

    public function listeEtats():View{

        $etat_users = DB::table('etat_users')->get();
        $etat_formules = DB::table('etat_formules')->get();

        return view('etats/liste',[
            "etat_users" => $etat_users,
            "etat_formules" => $etat_formules,
        ]);

    }

    public function postEtatUser(Request $request){

        Etat_user::create([

            'nom_etat_user' => $request->nom_etat_user,

        ]);

        return redirect()->route('listeEtats')->with('message', "Etat utilisateur enregistré avec succes!");

    }



    public function postEtatFormule(Request $request){

        Etat_formule::create([

            'nom_etat_formule' => $request->nom_etat_formule,

        ]);

        return redirect()->route('listeEtats')->with('message', "Etat de formule enregistré avec succes!");

    }

    public function detailEtatUser(Etat_user $etat_user):View{

        $nbr_user = DB::table('users')->where('id_etat_user','=', $etat_user->id)->get();

        return view('etats/details/user',[
            "nbr_user" => $nbr_user,
            "etat_user" => $etat_user
        ]);

    }

    public function detailEtatFormule(Etat_formule $etat_formule):View{

        $nbr_formule = DB::table('formules')->where('id_etat_formule','=', $etat_formule->id)->get();

        return view('etats/details/formule',[
            "nbr_formule" => $nbr_formule,
            "etat_formule" => $etat_formule
        ]);

    }

    public function deleteEtatUser(Etat_user $etat_user){

        $etat_user->delete();

        return redirect()->route('listeEtats')->with('message', "Suppression réussit!");

    }

    public function deleteEtatFormule(Etat_formule $etat_formule){

        $etat_formule->delete();

        return redirect()->route('listeEtats')->with('message', "Suppression réussit!");

    }


}
