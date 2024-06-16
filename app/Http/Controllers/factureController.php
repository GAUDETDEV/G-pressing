<?php

namespace App\Http\Controllers;

use App\Http\Requests\postAdresseRequest;
use App\Http\Requests\postCommuneRequest;
use App\Http\Requests\postFactureRequest;
use App\Http\Requests\postLivraisonRequest;
use App\Http\Requests\postPrixRequest;
use App\Http\Requests\postQuartierRequest;
use App\Models\Adresse;
use App\Models\Commune;
use App\Models\Depot;
use App\Models\Facture;
use App\Models\Livraison;
use App\Models\Price;
use App\Models\Quartier;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class factureController extends Controller
{
    //

    public function accueilFacture():View{

        return view("factures/accueil");

    }


    public function listeMyFacture(Request $request):View{

        $user_auth = DB::table('users')->where("id","=",Auth::id())->first();



        if($user_auth->role === "receptionniste"){

            $factures = DB::table('factures')->where("id_company","=",$user_auth->id_user_action)->paginate(10);

            if($request->filled('search')){

                $factures = DB::table('factures')->where("id_company","=",$user_auth->id_user_action)->whereAny([
                    'id',
                    'nom_titulaire',
                    'tel_titulaire',
                    'montant',
                    'statut_facture',
                ], 'LIKE',$request->search.'%')->paginate(10);

            }else{

                $factures = DB::table('factures')->where("id_company","=",$user_auth->id_user_action)->paginate(10);

            }


            return view("factures/receptionists/liste",[

                "factures" => $factures,

            ]);


        }


        if($user_auth->role === "client"){

            $factures = DB::table('factures')->where("id_company","=",$user_auth->id_user_action)->where("nom_titulaire","=",$user_auth->name)->where("tel_titulaire","=",$user_auth->telephone)->paginate(10);

            if($request->filled('search')){

                $factures = DB::table('factures')->where("id_company","=",$user_auth->id_user_action)->where("nom_titulaire","=",$user_auth->name)->where("tel_titulaire","=",$user_auth->telephone)->whereAny([
                    'id',
                    'nom_titulaire',
                    'tel_titulaire',
                    'montant',
                    'statut_facture',
                ], 'LIKE',$request->search.'%')->paginate(10);

            }else{

                $factures = DB::table('factures')->where("id_company","=",$user_auth->id_user_action)->where("nom_titulaire","=",$user_auth->name)->where("tel_titulaire","=",$user_auth->telephone)->paginate(10);

            }


            return view("factures/clients/liste",[

                "factures" => $factures,

            ]);


        }




    }



    public function listeAllFacture(Request $request):View{

        $allfactures = DB::table('factures')->where("id_company","=",Auth::id())->paginate(10);


        if($request->filled("search")){

            $allfactures = DB::table('factures')->where("id_company","=",Auth::id())->whereAny([

                "id",
                "nom_titulaire",
                "tel_titulaire",
                "statut_facture",

            ],"LIKE",$request->search."%")->paginate(10);

        }else{

            $allfactures = DB::table('factures')->where("id_company","=",Auth::id())->paginate(10);

        }


        return view("factures/alls/liste",[

            "allfactures" => $allfactures,

        ]);




    }

    public function listeFactureClassic():View{

        $myfactures = DB::table('factures')->where("id_type_depot","=",0)->where("id_editor","=",Auth::id())->paginate(10);

        $nbrfactures = DB::table('factures')->where("id_type_depot","=",0)->where("id_editor","=",Auth::id())->get();

        $vet_recept_classics = DB::table('recepts')->where("id_type_depot","=",0)->where("id_receptionist","=",Auth::id())->get();

        $nbr_vet_classic = count($vet_recept_classics);

        $count = count($nbrfactures);

        return view("factures/classic/liste",[

            "myfactures" => $myfactures,
            "nbr_vet_classic" => $nbr_vet_classic,
            "count" => $count,

        ]);


    }


    public function listeFactureNombre(Depot $depot_nombre):View{

        $factures = DB::table('factures')->where("id_type_depot","=",$depot_nombre->id)->where("id_editor","=",Auth::id())->paginate(10);

        $nbr_factures = DB::table('factures')->where("id_type_depot","=",$depot_nombre->id)->where("id_editor","=",Auth::id())->get();

        $count = count($nbr_factures);

        return view("factures/nombre/show",[

            "depot_nombre" => $depot_nombre,
            "factures" => $factures,
            "count" => $count,

        ]);


    }


    public function listeFacturePoids(Depot $depot_poid):View{

        $factures = DB::table('factures')->where("id_type_depot","=",$depot_poid->id)->where("id_editor","=",Auth::id())->paginate(10);

        $nbr_factures = DB::table('factures')->where("id_type_depot","=",$depot_poid->id)->where("id_editor","=",Auth::id())->get();

        $count = count($nbr_factures);

        return view("factures/poids/show",[

            "depot_poid" => $depot_poid,
            "factures" => $factures,
            "count" => $count,

        ]);


    }


    public function listeDepotNombre():View{

        $infos_auth = DB::table("users")->where("id","=",Auth::id())->first();

        $depot_nombres = DB::table('depots')->where("type_depot",'=',"nombre")->where("id_company","=",$infos_auth->id_user_action)->paginate(3);

        return view("factures/nombre/liste",[

            "depot_nombres" => $depot_nombres,

        ]);


    }

    public function listeDepotPoids():View{

        $infos_auth = DB::table("users")->where("id","=",Auth::id())->first();

        $depot_poids = DB::table('depots')->where("type_depot",'=',"poids")->where("id_company","=",$infos_auth->id_user_action)->paginate(3);

        return view("factures/poids/liste",[

            "depot_poids" => $depot_poids,

        ]);


    }



    public function postFactureNombre(Depot $depot_nombre, postFactureRequest $request){

        $today = date("Y-m-d h:i:s");
        $registration = date("Y-m-d");

        $infos_auth = DB::table("users")->where("id","=",Auth::id())->first();

        Facture::create([

            'nom_titulaire' => $request->nom_titulaire,
            'tel_titulaire' => $request->tel_titulaire,
            'id_type_depot' => $depot_nombre->id,
            'date_retrait' => $today,
            'id_editor' => Auth::id(),
            'id_company' => $infos_auth->id_user_action,
            'registration' => $registration,

        ]);

        return redirect()->route('listeFactureNombre',['depot_nombre'=>$depot_nombre])->with("message","Facture enregistré avec succès!");

    }


    public function postFacturePoids(Depot $depot_poid, postFactureRequest $request){

        $today = date("Y-m-d h:i:s");
        $registration = date("Y-m-d");

        $infos_auth = DB::table("users")->where("id","=",Auth::id())->first();

        Facture::create([

            'nom_titulaire' => $request->nom_titulaire,
            'tel_titulaire' => $request->tel_titulaire,
            'id_type_depot' => $depot_poid->id,
            'date_retrait' => $today,
            'id_editor' => Auth::id(),
            'id_company' => $infos_auth->id_user_action,
            'registration' => $registration,

        ]);

        return redirect()->route('listeFacturePoids',['depot_poid'=>$depot_poid])->with("message","Facture enregistré avec succès!");

    }





    public function postFactureClassic(postFactureRequest $request){

        $id_type_depot = 0;
        $today = date("Y-m-d h:i:s");
        $registration = date("Y-m-d");
        $info_auth = DB::table("users")->where("id","=",Auth::id())->first();

        Facture::create([

            'nom_titulaire' => $request->nom_titulaire,
            'tel_titulaire' => $request->tel_titulaire,
            'id_type_depot' => $id_type_depot,
            'date_retrait' => $today,
            'id_editor' => Auth::id(),
            'id_company' => $info_auth->id_user_action,
            'registration' => $registration,

        ]);

        return redirect()->route('listeFactureClassic')->with("message","Facture enregistré avec succès!");

    }


    public function putFactureClassic(Facture $facture, postFactureRequest $request){

        $facture->nom_titulaire = $request->nom_titulaire;
        $facture->tel_titulaire = $request->tel_titulaire;

        $facture -> save();

        return redirect()->route('modifyFactureClassic',['facture' => $facture->id])->with("message","Facture modifié avec succès!");

    }

    public function putFactureNombre(Facture $facture, postFactureRequest $request){

        $facture->nom_titulaire = $request->nom_titulaire;
        $facture->tel_titulaire = $request->tel_titulaire;

        $facture -> save();

        return redirect()->route('modifyFactureNombre',['facture' => $facture->id])->with("message","Facture modifié avec succès!");

    }


    public function putFacturePoids(Facture $facture, postFactureRequest $request){

        $facture->nom_titulaire = $request->nom_titulaire;
        $facture->tel_titulaire = $request->tel_titulaire;

        $facture -> save();

        return redirect()->route('modifyFacturePoids',['facture' => $facture->id])->with("message","Facture modifié avec succès!");

    }


    public function postFacture(Request $request){

        Facture::create([

            'nom_titulaire' => $request->nom_titulaire,
            'tel_titulaire' => $request->tel_titulaire,
            'id_type_depot' => $request->id_type_depot,

        ]);

        return redirect()->route('listeFactures')->with("message","Facture enregistré avec succès!");

    }


    public function editFacture(Facture $facture):View{

        $info_type_depot = DB::table('depots')->where("id","=",$facture->id_type_depot)->first();
        $today = date("Y-m-d");
        $time = date("h:i:s");
        $date_limit1 = date("h:i:s",strtotime('+ 4 hours'));
        $date_limit2 = date("h:i:s",strtotime('+ 9 hours'));
        $date_limit3 = date("Y-m-d",strtotime('+ 1 day'));
        $date_limit4 = date("Y-m-d",strtotime('+ 2 days'));
        $date_limit5 = date("Y-m-d",strtotime('+ 3 days'));

        $vetements = DB::table("vetements")->get();
        $couleurs = DB::table("couleur_vets")->get();
        $caracts = DB::table("specification_vets")->get();

        return view("factures/edit",[

            "info_type_depot" => $info_type_depot,
            "today" => $today,
            "date_limit1" => $date_limit1,
            "date_limit2" => $date_limit2,
            "date_limit3" => $date_limit3,
            "date_limit4" => $date_limit4,
            "date_limit5" => $date_limit5,
            "vetements" => $vetements,
            "couleurs" => $couleurs,
            "caracts" => $caracts,
            "facture" => $facture,

        ]);

    }


    public function editFacturePoids(Facture $facture):View{

        $infos_auth = DB::table("users")->where("id","=",Auth::id())->first();
        $today = date("Y-m-d");
        $vetements = DB::table("vetements")->where("id_editor","=",$infos_auth->id_user_action)->where("id_pack","=",0)->where("id_service","=",0)->get();
        $couleurs = DB::table("couleur_vets")->where("id_editor","=",$infos_auth->id_user_action)->get();
        $caracts = DB::table("specification_vets")->where("id_editor","=",$infos_auth->id_user_action)->get();
        $vet_recept = DB::table("recepts")->where("id_facture","=",$facture->id)->value("id");
        $cat_vets = DB::table("categorie_vets")->where("id_editor","=",$infos_auth->id_user_action)->where("id_pack","=",0)->get();
        $quality_vets = DB::table("quality_vetements")->where("id_gerant","=",$infos_auth->id_user_action)->where("id_pack","=",0)->get();

        $vet_recepts = DB::table("recepts")->where("id_facture","=",$facture->id)->get();

        $nbr_vets = count($vet_recepts);

        return view("factures/poids/edit",[

            "today" => $today,
            "vetements" => $vetements,
            "couleurs" => $couleurs,
            "caracts" => $caracts,
            "facture" => $facture,
            "nbr_vets" => $nbr_vets,
            "vet_recept" => $vet_recept,
            "cat_vets" => $cat_vets,
            "quality_vets" => $quality_vets,

        ]);

    }


    public function editFactureNombre(Facture $facture):View{

        $infos_auth = DB::table("users")->where("id","=",Auth::id())->first();
        $today = date("Y-m-d");
        $vetements = DB::table("vetements")->where("id_editor","=",$infos_auth->id_user_action)->where("id_pack","=",0)->where("id_service","=",0)->get();
        $couleurs = DB::table("couleur_vets")->where("id_editor","=",$infos_auth->id_user_action)->get();
        $caracts = DB::table("specification_vets")->where("id_editor","=",$infos_auth->id_user_action)->get();
        $vet_recept = DB::table("recepts")->where("id_facture","=",$facture->id)->value("id");
        $cat_vets = DB::table("categorie_vets")->where("id_editor","=",$infos_auth->id_user_action)->where("id_pack","=",0)->get();
        $quality_vets = DB::table("quality_vetements")->where("id_gerant","=",$infos_auth->id_user_action)->where("id_pack","=",0)->get();

        $vet_recepts = DB::table("recepts")->where("id_facture","=",$facture->id)->get();

        $nbr_vets = count($vet_recepts);

        return view("factures/nombre/edit",[

            "today" => $today,
            "vetements" => $vetements,
            "couleurs" => $couleurs,
            "caracts" => $caracts,
            "facture" => $facture,
            "vet_recept" => $vet_recept,
            "cat_vets" => $cat_vets,
            "nbr_vets" => $nbr_vets,
            "quality_vets" => $quality_vets,


        ]);

    }


    public function editFactureClassic(Facture $facture):View{

        $today = date("Y-m-d");
        $infos_auth = DB::table("users")->where("id","=",Auth::id())->first();
        $vetements = DB::table("vetements")->where("id_editor","=",$infos_auth->id_user_action)->where("id_pack","=",0)->where("id_service","=", 0)->get();
        $couleurs = DB::table("couleur_vets")->where("id_editor","=",$infos_auth->id_user_action)->get();
        $caracts = DB::table("specification_vets")->where("id_editor","=",$infos_auth->id_user_action)->get();
        $vet_recept = DB::table("recepts")->where("id_facture","=",$facture->id)->value("id");
        $cat_vets = DB::table("categorie_vets")->where("id_editor","=",$infos_auth->id_user_action)->where("id_pack","=",0)->get();
        $quality_vets = DB::table("quality_vetements")->where("id_gerant","=",$infos_auth->id_user_action)->where("id_pack","=",0)->get();

        return view("factures/classic/edit",[

            "today" => $today,
            "vetements" => $vetements,
            "couleurs" => $couleurs,
            "caracts" => $caracts,
            "facture" => $facture,
            "vet_recept" => $vet_recept,
            "cat_vets" => $cat_vets,
            "quality_vets" => $quality_vets,

        ]);

    }


    public function modifyFactureClassic(Facture $facture):View{

        return view("factures/classic/modify",[

            "facture" => $facture,

        ]);

    }


    public function modifyFactureNombre(Facture $facture):View{

        return view("factures/nombre/modify",[

            "facture" => $facture,

        ]);

    }


    public function modifyFacturePoids(Facture $facture):View{

        return view("factures/poids/modify",[

            "facture" => $facture,

        ]);

    }


    public function editDetailsRecept(Facture $facture, Request $request){

        $type_depot = DB::table('depots')->where("id","=",$facture->id_type_depot)->first();

        if($facture->id_type_depot == 0){

            $montant_total = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix');

            $facture->avance = $request->avance;
            $facture->montant = $montant_total;

            if($request->avance == 0){
                $facture->reste = $montant_total;
            }

            if($request->avance == 1){

                $avance = $montant_total/4;
                $reste = $montant_total-$avance;

                $facture->reste = $reste;

            }
            if($request->avance == 2){

                $avance = $montant_total/3;
                $reste = $montant_total-$avance;

                $facture->reste = $reste;

            }
            if($request->avance == 3){

                $avance = $montant_total/2;
                $reste = $montant_total-$avance;

                $facture->reste = $reste;

            }
            if($request->avance == 4){

                $avance = $montant_total*3;
                $result_avance = $avance/4;
                $reste = $montant_total-$result_avance;

                $facture->reste = $reste;

            }
            if($request->avance == 5){
                $facture->reste = 0;
            }

            $facture->etat_livraison = $request->etat_livraison;

            if($facture->reste == 0){

                $facture->statut_facture = "Régler";

            }else{

                $facture->statut_facture = "Non régler";

            }

            $facture->date_retrait = $request->date_retrait;

            $facture->etat_traitement = "Depot";

            $facture->save();

            return redirect()->route("receptFactureClassic",["facture" => $facture->id])->with("message","Informations enregistrées avec succès!");

        }

        if($facture->id_type_depot == $type_depot->id and $type_depot->type_depot == "nombre"){

            $type_depot = DB::table('depots')->where("id","=",$facture->id_type_depot)->first();

            $facture->avance = $request->avance;
            $facture->montant = $type_depot->prix_depot;

            if($request->avance == 0){
                $facture->reste = $type_depot->prix_depot;
            }

            if($request->avance == 1){

                $avance = $type_depot->prix_depot/4;
                $reste = $type_depot->prix_depot-$avance;

                $facture->reste = $reste;

            }
            if($request->avance == 2){

                $avance = $type_depot->prix_depot/3;
                $reste = $type_depot->prix_depot-$avance;

                $facture->reste = $reste;

            }
            if($request->avance == 3){

                $avance = $type_depot->prix_depot/2;
                $reste = $type_depot->prix_depot-$avance;

                $facture->reste = $reste;

            }
            if($request->avance == 4){

                $avance = $type_depot->prix_depot*3;
                $result_avance = $avance/4;
                $reste = $type_depot->prix_depot-$result_avance;

                $facture->reste = $reste;

            }

            if($request->avance == 5){
                $facture->reste = 0;
            }

            $facture->etat_livraison = $request->etat_livraison;

            if($facture->reste == 0){

                $facture->statut_facture = "Régler";

            }else{

                $facture->statut_facture = "Non régler";

            }

            $facture->date_retrait = $request->date_retrait;

            $facture->etat_traitement = "Depot";

            $facture->save();

            return redirect()->route("receptFactureNombre",["facture" => $facture->id])->with("message","Informations enregistrées avec succès!");


        }


        if($facture->id_type_depot == $type_depot->id and $type_depot->type_depot == "poids"){

            $type_depot = DB::table('depots')->where("id","=",$facture->id_type_depot)->first();

            $facture->avance = $request->avance;
            $facture->montant = $type_depot->prix_depot;

            if($request->avance == 0){
                $facture->reste = $type_depot->prix_depot;
            }

            if($request->avance == 1){

                $avance = $type_depot->prix_depot/4;
                $reste = $type_depot->prix_depot-$avance;

                $facture->reste = $reste;

            }
            if($request->avance == 2){

                $avance = $type_depot->prix_depot/3;
                $reste = $type_depot->prix_depot-$avance;

                $facture->reste = $reste;

            }
            if($request->avance == 3){

                $avance = $type_depot->prix_depot/2;
                $reste = $type_depot->prix_depot-$avance;

                $facture->reste = $reste;

            }
            if($request->avance == 4){

                $avance = $type_depot->prix_depot*3;
                $result_avance = $avance/4;
                $reste = $type_depot->prix_depot-$result_avance;

                $facture->reste = $reste;

            }

            if($request->avance == 5){
                $facture->reste = 0;
            }

            $facture->etat_livraison = $request->etat_livraison;

            if($facture->reste == 0){

                $facture->statut_facture = "Régler";

            }else{

                $facture->statut_facture = "Non régler";

            }

            $facture->date_retrait = $request->date_retrait;

            $facture->etat_traitement = "Depot";

            $facture->save();

            return redirect()->route("receptFacturePoids",["facture" => $facture->id])->with("message","Informations enregistrées avec succès!");


        }


    }


    public function detailFactureGerant(Facture $facture):View{

        $today = date("Y-m-d");
        $liste_vet_recepts = DB::table("recepts")->where('id_facture','=',$facture->id)->where("id_company","=",Auth::id())->get();
        $infos_receptionist = DB::table("users")->where("id","=",$facture->id_editor)->first();
        $etat_tache_reception = DB::table('taches')->where("type_tache","=","reception")->where("id_executant","=",$facture->id_editor)->first();
        $etat_tache_lavage = DB::table('taches')->where("type_tache","=","lavage")->where("id_facture","=",$facture->id)->where("id_create_tache","=",Auth::id())->first();
        $etat_tache_repassage = DB::table('taches')->where("type_tache","=","repassage")->where("id_facture","=",$facture->id)->where("id_create_tache","=",Auth::id())->first();
        $etat_tache_livraison = DB::table('taches')->where("type_tache","=","livraison")->where("id_facture","=",$facture->id)->where("id_create_tache","=",Auth::id())->first();
        $total_vets = DB::table("recepts")->where('id_facture','=',$facture->id)->where("id_company","=",Auth::id())->sum("qte_vet");
        $total_prix_unit_vets = DB::table("recepts")->where('id_facture','=',$facture->id)->where("id_company","=",Auth::id())->sum("prix_unitaire");
        $total_prix_vets = DB::table("recepts")->where('id_facture','=',$facture->id)->where("id_company","=",Auth::id())->sum("prix");



        if($facture->etat_livraison == "Oui"){

            $info_livraisons = DB::table("livraisons")->where('id_facture','=',$facture->id)->where("id_company","=",Auth::id())->latest()->first();
            $commune_livraison = DB::table("communes")->where('id','=',$info_livraisons->id_commune)->where("id_company","=",Auth::id())->first();
            $quartier_livraison = DB::table("quartiers")->where('id','=',$info_livraisons->id_quartier)->where("id_company","=",Auth::id())->first();
            $adresse_livraison = DB::table("adresses")->where('id','=',$info_livraisons->id_adresse)->where("id_company","=",Auth::id())->first();
            $prix_livraison = DB::table("prices")->where('id','=',$info_livraisons->id_prix)->where("id_company","=",Auth::id())->first();

            return view("factures/alls/detail1",[

                "total_vets" => $total_vets,
                "today" => $today,
                "facture" => $facture,
                "liste_vet_recepts" => $liste_vet_recepts,
                "infos_receptionist" => $infos_receptionist,
                "etat_tache_reception" => $etat_tache_reception,
                "etat_tache_repassage" => $etat_tache_repassage,
                "etat_tache_livraison" => $etat_tache_livraison,
                "etat_tache_lavage" => $etat_tache_lavage,
                "total_prix_unit_vets" => $total_prix_unit_vets,
                "total_prix_vets" => $total_prix_vets,
                "info_livraisons" => $info_livraisons,
                "commune_livraison" => $commune_livraison,
                "quartier_livraison" => $quartier_livraison,
                "adresse_livraison" => $adresse_livraison,
                "prix_livraison" => $prix_livraison,


            ]);


        }else{


            return view("factures/alls/detail2",[

                "total_vets" => $total_vets,
                "today" => $today,
                "facture" => $facture,
                "liste_vet_recepts" => $liste_vet_recepts,
                "infos_receptionist" => $infos_receptionist,
                "etat_tache_reception" => $etat_tache_reception,
                "etat_tache_repassage" => $etat_tache_repassage,
                "etat_tache_livraison" => $etat_tache_livraison,
                "etat_tache_lavage" => $etat_tache_lavage,
                "total_prix_unit_vets" => $total_prix_unit_vets,
                "total_prix_vets" => $total_prix_vets,


            ]);


        }



    }


    public function modifyFactureGerant(Facture $facture):View{

        return view("factures/alls/modify",[

            "facture" => $facture,

        ]);

    }



    public function putFactureGerant(Facture $facture, postFactureRequest $request){

        $facture->nom_titulaire = $request->nom_titulaire;
        $facture->tel_titulaire = $request->tel_titulaire;

        $facture->save();

        return Redirect()->route("modifyFactureGerant",["facture" => $facture->id])->with('message',"Mise à jour réussit!");

    }


    public function deleteFactureGerant(Facture $facture){

        $facture->delete();

        return Redirect()->route("listeAllFacture",["facture" => $facture->id])->with('message',"Mise à jour réussit!");

    }



    public function deleteAllFactureGerant(){

        DB::table("factures")->where("id_company","=",Auth::id())->delete();

        return Redirect()->route("listeAllFacture")->with('message',"Nettoyage effectué avec succès!");

    }












    public function detailFactureReceptionist(Facture $facture):View{

        $today = date("Y-m-d");
        $liste_vet_recepts = DB::table("recepts")->where('id_facture','=',$facture->id)->where("id_service","=",$facture->id_service)->get();
        $infos_receptionist = DB::table("users")->where("id","=",$facture->id_editor)->first();
        $etat_tache_reception = DB::table('taches')->where("type_tache","=","reception")->where("id_executant","=",$facture->id_editor)->first();
        $etat_tache_lavage = DB::table('taches')->where("type_tache","=","lavage")->where("id_facture","=",$facture->id)->where("id_create_tache","=",Auth::id())->first();
        $etat_tache_repassage = DB::table('taches')->where("type_tache","=","repassage")->where("id_facture","=",$facture->id)->where("id_create_tache","=",Auth::id())->first();
        $etat_tache_livraison = DB::table('taches')->where("type_tache","=","livraison")->where("id_facture","=",$facture->id)->where("id_create_tache","=",Auth::id())->first();
        $total_vets = DB::table("recepts")->where('id_facture','=',$facture->id)->where("id_service","=",$facture->id_service)->sum("qte_vet");
        $total_prix_unit_vets = DB::table("recepts")->where('id_facture','=',$facture->id)->where("id_service","=",$facture->id_service)->sum("prix_unitaire");
        $total_prix_vets = DB::table("recepts")->where('id_facture','=',$facture->id)->where("id_service","=",$facture->id_service)->sum("prix");
        $avance = $facture->montant - $facture->reste;

        $info_livraison = DB::table("livraisons")->where('id_facture','=',$facture->id)->where("id_company","=",$infos_receptionist->id_user_action)->latest()->first();

        if($info_livraison){

            $commune_livraison = DB::table("communes")->where('id','=',$info_livraison->id_commune)->where("id_company","=",$infos_receptionist->id_user_action)->first();
            $quartier_livraison = DB::table("quartiers")->where('id','=',$info_livraison->id_quartier)->where("id_company","=",$infos_receptionist->id_user_action)->first();
            $adresse_livraison = DB::table("adresses")->where('id','=',$info_livraison->id_adresse)->where("id_company","=",$infos_receptionist->id_user_action)->first();
            $prix_livraison = DB::table("prices")->where('id','=',$info_livraison->id_prix)->where('id_company','=',$infos_receptionist->id_user_action)->value("valeur_prix");

            return view("factures/receptionists/detail_1",[

                "total_vets" => $total_vets,
                "today" => $today,
                "facture" => $facture,
                "liste_vet_recepts" => $liste_vet_recepts,
                "infos_receptionist" => $infos_receptionist,
                "etat_tache_reception" => $etat_tache_reception,
                "etat_tache_repassage" => $etat_tache_repassage,
                "etat_tache_livraison" => $etat_tache_livraison,
                "etat_tache_lavage" => $etat_tache_lavage,
                "total_prix_unit_vets" => $total_prix_unit_vets,
                "total_prix_vets" => $total_prix_vets,
                "info_livraison" => $info_livraison,

                "commune_livraison" => $commune_livraison,
                "quartier_livraison" => $quartier_livraison,
                "adresse_livraison" => $adresse_livraison,
                "prix_livraison" => $prix_livraison,

                "avance" => $avance,


            ]);


        }else{

            return view("factures/receptionists/detail_2",[

                "total_vets" => $total_vets,
                "today" => $today,
                "facture" => $facture,
                "liste_vet_recepts" => $liste_vet_recepts,
                "infos_receptionist" => $infos_receptionist,
                "etat_tache_reception" => $etat_tache_reception,
                "etat_tache_repassage" => $etat_tache_repassage,
                "etat_tache_livraison" => $etat_tache_livraison,
                "etat_tache_lavage" => $etat_tache_lavage,
                "total_prix_unit_vets" => $total_prix_unit_vets,
                "total_prix_vets" => $total_prix_vets,
                "avance" => $avance,

            ]);

        }




    }




    public function detailFactureClient(Facture $facture):View{

        $today = date("Y-m-d");
        $liste_vet_recepts = DB::table("recepts")->where('id_facture','=',$facture->id)->where("id_service","=",$facture->id_service)->get();
        $infos_receptionist = DB::table("users")->where("id","=",$facture->id_editor)->first();
        $etat_tache_reception = DB::table('taches')->where("type_tache","=","reception")->where("id_executant","=",$facture->id_editor)->first();
        $etat_tache_lavage = DB::table('taches')->where("type_tache","=","lavage")->where("id_facture","=",$facture->id)->where("id_create_tache","=",Auth::id())->first();
        $etat_tache_repassage = DB::table('taches')->where("type_tache","=","repassage")->where("id_facture","=",$facture->id)->where("id_create_tache","=",Auth::id())->first();
        $etat_tache_livraison = DB::table('taches')->where("type_tache","=","livraison")->where("id_facture","=",$facture->id)->where("id_create_tache","=",Auth::id())->first();
        $total_vets = DB::table("recepts")->where('id_facture','=',$facture->id)->where("id_service","=",$facture->id_service)->sum("qte_vet");
        $total_prix_unit_vets = DB::table("recepts")->where('id_facture','=',$facture->id)->where("id_service","=",$facture->id_service)->sum("prix_unitaire");
        $total_prix_vets = DB::table("recepts")->where('id_facture','=',$facture->id)->where("id_service","=",$facture->id_service)->sum("prix");
        $avance = $facture->montant - $facture->reste;

        $info_livraison = DB::table("livraisons")->where('id_facture','=',$facture->id)->where("id_company","=",$infos_receptionist->id_user_action)->latest()->first();

        if($info_livraison){

            $commune_livraison = DB::table("communes")->where('id','=',$info_livraison->id_commune)->where("id_company","=",$infos_receptionist->id_user_action)->first();
            $quartier_livraison = DB::table("quartiers")->where('id','=',$info_livraison->id_quartier)->where("id_company","=",$infos_receptionist->id_user_action)->first();
            $adresse_livraison = DB::table("adresses")->where('id','=',$info_livraison->id_adresse)->where("id_company","=",$infos_receptionist->id_user_action)->first();
            $prix_livraison = DB::table("prices")->where('id','=',$info_livraison->id_prix)->where('id_company','=',$infos_receptionist->id_user_action)->value("valeur_prix");

            return view("factures/clients/detail_1",[

                "total_vets" => $total_vets,
                "today" => $today,
                "facture" => $facture,
                "liste_vet_recepts" => $liste_vet_recepts,
                "infos_receptionist" => $infos_receptionist,
                "etat_tache_reception" => $etat_tache_reception,
                "etat_tache_repassage" => $etat_tache_repassage,
                "etat_tache_livraison" => $etat_tache_livraison,
                "etat_tache_lavage" => $etat_tache_lavage,
                "total_prix_unit_vets" => $total_prix_unit_vets,
                "total_prix_vets" => $total_prix_vets,
                "info_livraison" => $info_livraison,

                "commune_livraison" => $commune_livraison,
                "quartier_livraison" => $quartier_livraison,
                "adresse_livraison" => $adresse_livraison,
                "prix_livraison" => $prix_livraison,

                "avance" => $avance,


            ]);


        }else{

            return view("factures/clients/detail_2",[

                "total_vets" => $total_vets,
                "today" => $today,
                "facture" => $facture,
                "liste_vet_recepts" => $liste_vet_recepts,
                "infos_receptionist" => $infos_receptionist,
                "etat_tache_reception" => $etat_tache_reception,
                "etat_tache_repassage" => $etat_tache_repassage,
                "etat_tache_livraison" => $etat_tache_livraison,
                "etat_tache_lavage" => $etat_tache_lavage,
                "total_prix_unit_vets" => $total_prix_unit_vets,
                "total_prix_vets" => $total_prix_vets,
                "avance" => $avance,

            ]);

        }




    }
























    public function putEtatFacture(Facture $facture, Request $request){

        $info_user = DB::table("users")->where("id","=",Auth::id())->first();

        if($info_user->role === "gerant"){

            $facture->statut_facture = $request->statut_facture;
            $facture->reste = 0;

            $facture -> save();

            return redirect()->route("listeAllFacture",['facture' => $facture->id])->with("message","Facture reglée!");

        }

        if($info_user->role === "receptionniste"){

            $facture->statut_facture = $request->statut_facture;
            $facture->reste = 0;

            $facture -> save();

            return redirect()->route("listeMyFacture",['facture' => $facture->id])->with("message","Facture reglée!!");

        }



    }


    public function gerantPutEtatLivraison(Facture $facture, Request $request){

        $facture->etat_livraison = $request->etat_livraison;

        $facture ->save();

        return redirect()->route("detailFactureGerant",['facture' => $facture->id])->with('message',"Livraison annulé avec succès!");
    }



    public function receptionistPutEtatLivraison(Facture $facture, Request $request){

        $facture->etat_livraison = $request->etat_livraison;

        DB::table("livraisons")->where("id_facture","=",$facture->id)->delete();

        $facture ->save();

        return redirect()->route("detailFactureReceptionist",['facture' => $facture->id])->with('message',"Livraison annulé avec succès!");
    }



    public function clientPutEtatLivraison(Facture $facture, Request $request){

        $facture->etat_livraison = $request->etat_livraison;

        $facture ->save();

        return redirect()->route("detailFactureClient",['facture' => $facture->id])->with('message',"Livraison annulé avec succès!");

    }




//bloc programmation de facture

    public function receptionistProgrammingLivraison(Facture $facture) : View {

        $communes = DB::table("communes")->where("id_company","=",$facture->id_company)->get();
        $quartiers = DB::table("quartiers")->where("id_company","=",$facture->id_company)->get();
        $adresses = DB::table("adresses")->where("id_company","=",$facture->id_company)->get();
        $prices = DB::table("prices")->where("id_company","=",$facture->id_company)->get();

        return view("factures/receptionists/programming/livraison/form",[

            "facture" => $facture,
            "communes" => $communes,
            "quartiers" => $quartiers,
            "adresses" => $adresses,
            "prices" => $prices,

        ]);

    }



    public function postCommuneProgramming(Facture $facture, postCommuneRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Commune::create([

            "nom_commune" => $request->nom_commune,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('receptionistProgrammingLivraison',['facture' => $facture])->with('message',"Commune ajouté avec succès!");

    }



    public function postQuartierProgramming(Facture $facture, postQuartierRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Quartier::create([

            "nom_quartier" => $request->nom_quartier,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('receptionistProgrammingLivraison',['facture' => $facture])->with('message',"Quartier ajouté avec succès!");

    }


    public function postAdresseProgramming(Facture $facture, postAdresseRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Adresse::create([

            "nom_adresse" => $request->nom_adresse,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('receptionistProgrammingLivraison',['facture' => $facture])->with('message',"Adresse ajouté avec succès!");

    }


    public function postPrixProgramming(Facture $facture, postPrixRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Price::create([

            "valeur_prix" => $request->valeur_prix,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('receptionistProgrammingLivraison',['facture' => $facture])->with('message',"Prix ajouté avec succès!");

    }



    public function postLivraisonProgramming(Facture $facture, postLivraisonRequest $request){

        $today = date("Y-m-d");
        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();
        $fais = DB::table("prices")->where("id","=",$request->id_prix)->where("id_company","=",$info_receptionist->id_user_action)->value("valeur_prix");

        Livraison::create([

            'nom_destinataire' => $request->nom_destinataire,
            'tel_destinataire' => $request->tel_destinataire,
            'date_livraison' => $request->date_livraison,
            'heure_livraison' => $request->heure_livraison,
            'registration' => $today,
            'frais' => $fais,
            'id_commune' => $request->id_commune,
            'id_quartier' => $request->id_quartier,
            'id_adresse' => $request->id_adresse,
            'id_prix' => $request->id_prix,
            'id_facture' => $facture->id,
            'id_company' => $info_receptionist->id_user_action,

        ]);

        $facture->etat_livraison = "Oui";

        $facture -> save();

        return redirect()->route('receptionistProgrammingLivraison',['facture' => $facture])->with('message',"Livraison programmer avec succès!");

    }



}
