<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class abonnementController extends Controller
{
    //
    public function accueilAbonnement():View{

        $infos_user = DB::table('users')->where('id',"=",Auth::id())->first();

        $infos_abonnement = DB::table('formules')->where("id","=",$infos_user->id_formule)->first();

        $etat_formule = DB::table("etat_formules")->where("id","=",$infos_abonnement->id_etat_formule)->value("nom_etat_formule");

        $fin_souscription = $infos_user->fin_souscription;

        $today_time = date("Y-m-d");

        $today = date_create($today_time);
        $date_fin_souscription  = date_create($fin_souscription);
        $time_reste = date_diff($date_fin_souscription, $today);

        return view("abonnement/accueil",[

            "infos_user" => $infos_user,
            "infos_abonnement" => $infos_abonnement,
            "etat_formule" => $etat_formule,
            "time_reste" => $time_reste,

        ]);


    }
}
