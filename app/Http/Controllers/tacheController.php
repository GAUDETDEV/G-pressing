<?php

namespace App\Http\Controllers;

use App\Http\Requests\validAllTacheLavageRequest;
use App\Http\Requests\validAllTacheLivraisonRequest;
use App\Http\Requests\validAllTacheRepassageRequest;
use App\Http\Requests\validMyTacheLavageRequest;
use App\Http\Requests\validMyTacheLivraisonRequest;
use App\Models\Facture;
use App\Models\Tache;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class tacheController extends Controller
{
    //

    public function indexAllTache(Request $request):View{

        $all_taches = DB::table("taches")->where("id_create_tache","=",Auth::id())->paginate(5);

        $today = date("Y-m-d");

        if($request->filled('search')){

            $all_taches = DB::table("taches")->where("id_create_tache","=",Auth::id())->whereAny([

                "type_tache",
                "etat_tache",

            ],"LIKE","%".$request->search."%")->paginate(5);

        }else{

            $all_taches = DB::table("taches")->where("id_create_tache","=",Auth::id())->paginate(5);

        }

        return view("taches/allTaches/liste",[

            "all_taches" => $all_taches,
            "today" => $today,

        ]);



    }




    public function indexMyTache(Request $request):View{

        $infos_user = DB::table('users')->where("id","=",Auth::id())->first();


            $my_taches = DB::table("taches")->where("id_executant","=",Auth::id())->paginate(5);

            $today = date("Y-m-d");

            if($request->filled('search')){

                $my_taches = DB::table("taches")->where("id_executant","=",Auth::id())->whereAny([

                    "type_tache",
                    "etat_tache",
                    "debut_tache",
                    "fin_tache",

                ],"LIKE","%".$request->search."%")->paginate(5);

            }else{

                $my_taches = DB::table("taches")->where("id_executant","=",Auth::id())->paginate(5);

            }

            return view("taches/myTaches/liste",[

                "my_taches" => $my_taches,
                "today" => $today,

            ]);



    }


    public function modifyTache(Tache $tache):View{


        return view("taches/allTaches/modify",[

            "tache" => $tache,

        ]);


    }

    public function deleteTache(Tache $tache){

        $tache -> delete();

        return redirect()->route("indexAllTache",['tache' => $tache->id])->with("message","Tâche supprimée avec succès!");

    }


    public function deleteAllTache(){

        DB::table("taches")->where("id_create_tache","=",Auth::id())->delete();

        return redirect()->route("indexAllTache")->with("message","Nettoyage effectuée avec succès!");

    }


    public function putTache(Tache $tache, Request $request){

        $tache->debut_tache = $request->debut_tache;
        $tache->fin_tache = $request->fin_tache;

        $tache -> save();

        return redirect()->route("indexAllTache",['tache' => $tache -> id])->with("message", "Mise à jour de la tache éffectuée avec succès!");

    }




    public function marquerAllTache(Tache $tache, Request $request){


        $today = date("Y-m-d");

        $facture = DB::table("factures")->where("id","=",$tache->id_facture)->first();

        if($tache->etat_tache == "En attente" and $tache->fin_tache >= $today){


            $tache->etat_tache = $request->etat_tache;

            if($facture->etat_traitement == "Depot"){

                DB::table('factures')->where("id","=",$tache->id_facture)->update(['etat_traitement' => "Lavage"]);

            }elseif($facture->etat_traitement == "Lavage" and $facture->id_service == ""){

                DB::table('factures')->where("id","=",$tache->id_facture)->update(['etat_traitement' => "Repassage"]);


            }elseif($facture->etat_traitement == "Lavage" and $facture->id_service !== "" and $facture->etat_livraison == "Oui"){

                DB::table('factures')->where("id","=",$tache->id_facture)->update(['etat_traitement' => "Fin"]);

            }elseif($facture->etat_traitement == "Repassage" and $facture->id_service == ""){

                if($facture->etat_livraison == "Oui"){

                    DB::table('factures')->where("id","=",$tache->id_facture)->update(['etat_traitement' => "Fin"]);

                }

                if($facture->etat_livraison == "Non"){

                    DB::table('factures')->where("id","=",$tache->id_facture)->update(['etat_traitement' => "Stockage"]);

                }


            }elseif($facture->etat_traitement == "Repassage" and $facture->id_service !== ""){

                if($facture->etat_livraison == "Oui"){

                    DB::table('factures')->where("id","=",$tache->id_facture)->update(['etat_traitement' => "Fin"]);

                }

                if($facture->etat_livraison == "Non"){

                    DB::table('factures')->where("id","=",$tache->id_facture)->update(['etat_traitement' => "Stockage"]);

                }


            }


            $tache -> save();


            return redirect()->route("detailAllTache",['tache' => $tache -> id])->with("message", "Tâche marquée comme terminer!");

        }

        if($tache->etat_tache == "Terminée"){

            if($tache->fin_tache > $today){

                return redirect()->route("detailAllTache",['tache' => $tache -> id])->with("message", "Tâche déjà marquée comme terminer!");

            }

            if($tache->fin_tache <= $today){

                return redirect()->route("detailAllTache",['tache' => $tache -> id])->with("message", "Tâche déjà marquée comme terminer!");

            }

        }


    }



    public function marquerMyTache(Tache $tache, Request $request){


        $today = date("Y-m-d");

        $facture = DB::table("factures")->where("id","=",$tache->id_facture)->first();

        if($tache->etat_tache == "En attente" and $tache->fin_tache >= $today){


            $tache->etat_tache = $request->etat_tache;

            if($facture->etat_traitement == "Depot"){

                DB::table('factures')->where("id","=",$tache->id_facture)->update(['etat_traitement' => "Lavage"]);

            }elseif($facture->etat_traitement == "Lavage" and $facture->id_service == ""){

                DB::table('factures')->where("id","=",$tache->id_facture)->update(['etat_traitement' => "Repassage"]);


            }elseif($facture->etat_traitement == "Lavage" and $facture->id_service !== "" and $facture->etat_livraison == "Oui"){

                DB::table('factures')->where("id","=",$tache->id_facture)->update(['etat_traitement' => "Fin"]);

            }elseif($facture->etat_traitement == "Repassage" and $facture->id_service == ""){

                if($facture->etat_livraison == "Oui"){

                    DB::table('factures')->where("id","=",$tache->id_facture)->update(['etat_traitement' => "Fin"]);

                }

                if($facture->etat_livraison == "Non"){

                    DB::table('factures')->where("id","=",$tache->id_facture)->update(['etat_traitement' => "Stockage"]);

                }


            }elseif($facture->etat_traitement == "Repassage" and $facture->id_service !== ""){

                if($facture->etat_livraison == "Oui"){

                    DB::table('factures')->where("id","=",$tache->id_facture)->update(['etat_traitement' => "Fin"]);

                }

                if($facture->etat_livraison == "Non"){

                    DB::table('factures')->where("id","=",$tache->id_facture)->update(['etat_traitement' => "Stockage"]);

                }


            }


            $tache -> save();


            return redirect()->route("detailMyTache",['tache' => $tache -> id])->with("message", "Tâche marquée comme terminer!");

        }

        if($tache->etat_tache == "Terminée"){

            if($tache->fin_tache > $today){

                return redirect()->route("detailMyTache",['tache' => $tache -> id])->with("message", "Tâche déjà marquée comme terminer!");

            }

            if($tache->fin_tache <= $today){

                return redirect()->route("detailMyTache",['tache' => $tache -> id])->with("message", "Tâche déjà marquée comme terminer!");

            }

        }



    }



    public function detailAllTache(Tache $tache){

        $info_executant = DB::table("users")->where("id","=",$tache->id_executant)->first();
        $info_poste = DB::table("postes")->where("id","=",$info_executant->id_poste)->first();
        $today = date("Y-m-d");

        if($tache->type_tache == "reception"){

            return view("taches/allTaches/reception/detail",[

                "info_executant" => $info_executant,
                "info_poste" => $info_poste,
                "tache" => $tache,
                "today" => $today,

            ]);


        }


        if($tache->type_tache == "lavage"){

            $infos_facture = DB::table("factures")->where("id","=",$tache->id_facture)->first();
            $infos_receptionist = DB::table("users")->where("id","=",$infos_facture->id_editor)->first();
            $info_vet_recepts = DB::table("recepts")->where("id_facture","=",$infos_facture->id)->where('id_company',"=", Auth::id())->get();
            $total_vets = DB::table("recepts")->where("id_facture","=",$infos_facture->id)->where('id_company',"=", Auth::id())->sum("qte_vet");

            return view("taches/allTaches/lavage/detail",[

                "info_executant" => $info_executant,
                "info_poste" => $info_poste,
                "tache" => $tache,
                "today" => $today,
                "infos_facture" => $infos_facture,
                "infos_receptionist" => $infos_receptionist,
                "info_vet_recepts" => $info_vet_recepts,
                "total_vets" => $total_vets,

            ]);

        }


        if($tache->type_tache == "repassage"){

            $infos_facture = DB::table("factures")->where("id","=",$tache->id_facture)->first();
            $infos_receptionist = DB::table("users")->where("id","=",$infos_facture->id_editor)->first();
            $info_vet_recepts = DB::table("recepts")->where("id_facture","=",$infos_facture->id)->where('id_company',"=", Auth::id())->get();
            $total_vets = DB::table("recepts")->where("id_facture","=",$infos_facture->id)->where('id_company',"=", Auth::id())->sum("qte_vet");

            return view("taches/allTaches/repassage/detail",[

                "info_executant" => $info_executant,
                "info_poste" => $info_poste,
                "tache" => $tache,
                "today" => $today,
                "infos_facture" => $infos_facture,
                "infos_receptionist" => $infos_receptionist,
                "info_vet_recepts" => $info_vet_recepts,
                "total_vets" => $total_vets,

            ]);

        }


        if($tache->type_tache == "livraison"){

            $infos_facture = DB::table("factures")->where("id","=",$tache->id_facture)->first();
            $infos_receptionist = DB::table("users")->where("id","=",$infos_facture->id_editor)->first();
            $info_vet_recepts = DB::table("recepts")->where("id_facture","=",$infos_facture->id)->where('id_company',"=", Auth::id())->get();
            $total_vets = DB::table("recepts")->where("id_facture","=",$infos_facture->id)->where('id_company',"=", Auth::id())->sum("qte_vet");

            $infos_livraison = DB::table("livraisons")->where("id_facture","=",$infos_facture->id)->where("id_company","=",Auth::id())->latest()->first();

            $commune = DB::table("communes")->where("id","=",$infos_livraison->id_commune)->where("id_company","=",Auth::id())->value("nom_commune");
            $quartier = DB::table("quartiers")->where("id","=",$infos_livraison->id_quartier)->where("id_company","=",Auth::id())->value("nom_quartier");
            $adresse = DB::table("adresses")->where("id","=",$infos_livraison->id_adresse)->where("id_company","=",Auth::id())->value("nom_adresse");
            $prix = DB::table("prices")->where("id","=",$infos_livraison->id_prix)->where("id_company","=",Auth::id())->value("valeur_prix");

            return view("taches/allTaches/livraison/detail",[

                "info_executant" => $info_executant,
                "info_poste" => $info_poste,
                "tache" => $tache,
                "today" => $today,
                "infos_facture" => $infos_facture,
                "infos_receptionist" => $infos_receptionist,
                "info_vet_recepts" => $info_vet_recepts,
                "total_vets" => $total_vets,
                "infos_livraison" => $infos_livraison,
                "commune" => $commune,
                "quartier" => $quartier,
                "adresse" => $adresse,
                "prix" => $prix,

            ]);

        }


    }





    public function detailMyTache(Tache $tache){

        $info_executant = DB::table("users")->where("id","=",Auth::id())->first();
        $info_poste = DB::table("postes")->where("id","=",$info_executant->id_poste)->first();
        $today = date("Y-m-d");

        if($tache->type_tache == "reception"){

            return view("taches/myTaches/reception/detail",[

                "info_executant" => $info_executant,
                "info_poste" => $info_poste,
                "tache" => $tache,
                "today" => $today,


            ]);

        }

        if($tache->type_tache == "lavage"){

            $infos_facture = DB::table("factures")->where("id","=",$tache->id_facture)->first();
            $infos_receptionist = DB::table("users")->where("id","=",$infos_facture->id_editor)->first();
            $info_vet_recepts = DB::table("recepts")->where("id_facture","=",$infos_facture->id)->get();
            $total_vets = DB::table("recepts")->where("id_facture","=",$infos_facture->id)->sum("qte_vet");

            return view("taches/myTaches/lavage/detail",[

                "info_executant" => $info_executant,
                "info_poste" => $info_poste,
                "tache" => $tache,
                "today" => $today,
                "infos_facture" => $infos_facture,
                "infos_receptionist" => $infos_receptionist,
                "info_vet_recepts" => $info_vet_recepts,
                "total_vets" => $total_vets,

            ]);

        }


        if($tache->type_tache == "repassage"){

            $infos_facture = DB::table("factures")->where("id","=",$tache->id_facture)->first();
            $infos_receptionist = DB::table("users")->where("id","=",$infos_facture->id_editor)->first();
            $info_vet_recepts = DB::table("recepts")->where("id_facture","=",$infos_facture->id)->get();
            $total_vets = DB::table("recepts")->where("id_facture","=",$infos_facture->id)->sum("qte_vet");

            return view("taches/myTaches/repassage/detail",[

                "info_executant" => $info_executant,
                "info_poste" => $info_poste,
                "tache" => $tache,
                "today" => $today,
                "infos_facture" => $infos_facture,
                "infos_receptionist" => $infos_receptionist,
                "info_vet_recepts" => $info_vet_recepts,
                "total_vets" => $total_vets,

            ]);

        }


        if($tache->type_tache == "livraison"){

            $infos_facture = DB::table("factures")->where("id","=",$tache->id_facture)->first();
            $infos_receptionist = DB::table("users")->where("id","=",$infos_facture->id_editor)->first();
            $info_vet_recepts = DB::table("recepts")->where("id_facture","=",$infos_facture->id)->get();
            $total_vets = DB::table("recepts")->where("id_facture","=",$infos_facture->id)->sum("qte_vet");


            $infos_livraison = DB::table("livraisons")->where("id_facture","=",$infos_facture->id)->latest()->first();
            $commune = DB::table("communes")->where("id","=",$infos_livraison->id_commune)->value("nom_commune");
            $quartier = DB::table("quartiers")->where("id","=",$infos_livraison->id_quartier)->value("nom_quartier");
            $adresse = DB::table("adresses")->where("id","=",$infos_livraison->id_adresse)->value("nom_adresse");
            $prix = DB::table("prices")->where("id","=",$infos_livraison->id_prix)->value("valeur_prix");

            return view("taches/myTaches/livraison/detail",[

                "info_executant" => $info_executant,
                "info_poste" => $info_poste,
                "tache" => $tache,
                "today" => $today,
                "infos_facture" => $infos_facture,
                "infos_receptionist" => $infos_receptionist,
                "info_vet_recepts" => $info_vet_recepts,
                "total_vets" => $total_vets,
                "infos_livraison" => $infos_livraison,
                "commune" => $commune,
                "quartier" => $quartier,
                "adresse" => $adresse,
                "prix" => $prix,

            ]);

        }

    }




}
