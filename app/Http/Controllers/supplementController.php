<?php

namespace App\Http\Controllers;

use App\Http\Requests\modifyVetClassicRequest;
use App\Http\Requests\optCatVetPostRequest;
use App\Http\Requests\optColorPostRequest;
use App\Http\Requests\optQualityVetPostRequest;
use App\Http\Requests\optSpVetPostRequest;
use App\Http\Requests\optVetPostRequest;
use App\Http\Requests\postAdresseRequest;
use App\Http\Requests\postCommuneRequest;
use App\Http\Requests\postFactureRequest;
use App\Http\Requests\postFactureServiceRequest;
use App\Http\Requests\postLivraisonRequest;
use App\Http\Requests\postPrixRequest;
use App\Http\Requests\postQuartierRequest;
use App\Http\Requests\receptPostRequest;
use App\Models\Adresse;
use App\Models\Categorie_vet;
use App\Models\Commune;
use App\Models\Couleur_vet;
use App\Models\Facture;
use App\Models\Livraison;
use App\Models\Price;
use App\Models\Quality_vetement;
use App\Models\Quartier;
use App\Models\Recept;
use App\Models\Service;
use App\Models\Specification_vet;
use App\Models\Vetement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class supplementController extends Controller
{
    //

    public function listeSupplements():View{

        $infos_user = DB::table('users')->where("id","=",Auth::id())->first();

        $liste_services = DB::table('services')->where('id_gerant','=',$infos_user->id_user_action)->paginate(3);


        return view("supplements/liste",[

            "liste_services" => $liste_services,

        ]);

    }


    public function receptionistEditFacture(Service $service):View{

        $liste_factures = DB::table('factures')->where('id_editor','=',Auth::id())->where('id_service',"=", $service->id)->paginate(10);

        $nbrfactures = DB::table('factures')->where('id_editor','=',Auth::id())->where('id_service',"=", $service->id)->get();

        $vet_recept_supplement = DB::table('recepts')->where('id_receptionist','=',Auth::id())->where('id_service',"=", $service->id)->get();

        $nbr_vet_supplement = count($vet_recept_supplement);

        $count = count($nbrfactures);

        return view("supplements/receptionist/facture/liste",[

            "service" => $service,
            "liste_factures" => $liste_factures,
            "nbr_vet_supplement" => $nbr_vet_supplement,
            "count" => $count,

        ]);

    }


    public function receptionistPostFacture(Service $service, postFactureServiceRequest $request){

        $infos_user = DB::table("users")->where("id","=",Auth::id())->first();

        $today = date("Y-m-d");

        Facture::create([

            'nom_titulaire' => $request->nom_titulaire,
            'tel_titulaire' => $request->tel_titulaire,
            'id_editor' => Auth::id(),
            'id_company' => $infos_user->id_user_action,
            'id_service' => $service->id,
            'registration' => $today,

        ]);

        return redirect()->route("receptionistEditFacture",["service" => $service->id])->with('message',"Facture enregistrée avec succès!");

    }


    public function receptionistReceptVetSupplement(Facture $facture){

        $today = date("Y-m-d");
        $infos_auth = DB::table("users")->where("id","=",Auth::id())->first();
        $vetements = DB::table("vetements")->where("id_editor","=",$infos_auth->id_user_action)->where("id_service","=",$facture->id_service)->get();
        $couleurs = DB::table("couleur_vets")->where("id_editor","=",$infos_auth->id_user_action)->get();
        $caracts = DB::table("specification_vets")->where("id_editor","=",$infos_auth->id_user_action)->get();
        $vet_recept = DB::table("recepts")->where("id_facture","=",$facture->id)->where("id_service","=",$facture->id_service)->value("id");
        $cat_vets = DB::table("categorie_vets")->where("id_editor","=",$infos_auth->id_user_action)->where("id_pack","=",0)->get();
        $quality_vets = DB::table("quality_vetements")->where("id_gerant","=",$infos_auth->id_user_action)->where("id_pack","=",0)->get();

        return view("supplements/receptionist/recept/accueil",[

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


    public function receptionistModifyFactureSupplement(Facture $facture){

        return view("supplements/receptionist/facture/modify",[

            "facture" => $facture,

        ]);


    }


    public function receptionistPutFactureSupplement(Facture $facture, postFactureRequest $request){

        $facture->nom_titulaire = $request->nom_titulaire;
        $facture->tel_titulaire = $request->tel_titulaire;

        $facture -> save();

        return redirect()->route('receptionistModifyFactureSupplement',['facture' => $facture->id])->with("message","Facture modifié avec succès!");


    }



    public function receptionistlistVetReceptSupplement(Service $service, Request $request):View{

        $liste_vet_supplements = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_service","=",$service->id)->paginate(5);
        $nbr_vet_supplement = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_service","=",$service->id)->get();
        $total_qte = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_service","=",$service->id)->sum('qte_vet');
        $total_prix_unit = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_service","=",$service->id)->sum('prix_unitaire');
        $total_prix = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_service","=",$service->id)->sum('prix');

        $count = count($nbr_vet_supplement);

        if($request->filled('search')){

            $liste_vet_supplements = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_service","=",$service->id)->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->paginate(10);

            $nbr_vet_supplement = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_service","=",$service->id)->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->get();

            $total_qte = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_service","=",$service->id)->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->sum('qte_vet');

            $total_prix_unit = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_service","=",$service->id)->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->sum('prix_unitaire');

            $total_prix = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_service","=",$service->id)->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->sum('prix');

            $count = count($nbr_vet_supplement);

        }else{

            $liste_vet_supplements = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_service","=",$service->id)->paginate(5);

        }


        return view("supplements/receptionist/facture/show",[

            "service" => $service,
            "liste_vet_supplements" => $liste_vet_supplements,
            "total_qte" => $total_qte,
            "total_prix_unit" => $total_prix_unit,
            "total_prix" => $total_prix,
            "count" => $count,

        ]);

    }



    public function receptionistPostVetSupplement(Facture $facture, receptPostRequest $request){

        $today = date("Y-m-d");

        $id_user_action = DB::table("users")->where("id","=",Auth::id())->value("id_user_action");
        $prix_unitaire = DB::table('vetements')->where('nom_vet','=',$request->nom_vet)->where('id_service','=',$facture->id_service)->first();
        $cat_vet = DB::table('categorie_vets')->where('id','=',$prix_unitaire->id_cat_vet)->first();
        $prix = $prix_unitaire->prix_vet * $request->qte_vet;

        Recept::create([

            'nom_vet' => $request->nom_vet,
            'color_vet' => $request->color_vet,
            'caract_vet' => $request->caract_vet,
            'cat_vet' => $cat_vet->nom_cat_vet,
            'qte_vet' => $request->qte_vet,
            'prix_unitaire' => $prix_unitaire->prix_vet,
            'prix' => $prix,
            'quality_vet' => $request->quality_vet,
            'id_facture' => $facture->id,
            'id_receptionist' => Auth::id(),
            'id_company' => $id_user_action,
            'id_service' => $facture->id_service,
            "nom_client" => $facture->nom_titulaire,
            "tel_client" => $facture->tel_titulaire,
            "registration" => $today,

        ]);

        return redirect()->route('receptionistReceptVetSupplement',['facture'=>$facture->id])->with("message","Vêtements receptionné avec succès!");

    }


    public function receptionistPostOptionVetSupplement(Facture $facture, optVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Vetement::create([

            "nom_vet" => $request->nom_vet,
            "prix_vet" => $request->prix_vet,
            "id_cat_vet" => $request->id_cat_vet,
            "id_editor" => $infos_auth->id_user_action,
            "id_service" => $facture->id_service,

        ]);

        return redirect()->route('receptionistReceptVetSupplement',["facture" => $facture->id])->with("message","Vêtements ajouté!");

    }



    public function receptionistPostOptionColorSupplement(Facture $facture, optColorPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Couleur_vet::create([

            "nom_couleur_vet" => $request->nom_couleur_vet,
            "id_editor" => $infos_auth->id_user_action,

        ]);

        return redirect()->route('receptionistReceptVetSupplement',["facture" => $facture->id])->with("message","Couleur ajouté!");

    }


    public function receptionistPostOptionSpVetSupplement(Facture $facture, optSpVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Specification_vet::create([

            "nom_specification_vet" => $request->nom_specification_vet,
            "id_editor" => $infos_auth->id_user_action,

        ]);

        return redirect()->route('receptionistReceptVetSupplement',["facture" => $facture->id])->with("message","Spécification ajouté!");

    }


    public function receptionistPostOptionCatVetSupplement(Facture $facture, optCatVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Categorie_vet::create([

            "nom_cat_vet" => strtoupper($request->nom_cat_vet),
            "id_editor" => $infos_auth->id_user_action,
            "id_pack" => 0,

        ]);

        return redirect()->route('receptionistReceptVetSupplement',["facture" => $facture->id])->with("message","Catégorie ajouté!");

    }



    public function receptionistPostOptionQualityVetSupplement(Facture $facture, optQualityVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Quality_vetement::create([

            "nom" => $request->nom,
            "description_quality" => $request->description_quality,
            "id_gerant" => $infos_auth->id_user_action,
            "id_pack" => 0,

        ]);

        return redirect()->route('receptionistReceptVetSupplement',["facture" => $facture->id])->with("message","Qualité ajoutée!");

    }



    public function receptionistReceptFactureSupplement(Facture $facture):View{

        $liste_recept_supplements = DB::table("recepts")->where("id_facture","=",$facture->id)->get();
        $total_qte = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('qte_vet');
        $total_prix_unit = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix_unitaire');
        $total_prix = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix');
        $date_recept = DB::table("recepts")->where("id_facture","=",$facture->id)->first();
        $today = date("Y-m-d");
        $type_service=DB::table("services")->where("id","=",$facture->id_service)->first();
        $infos_livraison = DB::table("livraisons")->where("id_facture","=",$facture->id)->latest()->first();

        return view("supplements/receptionist/facture/detail",[

            "liste_recept_supplements" => $liste_recept_supplements,
            "total_qte" => $total_qte,
            "total_prix_unit" => $total_prix_unit,
            "total_prix" => $total_prix,
            "facture" => $facture,
            "type_service" => $type_service,
            "date_recept" => $date_recept,
            "facture" => $facture,
            "today" => $today,
            "infos_livraison" => $infos_livraison,


        ]);

    }



    public function receptionistEditDetailsReceptSupplement(Facture $facture, Request $request){

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

            return redirect()->route("receptionistReceptFactureSupplement",["facture" => $facture->id])->with("message","Informations enregistrées avec succès!");

    }



    public function receptionistlisteLivraisonSupplement(Facture $facture) : View {

        $infos_livraison = DB::table('livraisons')->where("id_facture","=",$facture->id)->first();

        if($infos_livraison){

            $communes = DB::table("communes")->where("id_editor","=",Auth::id())->where("id_company","=",$facture->id_company)->get();
            $quartiers = DB::table("quartiers")->where("id_editor","=",Auth::id())->where("id_company","=",$facture->id_company)->get();
            $adresses = DB::table("adresses")->where("id_editor","=",Auth::id())->where("id_company","=",$facture->id_company)->get();
            $prices = DB::table("prices")->where("id_editor","=",Auth::id())->where("id_company","=",$facture->id_company)->get();

            return view("supplements/receptionist/livraisons/modify",[

                "facture" => $facture,
                "communes" => $communes,
                "quartiers" => $quartiers,
                "adresses" => $adresses,
                "prices" => $prices,
                "infos_livraison" => $infos_livraison,

            ]);

        }else{

            $communes = DB::table("communes")->where("id_editor","=",Auth::id())->where("id_company","=",$facture->id_company)->get();
            $quartiers = DB::table("quartiers")->where("id_editor","=",Auth::id())->where("id_company","=",$facture->id_company)->get();
            $adresses = DB::table("adresses")->where("id_editor","=",Auth::id())->where("id_company","=",$facture->id_company)->get();
            $prices = DB::table("prices")->where("id_editor","=",Auth::id())->where("id_company","=",$facture->id_company)->get();

            return view("supplements/receptionist/livraisons/accueil",[

                "facture" => $facture,
                "communes" => $communes,
                "quartiers" => $quartiers,
                "adresses" => $adresses,
                "prices" => $prices,

            ]);


        }



    }


    public function receptionistPostCommuneSupplement(Facture $facture, postCommuneRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Commune::create([

            "nom_commune" => $request->nom_commune,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('receptionistlisteLivraisonSupplement',['facture' => $facture])->with('message',"Commune ajouté avec succès!");

    }


    public function receptionistPostQuartierSupplement(Facture $facture, postQuartierRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Quartier::create([

            "nom_quartier" => $request->nom_quartier,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('receptionistlisteLivraisonSupplement',['facture' => $facture])->with('message',"Quartier ajouté avec succès!");

    }


    public function receptionistPostAdresseSupplement(Facture $facture, postAdresseRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Adresse::create([

            "nom_adresse" => $request->nom_adresse,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('receptionistlisteLivraisonSupplement',['facture' => $facture])->with('message',"Adresse ajouté avec succès!");

    }


    public function receptionistPostPrixSupplement(Facture $facture, postPrixRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Price::create([

            "valeur_prix" => $request->valeur_prix,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('receptionistlisteLivraisonSupplement',['facture' => $facture])->with('message',"Prix ajouté avec succès!");

    }


    public function receptionistPostLivraisonSupplement(Facture $facture, postLivraisonRequest $request){

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

        return redirect()->route('receptionistlisteLivraisonSupplement',['facture' => $facture])->with('message',"Processus de facturation terminé. vous pouvez télécharger le reçu!");

    }


    public function receptionistPutLivraisonSupplement(Livraison $livraison, postLivraisonRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        $fais = DB::table("prices")->where("id","=",$request->id_prix)->where("id_company","=",$info_receptionist->id_user_action)->value("valeur_prix");

        $livraison -> nom_destinataire = $request->nom_destinataire;
        $livraison -> tel_destinataire = $request->tel_destinataire;
        $livraison -> date_livraison = $request->date_livraison;
        $livraison -> heure_livraison = $request->heure_livraison;
        $livraison ->frais = $fais;
        $livraison -> id_commune = $request->id_commune;
        $livraison -> id_quartier = $request->id_quartier;
        $livraison -> id_adresse = $request->id_adresse;
        $livraison -> id_prix = $request->id_prix;
        $livraison -> id_facture = $livraison->id_facture;

        $livraison -> save();

        return redirect()->route('receptionistlisteLivraisonSupplement',['facture' => $livraison->id_facture])->with('message',"Mise à jour réussit!");

    }




    public function receptionistModifyVetReceptSupplement(Recept $vetement_supplement){

        $info_recept = DB::table("users")->where("id","=",Auth::id())->first();

        $other_vetements = DB::table("vetements")->where("nom_vet","!=",$vetement_supplement->nom_vet)->where("id_editor","=",$info_recept->id_user_action)->where("id_service","=",$vetement_supplement->id_service)->get();
        $other_colors = DB::table("couleur_vets")->where("nom_couleur_vet","!=",$vetement_supplement->color_vet)->where("id_editor","=",$info_recept->id_user_action)->get();
        $other_specificats = DB::table("specification_vets")->where("nom_specification_vet","!=",$vetement_supplement->caract_vet)->where("id_editor","=",$info_recept->id_user_action)->get();
        $other_qualities = DB::table("quality_vetements")->where("nom","!=",$vetement_supplement->quality_vet)->where("id_gerant","=",$info_recept->id_user_action)->where("id_pack","=",0)->get();

        return view("supplements/receptionist/recept/modify",[

            "vetement_supplement" => $vetement_supplement,
            "other_vetements" => $other_vetements,
            "other_colors" => $other_colors,
            "other_specificats" => $other_specificats,
            "other_qualities" => $other_qualities,

        ]);


    }



    public function receptionistPutVetReceptSupplement(Recept $vetement_supplement, modifyVetClassicRequest $request){

        $info_recept = DB::table("users")->where("id","=",Auth::id())->first();

        $infos_vet = DB::table("vetements")->where("nom_vet","=",$request->nom_vet)->where("id_editor","=",$info_recept->id_user_action)->where("id_service","=",$vetement_supplement->id_service)->first();
        $cat_vet = DB::table('categorie_vets')->where("id","=",$infos_vet->id_cat_vet)->where("id_editor","=",$info_recept->id_user_action)->where("id_pack","=",0)->value("nom_cat_vet");
        $prix_total = $request->qte_vet * $infos_vet->prix_vet;

        $vetement_supplement->nom_vet = $request->nom_vet;
        $vetement_supplement->color_vet = $request->color_vet;
        $vetement_supplement->caract_vet = $request->caract_vet;
        $vetement_supplement->cat_vet = $cat_vet;
        $vetement_supplement->quality_vet = $request->quality_vet;
        $vetement_supplement->qte_vet = $request->qte_vet;
        $vetement_supplement->prix_unitaire = $infos_vet->prix_vet;
        $vetement_supplement->prix = $prix_total;

        $vetement_supplement -> save();

        return redirect()->route('receptionistModifyVetReceptSupplement',['vetement_supplement' => $vetement_supplement->id])->with("message","Mise à réussit!");

    }






}
