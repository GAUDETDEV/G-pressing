<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Models\Facture;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class pdfController extends Controller
{
    //

    public function generatePdf(Facture $facture) {

        $type_depot = DB::table('depots')->where("id","=",$facture->id_type_depot)->first();

        $info_editor = DB::table('users')->where("id","=",Auth::id())->first();

        if($facture->etat_livraison ===  "Oui"){

            if($facture->id_type_depot === 0){

                $info_livraison = DB::table("livraisons")->where("id_facture","=",$facture->id)->latest()->first();
                $commune = DB::table("communes")->where("id","=",$info_livraison->id_commune)->first();
                $quartier = DB::table("quartiers")->where("id","=",$info_livraison->id_quartier)->first();
                $adresse = DB::table("adresses")->where("id","=",$info_livraison->id_adresse)->first();
                $prix = DB::table("prices")->where("id","=",$info_livraison->id_prix)->first();
                $vet_recepts = DB::table("recepts")->where("id_facture","=",$facture->id)->get();
                $montant_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix');
                $qte_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('qte_vet');
                $prix_units = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix_unitaire');

                $pdf = Pdf::loadView('pdf.recu.classic.complet',[
                    'facture' => $facture,
                    'info_livraison' => $info_livraison,
                    'commune' => $commune,
                    'quartier' => $quartier,
                    'adresse' => $adresse,
                    'prix' => $prix,
                    'vet_recepts' => $vet_recepts,
                    'montant_vets' => $montant_vets,
                    'qte_vets' => $qte_vets,
                    'prix_units' => $prix_units,
                    'info_editor' => $info_editor,
                ]);

                return $pdf->download('recu.pdf');

            }

            if($facture->id_type_depot == $type_depot->id and $type_depot->type_depot == "nombre"){

                $info_livraison = DB::table("livraisons")->where("id_facture","=",$facture->id)->latest()->first();
                $commune = DB::table("communes")->where("id","=",$info_livraison->id_commune)->first();
                $quartier = DB::table("quartiers")->where("id","=",$info_livraison->id_quartier)->first();
                $adresse = DB::table("adresses")->where("id","=",$info_livraison->id_adresse)->first();
                $prix = DB::table("prices")->where("id","=",$info_livraison->id_prix)->first();
                $vet_recepts = DB::table("recepts")->where("id_facture","=",$facture->id)->get();
                $montant_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix');
                $qte_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('qte_vet');
                $prix_units = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix_unitaire');
                $info_editor = DB::table('users')->where("id","=",Auth::id())->first();

                $pdf = Pdf::loadView('pdf.recu.nombre.complet',[
                    'facture' => $facture,
                    'info_livraison' => $info_livraison,
                    'commune' => $commune,
                    'quartier' => $quartier,
                    'adresse' => $adresse,
                    'prix' => $prix,
                    'vet_recepts' => $vet_recepts,
                    'montant_vets' => $montant_vets,
                    'qte_vets' => $qte_vets,
                    'prix_units' => $prix_units,
                    'info_editor' => $info_editor,
                ]);

                return $pdf->download('recu.pdf');

            }


            if($facture->id_type_depot == $type_depot->id and $type_depot->type_depot == "poids"){

                $info_livraison = DB::table("livraisons")->where("id_facture","=",$facture->id)->latest()->first();
                $commune = DB::table("communes")->where("id","=",$info_livraison->id_commune)->first();
                $quartier = DB::table("quartiers")->where("id","=",$info_livraison->id_quartier)->first();
                $adresse = DB::table("adresses")->where("id","=",$info_livraison->id_adresse)->first();
                $prix = DB::table("prices")->where("id","=",$info_livraison->id_prix)->first();
                $vet_recepts = DB::table("recepts")->where("id_facture","=",$facture->id)->get();
                $montant_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix');
                $qte_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('qte_vet');
                $prix_units = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix_unitaire');
                $info_editor = DB::table('users')->where("id","=",Auth::id())->first();

                $pdf = Pdf::loadView('pdf.recu.poids.complet',[
                    'facture' => $facture,
                    'info_livraison' => $info_livraison,
                    'commune' => $commune,
                    'quartier' => $quartier,
                    'adresse' => $adresse,
                    'prix' => $prix,
                    'vet_recepts' => $vet_recepts,
                    'montant_vets' => $montant_vets,
                    'qte_vets' => $qte_vets,
                    'prix_units' => $prix_units,
                    'info_editor' => $info_editor,
                ]);

                return $pdf->download('recu.pdf');

            }


        }else{

            if($facture->id_type_depot === 0){

                $vet_recepts = DB::table("recepts")->where("id_facture","=",$facture->id)->get();
                $montant_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix');
                $qte_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('qte_vet');
                $prix_units = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix_unitaire');
                $info_editor = DB::table('users')->where("id","=",Auth::id())->first();

                $pdf = Pdf::loadView('pdf.recu.classic.simple',[
                    'facture' => $facture,
                    'vet_recepts' => $vet_recepts,
                    'montant_vets' => $montant_vets,
                    'qte_vets' => $qte_vets,
                    'prix_units' => $prix_units,
                    'info_editor' => $info_editor,
                ]);

                return $pdf->download('recu.pdf');

            }


            if($facture->id_type_depot == $type_depot->id and $type_depot->type_depot == "nombre"){

                $vet_recepts = DB::table("recepts")->where("id_facture","=",$facture->id)->get();
                $montant_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix');
                $qte_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('qte_vet');
                $prix_units = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix_unitaire');
                $info_editor = DB::table('users')->where("id","=",Auth::id())->first();


                $pdf = Pdf::loadView('pdf.recu.nombre.simple',[
                    'facture' => $facture,
                    'vet_recepts' => $vet_recepts,
                    'qte_vets' => $qte_vets,
                    'prix_units' => $prix_units,
                    'info_editor' => $info_editor,
                    'montant_vets' => $montant_vets,
                ]);

                return $pdf->download('recu.pdf');

            }


            if($facture->id_type_depot == $type_depot->id and $type_depot->type_depot == "poids"){

                $vet_recepts = DB::table("recepts")->where("id_facture","=",$facture->id)->get();
                $montant_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix');
                $qte_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('qte_vet');
                $prix_units = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix_unitaire');
                $info_editor = DB::table('users')->where("id","=",Auth::id())->first();

                $pdf = Pdf::loadView('pdf.recu.poids.simple',[
                    'facture' => $facture,
                    'vet_recepts' => $vet_recepts,
                    'montant_vets' => $montant_vets,
                    'prix_units' => $prix_units,
                    'qte_vets' => $qte_vets,
                    'info_editor' => $info_editor,
                ]);

                return $pdf->download('recu.pdf');

            }


        }

    }

    public function downloadFactureClassic(){

        $liste_factures = DB::table('factures')->where("id_editor","=",Auth::id())->where("id_type_depot","=", 0)->get();

        $pdf = Pdf::loadView('pdf.factures.classic',[
            'liste_factures' => $liste_factures,
        ]);

        return $pdf->download('facture.pdf');


    }



    public function receptionistDownloadFactureSupplement(Service $service){

        $liste_factures = DB::table('factures')->where("id_editor","=",Auth::id())->where("id_service","=", $service->id)->get();

        $pdf = Pdf::loadView('pdf.supplements.receptionist.factures.file',[
            'liste_factures' => $liste_factures,
        ]);

        return $pdf->download('facture.pdf');


    }



    public function downloadFactureNombre(Depot $depot_nombre){

        $liste_factures = DB::table('factures')->where("id_editor","=",Auth::id())->where("id_type_depot","=", $depot_nombre->id)->get();

        $pdf = Pdf::loadView('pdf.factures.nombre',[
            'liste_factures' => $liste_factures,
        ]);

        return $pdf->download('facture.pdf');


    }



    public function downloadFacturePoids(Depot $depot_poid){

        $liste_factures = DB::table('factures')->where("id_editor","=",Auth::id())->where("id_type_depot","=", $depot_poid->id)->get();

        $pdf = Pdf::loadView('pdf.factures.poids',[
            'liste_factures' => $liste_factures,
        ]);

        return $pdf->download('facture.pdf');


    }


    public function downloadVetClassic(){

        $infos_receptionist = DB::table('users')->where("id","=",Auth::id())->first();
        $liste_vet_classics = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_type_depot","=", 0)->get();
        $total_qte_vet = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_type_depot","=", 0)->sum("qte_vet");
        $total_prix_unitaire = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_type_depot","=", 0)->sum("prix_unitaire");
        $total_prix = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_type_depot","=", 0)->sum("prix");


        $pdf = Pdf::loadView('pdf.vetements.classic',[

            'liste_vet_classics' => $liste_vet_classics,
            'infos_receptionist' => $infos_receptionist,
            'total_qte_vet' => $total_qte_vet,
            'total_prix_unitaire' => $total_prix_unitaire,
            'total_prix' => $total_prix,

        ]);

        return $pdf->download('liste_vetements.pdf');


    }


    public function receptionistDownloadVetSupplement(Service $service){

        $infos_receptionist = DB::table('users')->where("id","=",Auth::id())->first();
        $liste_vet_supplements = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_service","=", $service->id)->get();
        $total_qte_vet = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_service","=", $service->id)->sum("qte_vet");
        $total_prix_unitaire = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_service","=", $service->id)->sum("prix_unitaire");
        $total_prix = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_service","=", $service->id)->sum("prix");


        $pdf = Pdf::loadView('pdf.supplements.receptionist.vetements.file',[

            'liste_vet_supplements' => $liste_vet_supplements,
            'infos_receptionist' => $infos_receptionist,
            'total_qte_vet' => $total_qte_vet,
            'total_prix_unitaire' => $total_prix_unitaire,
            'total_prix' => $total_prix,

        ]);

        return $pdf->download('liste_vetements.pdf');


    }



    public function downloadVetNombre(Depot $depot_nombre){

        $infos_depot = DB::table("depots")->get();

        $infos_receptionist = DB::table('users')->where("id","=",Auth::id())->first();
        $liste_vet_nombres = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_type_depot","=", $depot_nombre->id)->get();
        $total_qte_vet = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_type_depot","=", $depot_nombre->id)->sum("qte_vet");
        $total_prix_unitaire = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_type_depot","=", $depot_nombre->id)->sum("prix_unitaire");
        $total_prix = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_type_depot","=", $depot_nombre->id)->sum("prix");


        $pdf = Pdf::loadView('pdf.vetements.nombre',[

            'liste_vet_nombres' => $liste_vet_nombres,
            'infos_receptionist' => $infos_receptionist,
            'total_qte_vet' => $total_qte_vet,
            'total_prix_unitaire' => $total_prix_unitaire,
            'total_prix' => $total_prix,

        ]);

        return $pdf->download('liste_vetements.pdf');


    }


    public function downloadVetPoids(Depot $depot_poid){

        $infos_depot = DB::table("depots")->get();

        $infos_receptionist = DB::table('users')->where("id","=",Auth::id())->first();
        $liste_vet_poids = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_type_depot","=", $depot_poid->id)->get();
        $total_qte_vet = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_type_depot","=", $depot_poid->id)->sum("qte_vet");
        $total_prix_unitaire = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_type_depot","=", $depot_poid->id)->sum("prix_unitaire");
        $total_prix = DB::table('recepts')->where("id_receptionist","=",Auth::id())->where("id_type_depot","=", $depot_poid->id)->sum("prix");


        $pdf = Pdf::loadView('pdf.vetements.poids',[

            'liste_vet_poids' => $liste_vet_poids,
            'infos_receptionist' => $infos_receptionist,
            'total_qte_vet' => $total_qte_vet,
            'total_prix_unitaire' => $total_prix_unitaire,
            'total_prix' => $total_prix,

        ]);

        return $pdf->download('liste_vetements.pdf');


    }


    public function downloadAllMyVetRecept(){

        $infos_user = DB::table("users")->where("id","=",Auth::id())->first();

        if($infos_user->role === "receptionniste"){

            $liste_vetements = DB::table('recepts')->where("id_receptionist","=",$infos_user->id)->where("id_company","=",$infos_user->id_user_action)->get();
            $total_qte_vet = DB::table('recepts')->where("id_receptionist","=",$infos_user->id)->where("id_company","=",$infos_user->id_user_action)->sum("qte_vet");
            $total_prix_unitaire = DB::table('recepts')->where("id_receptionist","=",$infos_user->id)->where("id_company","=",$infos_user->id_user_action)->sum("prix_unitaire");
            $total_prix = DB::table('recepts')->where("id_receptionist","=",$infos_user->id)->where("id_company","=",$infos_user->id_user_action)->sum("prix");


            $pdf = Pdf::loadView('pdf.vetements.receptionist.all',[

                'liste_vetements' => $liste_vetements,
                'infos_user' => $infos_user,
                'total_qte_vet' => $total_qte_vet,
                'total_prix_unitaire' => $total_prix_unitaire,
                'total_prix' => $total_prix,

            ]);

            return $pdf->download('liste_vetements.pdf');



        }


        if($infos_user->role === "client"){

            $liste_vetements = DB::table('recepts')->where("nom_client","=",$infos_user->name)->where("tel_client","=",$infos_user->telephone)->where("id_company","=",$infos_user->id_user_action)->get();
            $total_qte_vet = DB::table('recepts')->where("nom_client","=",$infos_user->name)->where("tel_client","=",$infos_user->telephone)->where("id_company","=",$infos_user->id_user_action)->sum("qte_vet");
            $total_prix_unitaire = DB::table('recepts')->where("nom_client","=",$infos_user->name)->where("tel_client","=",$infos_user->telephone)->where("id_company","=",$infos_user->id_user_action)->sum("prix_unitaire");
            $total_prix = DB::table('recepts')->where("nom_client","=",$infos_user->name)->where("tel_client","=",$infos_user->telephone)->where("id_company","=",$infos_user->id_user_action)->sum("prix");


            $pdf = Pdf::loadView('pdf.vetements.clients.all',[

                'liste_vetements' => $liste_vetements,
                'infos_user' => $infos_user,
                'total_qte_vet' => $total_qte_vet,
                'total_prix_unitaire' => $total_prix_unitaire,
                'total_prix' => $total_prix,

            ]);

            return $pdf->download('vetements_depot.pdf');


        }



    }



    public function downloadMyTaches(){

        $infos_user = DB::table("users")->where("id","=",Auth::id())->first();

        if($infos_user->role == "receptionniste"){

            $infos_receptionist = DB::table('users')->where("id","=",Auth::id())->first();
            $liste_taches = DB::table('taches')->where("id_executant","=",Auth::id())->where("type_tache","=","reception")->get();


            $pdf = Pdf::loadView('pdf.taches.receptionist.file',[

                'liste_taches' => $liste_taches,
                'infos_receptionist' => $infos_receptionist,

            ]);

            return $pdf->download('liste_taches.pdf');


        }elseif($infos_user->role == "laveur"){

            $infos_laveur = DB::table('users')->where("id","=",Auth::id())->first();
            $liste_taches = DB::table('taches')->where("id_executant","=",Auth::id())->where("type_tache","=","lavage")->get();


            $pdf = Pdf::loadView('pdf.taches.laveur.file',[

                'liste_taches' => $liste_taches,
                'infos_laveur' => $infos_laveur,

            ]);

            return $pdf->download('liste_taches.pdf');


        }elseif($infos_user->role == "repasseur"){

            $infos_repasseur = DB::table('users')->where("id","=",Auth::id())->first();
            $liste_taches = DB::table('taches')->where("id_executant","=",Auth::id())->where("type_tache","=","repassage")->get();


            $pdf = Pdf::loadView('pdf.taches.repasseur.file',[

                'liste_taches' => $liste_taches,
                'infos_repasseur' => $infos_repasseur,

            ]);

            return $pdf->download('liste_taches.pdf');


        }elseif($infos_user->role == "livreur"){

            $infos_livreur = DB::table('users')->where("id","=",Auth::id())->first();
            $liste_taches = DB::table('taches')->where("id_executant","=",Auth::id())->where("type_tache","=","livraison")->get();


            $pdf = Pdf::loadView('pdf.taches.livreur.file',[

                'liste_taches' => $liste_taches,
                'infos_livreur' => $infos_livreur,

            ]);

            return $pdf->download('liste_taches.pdf');


        }




    }


    public function downloadRecuMy(Facture $recu){

        $info_editor = DB::table('users')->where("id","=",Auth::id())->first();
        $info_livraison = DB::table("livraisons")->where("id_facture","=",$recu->id)->latest()->first();
        $vet_recepts = DB::table("recepts")->where("id_facture","=",$recu->id)->get();
        $montant_vets = DB::table("recepts")->where("id_facture","=",$recu->id)->sum('prix');
        $qte_vets = DB::table("recepts")->where("id_facture","=",$recu->id)->sum('qte_vet');
        $prix_units = DB::table("recepts")->where("id_facture","=",$recu->id)->sum('prix_unitaire');

        if($recu->etat_livraison === "Non"){

            $pdf = Pdf::loadView('pdf.recu.factures.receptionists.simple',[

                'recu' => $recu,
                'info_livraison' => $info_livraison,
                'vet_recepts' => $vet_recepts,
                'montant_vets' => $montant_vets,
                'qte_vets' => $qte_vets,
                'prix_units' => $prix_units,
                'info_editor' => $info_editor,

            ]);

            return $pdf->download('relicat.pdf');



        }elseif($recu->etat_livraison === "Oui"){

            $commune = DB::table("communes")->where("id","=",$info_livraison->id_commune)->first();
            $quartier = DB::table("quartiers")->where("id","=",$info_livraison->id_quartier)->first();
            $adresse = DB::table("adresses")->where("id","=",$info_livraison->id_adresse)->first();
            $prix = DB::table("prices")->where("id","=",$info_livraison->id_prix)->first();

            $pdf = Pdf::loadView('pdf.recu.factures.receptionists.complet',[

                'recu' => $recu,
                'info_livraison' => $info_livraison,
                'commune' => $commune,
                'quartier' => $quartier,
                'adresse' => $adresse,
                'prix' => $prix,
                'vet_recepts' => $vet_recepts,
                'montant_vets' => $montant_vets,
                'qte_vets' => $qte_vets,
                'prix_units' => $prix_units,
                'info_editor' => $info_editor,

            ]);

            return $pdf->download('relicat.pdf');


        }


    }


    public function receptionistGeneratePdfFactureSupplement(Facture $facture) {

        $info_editor = DB::table('users')->where("id","=",Auth::id())->first();

        if($facture->etat_livraison ===  "Oui"){

            $info_livraison = DB::table("livraisons")->where("id_facture","=",$facture->id)->latest()->first();
            $commune = DB::table("communes")->where("id","=",$info_livraison->id_commune)->first();
            $quartier = DB::table("quartiers")->where("id","=",$info_livraison->id_quartier)->first();
            $adresse = DB::table("adresses")->where("id","=",$info_livraison->id_adresse)->first();
            $prix = DB::table("prices")->where("id","=",$info_livraison->id_prix)->first();
            $vet_recepts = DB::table("recepts")->where("id_facture","=",$facture->id)->get();
            $montant_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix');
            $qte_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('qte_vet');
            $prix_units = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix_unitaire');
            $type_service = DB::table("services")->where("id","=",$facture->id_service)->first();

            $pdf = Pdf::loadView('pdf.supplements.receptionist.factures.complet',[
                'facture' => $facture,
                'info_livraison' => $info_livraison,
                'commune' => $commune,
                'quartier' => $quartier,
                'adresse' => $adresse,
                'prix' => $prix,
                'vet_recepts' => $vet_recepts,
                'montant_vets' => $montant_vets,
                'qte_vets' => $qte_vets,
                'prix_units' => $prix_units,
                'info_editor' => $info_editor,
                'type_service' => $type_service,
            ]);

            return $pdf->download('recu.pdf');

        }else{

            $vet_recepts = DB::table("recepts")->where("id_facture","=",$facture->id)->get();
            $montant_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix');
            $qte_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('qte_vet');
            $prix_units = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix_unitaire');
            $type_service = DB::table("services")->where("id","=",$facture->id_service)->first();


            $pdf = Pdf::loadView('pdf.supplements.receptionist.factures.simple',[
                'facture' => $facture,
                'vet_recepts' => $vet_recepts,
                'montant_vets' => $montant_vets,
                'qte_vets' => $qte_vets,
                'prix_units' => $prix_units,
                'info_editor' => $info_editor,
                'type_service' => $type_service,
            ]);

            return $pdf->download('recu.pdf');


        }


    }




    public function gerantDownloadFacture(Facture $facture){

        $info_editor = DB::table('users')->where("id","=",$facture->id_editor)->first();
        $info_livraison = DB::table("livraisons")->where("id_facture","=",$facture->id)->latest()->first();
        $vet_recepts = DB::table("recepts")->where("id_facture","=",$facture->id)->get();
        $montant_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix');
        $qte_vets = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('qte_vet');
        $prix_units = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix_unitaire');

        if($facture->etat_livraison === "Non"){

            $pdf = Pdf::loadView('pdf.factures.gerants.simple',[

                'facture' => $facture,
                'info_livraison' => $info_livraison,
                'vet_recepts' => $vet_recepts,
                'montant_vets' => $montant_vets,
                'qte_vets' => $qte_vets,
                'prix_units' => $prix_units,
                'info_editor' => $info_editor,

            ]);

            return $pdf->download('facture.pdf');



        }elseif($facture->etat_livraison === "Oui"){

            $commune = DB::table("communes")->where("id","=",$info_livraison->id_commune)->first();
            $quartier = DB::table("quartiers")->where("id","=",$info_livraison->id_quartier)->first();
            $adresse = DB::table("adresses")->where("id","=",$info_livraison->id_adresse)->first();
            $prix = DB::table("prices")->where("id","=",$info_livraison->id_prix)->first();

            $pdf = Pdf::loadView('pdf.factures.gerants.complet',[

                'facture' => $facture,
                'info_livraison' => $info_livraison,
                'commune' => $commune,
                'quartier' => $quartier,
                'adresse' => $adresse,
                'prix' => $prix,
                'vet_recepts' => $vet_recepts,
                'montant_vets' => $montant_vets,
                'qte_vets' => $qte_vets,
                'prix_units' => $prix_units,
                'info_editor' => $info_editor,

            ]);

            return $pdf->download('facture.pdf');


        }


    }


    public function gerantDownloadVetementNombrePoids(){

        $infos_gerant = DB::table("users")->where("id","=",Auth::id())->first();

        $liste_vetements = DB::table("recepts")->where("id_type_depot","!=", 0)->where("id_company","=",Auth::id())->get();

        $total_qte_vet = DB::table("recepts")->where("id_type_depot","!=", 0)->where("id_company","=",Auth::id())->sum("qte_vet");
        $total_prix_unitaire = DB::table("recepts")->where("id_type_depot","!=", 0)->where("id_company","=",Auth::id())->sum("prix_unitaire");
        $total_prix = DB::table("recepts")->where("id_type_depot","!=", 0)->where("id_company","=",Auth::id())->sum("prix");

        $pdf = Pdf::loadView('pdf.vetements.gerant.full.file',[

            'infos_gerant' => $infos_gerant,
            'liste_vetements' => $liste_vetements,
            'total_qte_vet' => $total_qte_vet,
            'total_prix_unitaire' => $total_prix_unitaire,
            'total_prix' => $total_prix,

        ]);

        return $pdf->download('liste_vetements.pdf');


    }



    public function gerantDownloadVetementSupplement(){

        $infos_gerant = DB::table("users")->where("id","=",Auth::id())->first();

        $liste_vetements = DB::table("recepts")->where("id_service","!=","")->where("id_company","=",Auth::id())->get();

        $total_qte_vet = DB::table("recepts")->where("id_service","!=","")->where("id_company","=",Auth::id())->sum("qte_vet");
        $total_prix_unitaire = DB::table("recepts")->where("id_service","!=","")->where("id_company","=",Auth::id())->sum("prix_unitaire");
        $total_prix = DB::table("recepts")->where("id_service","!=","")->where("id_company","=",Auth::id())->sum("prix");

        $pdf = Pdf::loadView('pdf.vetements.gerant.supplement.file',[

            'infos_gerant' => $infos_gerant,
            'liste_vetements' => $liste_vetements,
            'total_qte_vet' => $total_qte_vet,
            'total_prix_unitaire' => $total_prix_unitaire,
            'total_prix' => $total_prix,

        ]);

        return $pdf->download('liste_vetements.pdf');


    }


    public function gerantDownloadVetementClassic(){

        $infos_gerant = DB::table("users")->where("id","=",Auth::id())->first();

        $liste_vetements = DB::table("recepts")->where("id_type_depot","=", 0)->where("id_company","=",Auth::id())->get();

        $total_qte_vet = DB::table("recepts")->where("id_type_depot","=", 0)->where("id_company","=",Auth::id())->sum("qte_vet");
        $total_prix_unitaire = DB::table("recepts")->where("id_type_depot","=", 0)->where("id_company","=",Auth::id())->sum("prix_unitaire");
        $total_prix = DB::table("recepts")->where("id_type_depot","=", 0)->where("id_company","=",Auth::id())->sum("prix");

        $pdf = Pdf::loadView('pdf.vetements.gerant.full.file',[

            'infos_gerant' => $infos_gerant,
            'liste_vetements' => $liste_vetements,
            'total_qte_vet' => $total_qte_vet,
            'total_prix_unitaire' => $total_prix_unitaire,
            'total_prix' => $total_prix,

        ]);

        return $pdf->download('liste_vetements.pdf');


    }



    public function gerantDownloadListeLivraison(){

        $liste_livraisons = DB::table("livraisons")->where("id_company","=",Auth::id())->get();
        $total_frais = DB::table("livraisons")->where("id_company","=",Auth::id())->sum("frais");

        $pdf = Pdf::loadView('pdf.livraisons.gerants.file',[

            'liste_livraisons' => $liste_livraisons,
            'total_frais' => $total_frais,

        ]);

        return $pdf->download('liste_livraisons.pdf');


    }



}
