<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class authController extends Controller
{
    //

    public function dashboard():View{

    //dashbord sudo

        $today = date("Y-m-d");

        $users = DB::table("users")->where("role","!=","sudo")->get();
        $gerants = DB::table("users")->where("role","=","gerant")->get();
        $gerants_news = DB::table('users')->where("role","=","gerant")->latest()->take(5)->get();
        $formules = DB::table("formules")->get();

        $nbr_users = count($users);
        $nbr_gerants = count($gerants);
        $nbr_formules = count($formules);


    //dashbord gerant

        $today = date("Y-m-d");

        $tache_gerant_attentes = DB::table("taches")->where("id_create_tache","=",Auth::id())->where("etat_tache","=","En attente")->get();
        $tache_gerant_effectuees = DB::table("taches")->where("id_create_tache","=",Auth::id())->where("etat_tache","=","Terminée")->get();
        $facture_gerant_regler = DB::table("factures")->where("id_company","=",Auth::id())->where("statut_facture","=","Régler")->get();
        $facture_gerant_non_regler = DB::table("factures")->where("id_company","=",Auth::id())->where("statut_facture","=","Non régler")->get();
        $livraison_gerants = DB::table("livraisons")->where("id_company","=",Auth::id())->get();

        $profit_factures = DB::table("factures")->where("etat_traitement","!=","")->where("registration","=",$today)->where("id_company","=",Auth::id())->sum("montant");
        $profit_livraison = DB::table("livraisons")->where("id_company","=",Auth::id())->where("registration","=",$today)->sum("frais");

        $profit = $profit_factures + $profit_livraison;

        $nbr_vetement_gerant = DB::table("recepts")->where("id_company","=",Auth::id())->sum("qte_vet");
        $client_gerant = DB::table("users")->where("role","=","client")->where("id_user_action","=",Auth::id())->get();
        $receptionniste_gerant = DB::table("users")->where("role","=","receptionniste")->where("id_user_action","=",Auth::id())->get();
        $laveur_gerant = DB::table("users")->where("role","=","laveur")->where("id_user_action","=",Auth::id())->get();
        $repasseur_gerant = DB::table("users")->where("role","=","repasseur")->where("id_user_action","=",Auth::id())->get();
        $livreur_gerant = DB::table("users")->where("role","=","livreur")->where("id_user_action","=",Auth::id())->get();

        $nbr_receptionniste_gerant = count($receptionniste_gerant);
        $nbr_laveur_gerant = count($laveur_gerant);
        $nbr_repasseur_gerant = count($repasseur_gerant);
        $nbr_livreur_gerant = count($livreur_gerant);

        $nbr_employers = $nbr_receptionniste_gerant + $nbr_laveur_gerant + $nbr_repasseur_gerant + $nbr_livreur_gerant;
        $nbr_client = count($client_gerant);

        $nbr_tache_gerant_attente = count($tache_gerant_attentes);
        $nbr_tache_gerant_effectuees = count($tache_gerant_effectuees);
        $nbr_facture_gerant_regler = count($facture_gerant_regler);
        $nbr_facture_gerant_non_regler = count($facture_gerant_non_regler);
        $nbr_livraison_gerant = count($livraison_gerants);


    //dashbord receptionist

        $tache_receptionists = DB::table("taches")->where("type_tache","=","reception")->where("id_executant","=",Auth::id())->get();
        $tache_receptionists_attentes = DB::table("taches")->where("type_tache","=","reception")->where("id_executant","=",Auth::id())->where("etat_tache","=","En attente")->get();
        $facture_receptionists = DB::table("factures")->where("id_editor","=",Auth::id())->get();
        $recu_receptionists_regler = DB::table("factures")->where("id_editor","=",Auth::id())->where("statut_facture","=","Régler")->get();
        $recu_receptionists_non_regler = DB::table("factures")->where("id_editor","=",Auth::id())->where("statut_facture","=","Non régler")->get();
        $vetement_receptionists = DB::table("recepts")->where("id_receptionist","=",Auth::id())->sum("qte_vet");


        $nbr_tache_receptionist = count($tache_receptionists);
        $nbr_tache_receptionist_attente = count($tache_receptionists_attentes);
        $nbr_facture_receptionist = count($facture_receptionists);
        $nbr_recu_receptionist = count($recu_receptionists_regler) + count($recu_receptionists_non_regler);


    //dashbord laveur

        $tache_laveur_attentes = DB::table("taches")->where("type_tache","=","lavage")->where("id_executant","=",Auth::id())->where("etat_tache","=","En attente")->get();
        $tache_laveur_effectuers = DB::table("taches")->where("type_tache","=","lavage")->where("id_executant","=",Auth::id())->where("etat_tache","=","Terminée")->get();

        $nbr_tache_laveur_effectuer = count($tache_laveur_effectuers);
        $nbr_tache_laveur_attente = count($tache_laveur_attentes);

    //dashbord repasseur

        $tache_repasseur_attentes = DB::table("taches")->where("type_tache","=","repassage")->where("id_executant","=",Auth::id())->where("etat_tache","=","En attente")->get();
        $tache_repasseur_effectuers = DB::table("taches")->where("type_tache","=","repassage")->where("id_executant","=",Auth::id())->where("etat_tache","=","Terminée")->get();

        $nbr_tache_repasseur_effectuer = count($tache_repasseur_effectuers);
        $nbr_tache_repasseur_attente = count($tache_repasseur_attentes);


    //dashbord livreur

        $tache_livreur_attentes = DB::table("taches")->where("type_tache","=","livraison")->where("id_executant","=",Auth::id())->where("etat_tache","=","En attente")->get();
        $tache_livreur_effectuers = DB::table("taches")->where("type_tache","=","livraison")->where("id_executant","=",Auth::id())->where("etat_tache","=","Terminée")->get();

        $nbr_tache_livreur_effectuer = count($tache_livreur_effectuers);
        $nbr_tache_livreur_attente = count($tache_livreur_attentes);


    //dashbord clients

        $infos_client = DB::table("users")->where("id","=",Auth::id())->first();

        $facture_clients = DB::table("factures")->where("nom_titulaire","=",$infos_client->name)->where("tel_titulaire","=",$infos_client->telephone)->where("id_company","=",$infos_client->id_user_action)->get();
        $nbr_vetements = DB::table("recepts")->where("nom_client","=",$infos_client->name)->where("tel_client","=",$infos_client->telephone)->where("id_company","=",$infos_client->id_user_action)->sum("qte_vet");

        $nbr_factures = count($facture_clients);


        return view('dashboard',[

            "nbr_tache_receptionist" => $nbr_tache_receptionist,
            "nbr_tache_receptionist_attente" => $nbr_tache_receptionist_attente,
            "nbr_facture_receptionist" => $nbr_facture_receptionist,
            "nbr_recu_receptionist" => $nbr_recu_receptionist,
            "vetement_receptionists" => $vetement_receptionists,

            "nbr_tache_laveur_effectuer" => $nbr_tache_laveur_effectuer,
            "nbr_tache_laveur_attente" => $nbr_tache_laveur_attente,

            "nbr_tache_repasseur_effectuer" => $nbr_tache_repasseur_effectuer,
            "nbr_tache_repasseur_attente" => $nbr_tache_repasseur_attente,

            "nbr_tache_livreur_effectuer" => $nbr_tache_livreur_effectuer,
            "nbr_tache_livreur_attente" => $nbr_tache_livreur_attente,

            "nbr_factures" => $nbr_factures,
            "nbr_vetements" => $nbr_vetements,

            "profit" => $profit,
            "nbr_vetement_gerant" => $nbr_vetement_gerant,
            "nbr_tache_gerant_attente" => $nbr_tache_gerant_attente,
            "nbr_tache_gerant_effectuees" => $nbr_tache_gerant_effectuees,
            "nbr_facture_gerant_regler" => $nbr_facture_gerant_regler,
            "nbr_facture_gerant_non_regler" => $nbr_facture_gerant_non_regler,
            "nbr_livraison_gerant" => $nbr_livraison_gerant,

            "nbr_employers" => $nbr_employers,
            "nbr_client" => $nbr_client,

            "nbr_users" => $nbr_users,
            "nbr_gerants" => $nbr_gerants,
            "nbr_formules" => $nbr_formules,
            "gerants_news" => $gerants_news,


        ]);

    }


}
