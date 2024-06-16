<?php

namespace App\Http\Controllers;

use App\Http\Requests\postAdresseRequest;
use App\Http\Requests\postCommuneRequest;
use App\Http\Requests\postLivraisonRequest;
use App\Http\Requests\postPrixRequest;
use App\Http\Requests\postQuartierRequest;
use App\Models\Adresse;
use App\Models\Commune;
use App\Models\Facture;
use App\Models\Livraison;
use App\Models\Price;
use App\Models\Quartier;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class livraisonController extends Controller
{
    //
    public function ListeLivraison(Request $request) : View {

        if($request->filled("search")){

            $liste_livraisons = DB::table("livraisons")->where("id_company","=",Auth::id())->whereAny([

                "nom_destinataire",
                "tel_destinataire",
                "frais",

            ],"LIKE",$request->search."%")->paginate(10);

        }else{

            $liste_livraisons = DB::table("livraisons")->where("id_company","=",Auth::id())->paginate(10);

        }



        return view("livraisons/gerants/liste",[

            "liste_livraisons" => $liste_livraisons,


        ]);

    }


    public function detailLivraison(Livraison $livraison) : View {

        $commune_livraison = DB::table("communes")->where('id','=',$livraison->id_commune)->where("id_company","=",Auth::id())->first();
        $quartier_livraison = DB::table("quartiers")->where('id','=',$livraison->id_quartier)->where("id_company","=",Auth::id())->first();
        $adresse_livraison = DB::table("adresses")->where('id','=',$livraison->id_adresse)->where("id_company","=",Auth::id())->first();
        $prix_livraison = DB::table("prices")->where('id','=',$livraison->id_prix)->where("id_company","=",Auth::id())->first();

        return view("livraisons/gerants/detail",[

            "livraison" => $livraison,
            "commune_livraison" => $commune_livraison,
            "quartier_livraison" => $quartier_livraison,
            "adresse_livraison" => $adresse_livraison,
            "prix_livraison" => $prix_livraison,


        ]);

    }



    public function listeLivraisonClassic(Facture $facture) : View {

        $communes = DB::table("communes")->where("id_company","=",$facture->id_company)->get();
        $quartiers = DB::table("quartiers")->where("id_company","=",$facture->id_company)->get();
        $adresses = DB::table("adresses")->where("id_company","=",$facture->id_company)->get();
        $prices = DB::table("prices")->where("id_company","=",$facture->id_company)->get();

        $infos_livraison = DB::table('livraisons')->where("id_facture","=",$facture->id)->first();

        if($infos_livraison){

            return view("livraisons/classic/modify",[

                "facture" => $facture,
                "communes" => $communes,
                "quartiers" => $quartiers,
                "adresses" => $adresses,
                "prices" => $prices,
                "infos_livraison" => $infos_livraison,

            ]);


        }else{

            return view("livraisons/classic/liste",[

                "facture" => $facture,
                "communes" => $communes,
                "quartiers" => $quartiers,
                "adresses" => $adresses,
                "prices" => $prices,

            ]);


        }



    }

    public function listeLivraisonNombre(Facture $facture) : View {

        $infos_auth = DB::table('users')->where('id',"=",Auth::id())->first();

        $communes = DB::table("communes")->where("id_company","=",$infos_auth->id_user_action)->get();
        $quartiers = DB::table("quartiers")->where("id_company","=",$infos_auth->id_user_action)->get();
        $adresses = DB::table("adresses")->where("id_company","=",$infos_auth->id_user_action)->get();
        $prices = DB::table("prices")->where("id_company","=",$infos_auth->id_user_action)->get();

        $infos_livraison = DB::table('livraisons')->where("id_facture","=",$facture->id)->first();

        if($infos_livraison){

            return view("livraisons/nombre/modify",[

                "facture" => $facture,
                "communes" => $communes,
                "quartiers" => $quartiers,
                "adresses" => $adresses,
                "prices" => $prices,
                "infos_livraison" => $infos_livraison,

            ]);

        }else{

            return view("livraisons/nombre/liste",[

                "facture" => $facture,
                "communes" => $communes,
                "quartiers" => $quartiers,
                "adresses" => $adresses,
                "prices" => $prices,

            ]);

        }


    }


    public function listeLivraisonPoids(Facture $facture) : View {

        $infos_auth = DB::table('users')->where('id',"=",Auth::id())->first();

        $communes = DB::table("communes")->where("id_company","=",$infos_auth->id_user_action)->get();
        $quartiers = DB::table("quartiers")->where("id_company","=",$infos_auth->id_user_action)->get();
        $adresses = DB::table("adresses")->where("id_company","=",$infos_auth->id_user_action)->get();
        $prices = DB::table("prices")->where("id_company","=",$infos_auth->id_user_action)->get();

        $infos_livraison = DB::table('livraisons')->where("id_facture","=",$facture->id)->first();

        if($infos_livraison){

            return view("livraisons/poids/modify",[

                "facture" => $facture,
                "communes" => $communes,
                "quartiers" => $quartiers,
                "adresses" => $adresses,
                "prices" => $prices,
                "infos_livraison" => $infos_livraison,

            ]);


        }else{

            return view("livraisons/poids/liste",[

                "facture" => $facture,
                "communes" => $communes,
                "quartiers" => $quartiers,
                "adresses" => $adresses,
                "prices" => $prices,

            ]);


        }


    }

//bloc classic

    public function postCommuneClassic(Facture $facture, postCommuneRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Commune::create([

            "nom_commune" => $request->nom_commune,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('listeLivraisonClassic',['facture' => $facture])->with('message',"Commune ajouté avec succès!");

    }



    public function postQuartierClassic(Facture $facture, postQuartierRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Quartier::create([

            "nom_quartier" => $request->nom_quartier,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('listeLivraisonClassic',['facture' => $facture])->with('message',"Quartier ajouté avec succès!");

    }



    public function postAdresseClassic(Facture $facture, postAdresseRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Adresse::create([

            "nom_adresse" => $request->nom_adresse,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('listeLivraisonClassic',['facture' => $facture])->with('message',"Adresse ajouté avec succès!");

    }


    public function postPrixClassic(Facture $facture, postPrixRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Price::create([

            "valeur_prix" => $request->valeur_prix,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('listeLivraisonClassic',['facture' => $facture])->with('message',"Prix ajouté avec succès!");

    }



    public function postLivraisonClassic(Facture $facture, postLivraisonRequest $request){

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

        return redirect()->route('receptFactureClassic',['facture' => $facture])->with('message',"Processus de facturation terminé. vous pouvez télécharger le reçu!");

    }



    public function putLivraisonClassic(Livraison $livraison, postLivraisonRequest $request){

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

        return redirect()->route('receptFactureClassic',['facture' => $livraison->id_facture])->with('message',"Mise à jour réussit. vous pouvez télécharger le reçu!");

    }


    //Bloc poids

    public function postCommunePoids(Facture $facture, postCommuneRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Commune::create([

            "nom_commune" => $request->nom_commune,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('listeLivraisonPoids',['facture' => $facture])->with('message',"Commune ajouté avec succès!");

    }

    public function postQuartierPoids(Facture $facture, postQuartierRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Quartier::create([

            "nom_quartier" => $request->nom_quartier,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('listeLivraisonPoids',['facture' => $facture])->with('message',"Quartier ajouté avec succès!");

    }

    public function postAdressePoids(Facture $facture, postAdresseRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Adresse::create([

            "nom_adresse" => $request->nom_adresse,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('listeLivraisonPoids',['facture' => $facture])->with('message',"Adresse ajouté avec succès!");

    }


    public function postPrixPoids(Facture $facture, postPrixRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Price::create([

            "valeur_prix" => $request->valeur_prix,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('listeLivraisonPoids',['facture' => $facture])->with('message',"Prix ajouté avec succès!");

    }

    public function postLivraisonPoids(Facture $facture, postLivraisonRequest $request){

        $today = date('Y-m-d');
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

        return redirect()->route('receptFacturePoids',['facture' => $facture])->with('message',"Processus de facturation terminé. vous pouvez télécharger le reçu!");

    }



    public function putLivraisonPoids(Livraison $livraison, postLivraisonRequest $request){

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

        return redirect()->route('receptFacturePoids',['facture' => $livraison->id_facture])->with('message',"Mise à jour réussit. vous pouvez télécharger le reçu!");

    }


    //Bloc nombre

    public function postCommuneNombre(Facture $facture, postCommuneRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Commune::create([

            "nom_commune" => $request->nom_commune,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('listeLivraisonNombre',['facture' => $facture])->with('message',"Commune ajouté avec succès!");

    }

    public function postQuartierNombre(Facture $facture, postQuartierRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Quartier::create([

            "nom_quartier" => $request->nom_quartier,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('listeLivraisonNombre',['facture' => $facture])->with('message',"Quartier ajouté avec succès!");

    }

    public function postAdresseNombre(Facture $facture, postAdresseRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Adresse::create([

            "nom_adresse" => $request->nom_adresse,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('listeLivraisonNombre',['facture' => $facture])->with('message',"Adresse ajouté avec succès!");

    }


    public function postPrixNombre(Facture $facture, postPrixRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();

        Price::create([

            "valeur_prix" => $request->valeur_prix,
            "id_editor" => Auth::id(),
            "id_company" => $info_receptionist->id_user_action,

        ]);

        return redirect()->route('listeLivraisonNombre',['facture' => $facture])->with('message',"Prix ajouté avec succès!");

    }


    public function postLivraisonNombre(Facture $facture, postLivraisonRequest $request){

        $today = date('Y-m-d');
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

        return redirect()->route('receptFactureNombre',['facture' => $facture])->with('message',"Processus de facturation terminé. vous pouvez télécharger le reçu!");

    }


    public function putLivraisonNombre(Livraison $livraison, postLivraisonRequest $request){

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

        return redirect()->route('receptFactureNombre',['facture' => $livraison->id_facture])->with('message',"Mise à jour réussit. vous pouvez télécharger le reçu!");

    }


    public function deleteLivraison(Livraison $livraison){

        $livraison -> delete();

        return redirect()->route('ListeLivraison',['livraison' => $livraison->id])->with('message',"Suppression Réussit!");

    }



}
