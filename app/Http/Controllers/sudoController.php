<?php

namespace App\Http\Controllers;

use App\Models\Formule;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class sudoController extends Controller
{
    //

    public function reinsertGerants():View{

        $liste_formules = DB::table("formules")->get();

        return view("users/sudo/gerants/reabonnements/accueil",[

            "liste_formules" => $liste_formules,

        ]);

    }


    public function formReinsertGerants(Formule $formule):View{

        $liste_gerants = DB::table("users")->where("role","=","gerant")->get();

        return view("users/sudo/gerants/reabonnements/form",[

            "formule" => $formule,
            "liste_gerants" => $liste_gerants,

        ]);

    }


    public function putReinsertGerant(Formule $formule, Request $request){


        $infos_gerant = DB::table("users")->where("id","=",$request->id)->first();
        $fin_souscription_ohter_formule = date("Y-m-d",strtotime('+1 month'));
        $fin_souscription_free = date("Y-m-d",strtotime('+14 days'));

        if($formule->nom_formule == "Free"){

            DB::table('users')->where('id','=', $infos_gerant->id)->update(['id_formule' => $request->id_formule, 'fin_souscription' => $fin_souscription_free, 'id_etat_user' => $request->id_etat_user]);
            DB::table('users')->where('id_user_action','=', $infos_gerant->id)->update(['id_formule' => $request->id_formule, 'fin_souscription' => $fin_souscription_free, 'id_etat_user' => $request->id_etat_user]);

            return redirect()->route('reinsertGerants',["formule" => $formule->id])->with('message',"Réabonnement effectué avec succès!");

        }else{

            DB::table('users')->where('id','=', $infos_gerant->id)->update(['id_formule' => $request->id_formule, 'fin_souscription' => $fin_souscription_ohter_formule, 'id_etat_user' => $request->id_etat_user]);
            DB::table('users')->where('id_user_action','=', $infos_gerant->id)->update(['id_formule' => $request->id_formule, 'fin_souscription' => $fin_souscription_ohter_formule, 'id_etat_user' => $request->id_etat_user]);

            return redirect()->route('reinsertGerants',["formule" => $formule->id])->with('message',"Réabonnement effectué avec succès!");

        }



    }


}
