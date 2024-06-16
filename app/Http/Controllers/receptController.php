<?php

namespace App\Http\Controllers;

use App\Http\Requests\modifyVetClassicRequest;
use App\Http\Requests\receptPostRequest;
use App\Models\Depot;
use App\Models\Facture;
use App\Models\Recept;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class receptController extends Controller
{
    //

    public function listeRecept():View{

        $recepts = DB::table('recepts')->get();
        $total_qte = DB::table("recepts")->sum('qte_vet');
        $total_prix_unit = DB::table("recepts")->sum('prix_unitaire');
        $total_prix = DB::table("recepts")->sum('prix');

        return view("recepts/liste",[

            "recepts" => $recepts,
            "total_qte" => $total_qte,
            "total_prix_unit" => $total_prix_unit,
            "total_prix" => $total_prix,

        ]);

    }

    public function indexAllRecept():View{

        return view("recepts/accueil");

    }


    public function indexMyRecept(Request $request):View{


        $infos_auth = DB::table("users")->where("id","=",Auth::id())->first();


        if($infos_auth->role === "receptionniste"){

            $liste_recepts = DB::table("recepts")->where("id_receptionist","=",Auth::id())->paginate(10);
            $nbr_recepts = DB::table("recepts")->where("id_receptionist","=",Auth::id())->get();
            $total_qte = DB::table("recepts")->where("id_receptionist","=",Auth::id())->sum('qte_vet');
            $total_prix_unit = DB::table("recepts")->where("id_receptionist","=",Auth::id())->sum('prix_unitaire');
            $total_prix = DB::table("recepts")->where("id_receptionist","=",Auth::id())->sum('prix');
            $count = count($nbr_recepts);


            if($request->filled('search')){

                $liste_recepts = DB::table("recepts")->where("id_receptionist","=",Auth::id())->whereAny([
                    'nom_vet',
                    'color_vet',
                    'caract_vet',
                    'cat_vet',
                    'quality_vet',
                ], 'LIKE', '%'.$request->search.'%')->paginate(10);

                $nbr_recepts = DB::table("recepts")->where("id_receptionist","=",Auth::id())->whereAny([
                    'nom_vet',
                    'color_vet',
                    'caract_vet',
                    'cat_vet',
                    'quality_vet',
                ], 'LIKE', '%'.$request->search.'%')->get();

                $total_qte = DB::table("recepts")->where("id_receptionist","=",Auth::id())->whereAny([
                    'nom_vet',
                    'color_vet',
                    'caract_vet',
                    'cat_vet',
                    'quality_vet',
                ], 'LIKE', '%'.$request->search.'%')->sum('qte_vet');
                $total_prix_unit = DB::table("recepts")->where("id_receptionist","=",Auth::id())->whereAny([
                    'nom_vet',
                    'color_vet',
                    'caract_vet',
                    'cat_vet',
                    'quality_vet',
                ], 'LIKE', '%'.$request->search.'%')->sum('prix_unitaire');

                $total_prix = DB::table("recepts")->where("id_receptionist","=",Auth::id())->whereAny([
                    'nom_vet',
                    'color_vet',
                    'caract_vet',
                    'cat_vet',
                    'quality_vet',
                ], 'LIKE', '%'.$request->search.'%')->sum('prix');

                $count = count($nbr_recepts);


            }else{

                $liste_recepts = DB::table("recepts")->where("id_receptionist","=",Auth::id())->paginate(10);

            }


            return view("recepts/my/liste",[

                "liste_recepts" => $liste_recepts,
                "total_qte" => $total_qte,
                "total_prix_unit" => $total_prix_unit,
                "total_prix" => $total_prix,
                "count" => $count,

            ]);



        }elseif($infos_auth->role === "client"){


            $liste_recepts = DB::table("recepts")->where("nom_client","=",$infos_auth->name)->where("tel_client","=",$infos_auth->telephone)->where("id_company","=",$infos_auth->id_user_action)->paginate(10);
            $nbr_recepts = DB::table("recepts")->where("nom_client","=",$infos_auth->name)->where("tel_client","=",$infos_auth->telephone)->where("id_company","=",$infos_auth->id_user_action)->get();
            $total_qte = DB::table("recepts")->where("nom_client","=",$infos_auth->name)->where("tel_client","=",$infos_auth->telephone)->where("id_company","=",$infos_auth->id_user_action)->sum('qte_vet');
            $total_prix_unit = DB::table("recepts")->where("nom_client","=",$infos_auth->name)->where("tel_client","=",$infos_auth->telephone)->where("id_company","=",$infos_auth->id_user_action)->sum('prix_unitaire');
            $total_prix = DB::table("recepts")->where("nom_client","=",$infos_auth->name)->where("tel_client","=",$infos_auth->telephone)->where("id_company","=",$infos_auth->id_user_action)->sum('prix');
            $count = count($nbr_recepts);


            if($request->filled('search')){

                $liste_recepts = DB::table("recepts")->where("nom_client","=",$infos_auth->name)->where("tel_client","=",$infos_auth->telephone)->where("id_company","=",$infos_auth->id_user_action)->whereAny([
                    'nom_vet',
                    'color_vet',
                    'caract_vet',
                    'cat_vet',
                    'quality_vet',
                ], 'LIKE', '%'.$request->search.'%')->paginate(10);

                $nbr_recepts = DB::table("recepts")->where("nom_client","=",$infos_auth->name)->where("tel_client","=",$infos_auth->telephone)->where("id_company","=",$infos_auth->id_user_action)->whereAny([
                    'nom_vet',
                    'color_vet',
                    'caract_vet',
                    'cat_vet',
                    'quality_vet',
                ], 'LIKE', '%'.$request->search.'%')->get();

                $total_qte = DB::table("recepts")->where("nom_client","=",$infos_auth->name)->where("tel_client","=",$infos_auth->telephone)->where("id_company","=",$infos_auth->id_user_action)->whereAny([
                    'nom_vet',
                    'color_vet',
                    'caract_vet',
                    'cat_vet',
                    'quality_vet',
                ], 'LIKE', '%'.$request->search.'%')->sum('qte_vet');
                $total_prix_unit = DB::table("recepts")->where("nom_client","=",$infos_auth->name)->where("tel_client","=",$infos_auth->telephone)->where("id_company","=",$infos_auth->id_user_action)->whereAny([
                    'nom_vet',
                    'color_vet',
                    'caract_vet',
                    'cat_vet',
                    'quality_vet',
                ], 'LIKE', '%'.$request->search.'%')->sum('prix_unitaire');

                $total_prix = DB::table("recepts")->where("nom_client","=",$infos_auth->name)->where("tel_client","=",$infos_auth->telephone)->where("id_company","=",$infos_auth->id_user_action)->whereAny([
                    'nom_vet',
                    'color_vet',
                    'caract_vet',
                    'cat_vet',
                    'quality_vet',
                ], 'LIKE', '%'.$request->search.'%')->sum('prix');

                $count = count($nbr_recepts);


            }else{

                $liste_recepts = DB::table("recepts")->where("nom_client","=",$infos_auth->name)->where("tel_client","=",$infos_auth->telephone)->where("id_company","=",$infos_auth->id_user_action)->paginate(10);

            }


            return view("recepts/clients/liste",[

                "liste_recepts" => $liste_recepts,
                "total_qte" => $total_qte,
                "total_prix_unit" => $total_prix_unit,
                "total_prix" => $total_prix,
                "count" => $count,

            ]);


        }


    }



    public function typeRecept():View{

        $vetements = DB::table("vetements")->get();
        $couleurs = DB::table("couleur_vets")->get();
        $today = date("Y-m-d");
        $date_retrait = date("Y-m-d",strtotime("+ 3days"));
        $caracts = DB::table("specification_vets")->get();
        $info_recept = DB::table('recepts')->latest()->first();

        return view("recepts/type/form",[
            "vetements" => $vetements,
            "couleurs" => $couleurs,
            "caracts" => $caracts,
            "today" => $today,
            "date_retrait" => $date_retrait,
            "info_recept" => $info_recept,
        ]);

    }


    public function postRecept(Facture $facture, receptPostRequest $request){

        $infos_depot = DB::table("depots")->where("id","=",$facture->id_type_depot)->first();

        $today = date("Y-m-d");

        if($facture->id_type_depot == 0){

            $id_user_action = DB::table("users")->where("id","=",Auth::id())->value("id_user_action");
            $infos_vet = DB::table('vetements')->where('nom_vet','=',$request->nom_vet)->where('id_service','=',0)->where('id_pack','=',0)->first();
            $cat_vet = DB::table('categorie_vets')->where('id','=',$infos_vet->id_cat_vet)->where('id_pack','=',0)->first();
            $prix = $infos_vet->prix_vet * $request->qte_vet;

            Recept::create([

                'nom_vet' => $request->nom_vet,
                'color_vet' => $request->color_vet,
                'caract_vet' => $request->caract_vet,
                'cat_vet' => $cat_vet->nom_cat_vet,
                'qte_vet' => $request->qte_vet,
                'prix_unitaire' => $infos_vet->prix_vet,
                'prix' => $prix,
                'quality_vet' => $request->quality_vet,
                'id_facture' => $facture->id,
                'id_type_depot' => $facture->id_type_depot,
                'id_receptionist' => Auth::id(),
                'id_company' => $id_user_action,
                "nom_client" => $facture->nom_titulaire,
                "tel_client" => $facture->tel_titulaire,
                "registration" => $today,

            ]);

            return redirect()->route('editFactureClassic',['facture'=>$facture->id])->with("message","Vêtements receptionné avec succès!");

        }


        if($facture->id_type_depot == $infos_depot->id and $infos_depot->type_depot == "nombre"){

            $total_qte = DB::table("recepts")->where("id_facture","=",$facture->id, "and", "id_type_depot","=", $infos_depot->id)->sum('qte_vet');

            $infos_depot = DB::table("depots")->where("id","=",$facture->id_type_depot)->first();

            if($total_qte < $infos_depot->nbr_vet){


                $reste =$infos_depot->nbr_vet - $total_qte;


                if($request->qte_vet == $reste){

                    $id_user_action = DB::table("users")->where("id","=",Auth::id())->value("id_user_action");
                    $infos_vet = DB::table('vetements')->where('nom_vet','=',$request->nom_vet)->where('id_service','=',0)->where('id_pack','=',0)->first();
                    $cat_vet = DB::table('categorie_vets')->where('id','=',$infos_vet->id_cat_vet)->where('id_pack','=',0)->first();
                    $prix = $infos_vet->prix_vet * $request->qte_vet;

                    Recept::create([

                        'nom_vet' => $request->nom_vet,
                        'color_vet' => $request->color_vet,
                        'caract_vet' => $request->caract_vet,
                        'cat_vet' => $cat_vet->nom_cat_vet,
                        'qte_vet' => $request->qte_vet,
                        'quality_vet' => $request->quality_vet,
                        'prix_unitaire' => $infos_vet->prix_vet,
                        'prix' => $prix,
                        'id_facture' => $facture->id,
                        'id_type_depot' => $facture->id_type_depot,
                        'id_receptionist' => Auth::id(),
                        'id_company' => $id_user_action,
                        "nom_client" => $facture->nom_titulaire,
                        "tel_client" => $facture->tel_titulaire,
                        "registration" => $today,

                    ]);

                    return redirect()->route('editFactureNombre',['facture'=>$facture->id])->with("message","Vêtements receptionné avec succès!");

                }


                if($request->qte_vet > $reste){

                    return redirect()->route('editFactureNombre',['facture'=>$facture->id])->with("message","Désoler vous pouvez enregistrer seulement que ".$reste." vêtement(s).");

                }


                if($request->qte_vet < $reste){


                    $id_user_action = DB::table("users")->where("id","=",Auth::id())->value("id_user_action");
                    $prix_unitaire = DB::table('vetements')->where('nom_vet','=',$request->nom_vet)->where('id_service','=',0)->where('id_pack','=',0)->first();
                    $cat_vet = DB::table('categorie_vets')->where('id','=',$prix_unitaire->id_cat_vet)->where('id_pack','=',0)->first();
                    $prix = $prix_unitaire->prix_vet * $request->qte_vet;

                    Recept::create([

                        'nom_vet' => $request->nom_vet,
                        'color_vet' => $request->color_vet,
                        'caract_vet' => $request->caract_vet,
                        'cat_vet' => $cat_vet->nom_cat_vet,
                        'qte_vet' => $request->qte_vet,
                        'quality_vet' => $request->quality_vet,
                        'prix_unitaire' => $prix_unitaire->prix_vet,
                        'prix' => $prix,
                        'id_facture' => $facture->id,
                        'id_type_depot' => $facture->id_type_depot,
                        'id_receptionist' => Auth::id(),
                        'id_company' => $id_user_action,
                        "nom_client" => $facture->nom_titulaire,
                        "tel_client" => $facture->tel_titulaire,
                        "registration" => $today,

                    ]);

                    return redirect()->route('editFactureNombre',['facture'=>$facture->id])->with("message","Vêtements receptionné avec succès!");


                }


            }

            if($total_qte == $infos_depot->nbr_vet){

                if($request->qte_vet == $total_qte){

                    return redirect()->route('editFactureNombre',['facture'=>$facture->id])->with("message","Le nombre de vêtements autorisés est atteint!");

                }

                if($request->qte_vet > $total_qte){

                    return redirect()->route('editFactureNombre',['facture'=>$facture->id])->with("message","Le nombre de vêtements autorisés est atteint!");

                }

                if($request->qte_vet < $total_qte){

                    return redirect()->route('editFactureNombre',['facture'=>$facture->id])->with("message","Le nombre de vêtements autorisés est atteint!");

                }


            }



        }


        if($facture->id_type_depot == $infos_depot->id and $infos_depot->type_depot == "poids"){

            $total_qte = DB::table("recepts")->where("id_facture","=",$facture->id, "and", "id_type_depot","=", $infos_depot->id)->sum('qte_vet');

            $id_user_action = DB::table("users")->where("id","=",Auth::id())->value("id_user_action");
            $prix_unitaire = DB::table('vetements')->where('nom_vet','=',$request->nom_vet)->where('id_service','=',0)->where('id_pack','=',0)->first();
            $cat_vet = DB::table('categorie_vets')->where('id','=',$prix_unitaire->id_cat_vet)->where('id_pack','=',0)->first();
            $prix = $prix_unitaire->prix_vet * $request->qte_vet;

            Recept::create([

                'nom_vet' => $request->nom_vet,
                'color_vet' => $request->color_vet,
                'caract_vet' => $request->caract_vet,
                'cat_vet' => $cat_vet->nom_cat_vet,
                'quality_vet' => $request->quality_vet,
                'qte_vet' => $request->qte_vet,
                'prix_unitaire' => $prix_unitaire->prix_vet,
                'prix' => $prix,
                'id_facture' => $facture->id,
                'id_type_depot' => $facture->id_type_depot,
                'id_receptionist' => Auth::id(),
                'id_company' => $id_user_action,
                "nom_client" => $facture->nom_titulaire,
                "tel_client" => $facture->tel_titulaire,
                "registration" => $today,

            ]);

            return redirect()->route('editFacturePoids',['facture'=>$facture->id])->with("message","Vêtements receptionné avec succès!");

        }



    }



    public function listVetReceptClassic(Request $request):View{

        $liste_vet_classics = DB::table("recepts")->where("id_type_depot","=",0)->where("id_receptionist","=",Auth::id())->paginate(5);
        $nbr_vet_classics = DB::table("recepts")->where("id_type_depot","=",0)->where("id_receptionist","=",Auth::id())->get();
        $total_qte = DB::table("recepts")->where("id_type_depot","=",0)->where("id_receptionist","=",Auth::id())->sum('qte_vet');
        $total_prix_unit = DB::table("recepts")->where("id_type_depot","=",0)->where("id_receptionist","=",Auth::id())->sum('prix_unitaire');
        $total_prix = DB::table("recepts")->where("id_type_depot","=",0)->where("id_receptionist","=",Auth::id())->sum('prix');
        $count = count($nbr_vet_classics);

        if($request->filled('search')){

            $liste_vet_classics = DB::table("recepts")->where("id_type_depot","=",0)->where("id_receptionist","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->paginate(10);



            $nbr_vet_classics = DB::table("recepts")->where("id_type_depot","=",0)->where("id_receptionist","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->get();

            $total_qte = DB::table("recepts")->where("id_type_depot","=",0)->where("id_receptionist","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->sum('qte_vet');

            $total_prix_unit = DB::table("recepts")->where("id_type_depot","=",0)->where("id_receptionist","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->sum('prix_unitaire');

            $total_prix = DB::table("recepts")->where("id_type_depot","=",0)->where("id_receptionist","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->sum('prix');

            $count = count($nbr_vet_classics);

        }else{

            $liste_vet_classics = DB::table("recepts")->where("id_type_depot","=",0)->where("id_receptionist","=",Auth::id())->paginate(5);

        }


        return view("recepts/type/show",[

            "liste_vet_classics" => $liste_vet_classics,
            "total_qte" => $total_qte,
            "total_prix_unit" => $total_prix_unit,
            "total_prix" => $total_prix,
            "count" => $count,

        ]);

    }


    public function listVetReceptNombre( Depot $depot_nombre, Request $request):View{

        $liste_vet_nombres = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_nombre->id)->paginate(5);
        $nbr_vet_nombres = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_nombre->id)->get();
        $total_qte = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_nombre->id)->sum('qte_vet');
        $total_prix_unit = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_nombre->id)->sum('prix_unitaire');
        $total_prix = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_nombre->id)->sum('prix');
        $count = count($nbr_vet_nombres);


        if($request->filled('search')){

            $liste_vet_nombres = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_nombre->id)->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->paginate(5);

            $nbr_vet_nombres = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_nombre->id)->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->get();

            $total_qte = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_nombre->id)->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->sum('qte_vet');

            $total_prix_unit = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_nombre->id)->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->sum('prix_unitaire');

            $total_prix = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_nombre->id)->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->sum('prix');

            $count = count($nbr_vet_nombres);

        }else{

            $liste_vet_nombres = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_nombre->id)->paginate(5);

        }


        return view("recepts/nombre/show",[

            "depot_nombre" => $depot_nombre,
            "liste_vet_nombres" => $liste_vet_nombres,
            "total_qte" => $total_qte,
            "total_prix_unit" => $total_prix_unit,
            "total_prix" => $total_prix,
            "count" => $count,

        ]);

    }


    public function listVetReceptPoids( Depot $depot_poid, Request $request):View{

        $liste_vet_poids = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_poid->id)->paginate(5);
        $nbr_vet_poids = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_poid->id)->get();
        $total_qte = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_poid->id)->sum('qte_vet');
        $total_prix_unit = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_poid->id)->sum('prix_unitaire');
        $total_prix = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_poid->id)->sum('prix');
        $count = count($nbr_vet_poids);

        if($request->filled('search')){

            $liste_vet_poids = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_poid->id)->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->paginate(5);

            $nbr_vet_poids = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_poid->id)->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->get();

            $total_qte = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_poid->id)->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->sum('qte_vet');

            $total_prix_unit = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_poid->id)->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->sum('prix_unitaire');

            $total_prix = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_poid->id)->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",
                "prix",
                "quality_vet",
                "qte_vet",

            ],"LIKE", "%".$request->search."%")->sum('prix');

            $count = count($nbr_vet_poids);


        }else{

            $liste_vet_poids = DB::table("recepts")->where("id_receptionist","=",Auth::id())->where("id_type_depot","=",$depot_poid->id)->paginate(5);

        }


        return view("recepts/poids/show",[

            "depot_poid" => $depot_poid,
            "liste_vet_poids" => $liste_vet_poids,
            "total_qte" => $total_qte,
            "total_prix_unit" => $total_prix_unit,
            "total_prix" => $total_prix,
            "count" => $count,

        ]);

    }



    public function listeTypeRecept(Request $request):View{

        $liste_recept_types = DB::table("recepts")->where("id_type_depot","=",0)->where("id_company","=",Auth::id())->paginate(20);
        $total_qte = DB::table("recepts")->where("id_type_depot","=",0)->where("id_company","=",Auth::id())->sum('qte_vet');
        $total_prix_unit = DB::table("recepts")->where("id_type_depot","=",0)->where("id_company","=",Auth::id())->sum('prix_unitaire');
        $total_prix = DB::table("recepts")->where("id_type_depot","=",0)->where("id_company","=",Auth::id())->sum('prix');

        $recept_types = DB::table("recepts")->where("id_type_depot","=",0)->where("id_company","=",Auth::id())->get();
        $nbr_recept_types = count($recept_types);

        if($request->filled("search")){

            $liste_recept_types = DB::table("recepts")->where("id_type_depot","=",0)->where("id_company","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",


            ],"LIKE", "%".$request->search."%")->paginate(20);

            $total_qte = DB::table("recepts")->where("id_type_depot","=",0)->where("id_company","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",


            ],"LIKE", "%".$request->search."%")->sum('qte_vet');

            $total_prix_unit = DB::table("recepts")->where("id_type_depot","=",0)->where("id_company","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",


            ],"LIKE", "%".$request->search."%")->sum('prix_unitaire');

            $total_prix = DB::table("recepts")->where("id_type_depot","=",0)->where("id_company","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",


            ],"LIKE", "%".$request->search."%")->sum('prix');


        }else{

            $liste_recept_types = DB::table("recepts")->where("id_type_depot","=",0)->where("id_company","=",Auth::id())->paginate(20);

        }


        return view("recepts/type/liste",[

            "liste_recept_types" => $liste_recept_types,
            "total_qte" => $total_qte,
            "total_prix_unit" => $total_prix_unit,
            "total_prix" => $total_prix,
            "nbr_recept_types" => $nbr_recept_types,

        ]);

    }


    public function listeNombrePoidsRecept(Request $request):View{

        $liste_vetements = DB::table("recepts")->where("id_type_depot","!=",0)->where("id_company","=",Auth::id())->paginate(20);
        $total_qte = DB::table("recepts")->where("id_type_depot","!=",0)->where("id_company","=",Auth::id())->sum('qte_vet');
        $total_prix_unit = DB::table("recepts")->where("id_type_depot","!=",0)->where("id_company","=",Auth::id())->sum('prix_unitaire');
        $total_prix = DB::table("recepts")->where("id_type_depot","!=",0)->where("id_company","=",Auth::id())->sum('prix');

        $vetements = DB::table("recepts")->where("id_type_depot","!=",0)->where("id_company","=",Auth::id())->get();
        $nbr_vetements = count($vetements);

        if($request->filled("search")){

            $liste_vetements = DB::table("recepts")->where("id_type_depot","!=",0)->where("id_company","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",


            ],"LIKE", "%".$request->search."%")->paginate(20);

            $total_qte = DB::table("recepts")->where("id_type_depot","!=",0)->where("id_company","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",


            ],"LIKE", "%".$request->search."%")->sum('qte_vet');

            $total_prix_unit = DB::table("recepts")->where("id_type_depot","!=",0)->where("id_company","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",


            ],"LIKE", "%".$request->search."%")->sum('prix_unitaire');

            $total_prix = DB::table("recepts")->where("id_type_depot","!=",0)->where("id_company","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",


            ],"LIKE", "%".$request->search."%")->sum('prix');


        }else{

            $liste_vetements = DB::table("recepts")->where("id_type_depot","!=",0)->where("id_company","=",Auth::id())->paginate(20);

        }


        return view("recepts/full/liste",[

            "liste_vetements" => $liste_vetements,
            "total_qte" => $total_qte,
            "total_prix_unit" => $total_prix_unit,
            "total_prix" => $total_prix,
            "nbr_vetements" => $nbr_vetements,

        ]);



    }



    public function listeSupplementRecept(Request $request):View{

        $liste_vetements = DB::table("recepts")->where("id_service","!=","")->where("id_company","=",Auth::id())->paginate(20);
        $total_qte = DB::table("recepts")->where("id_service","!=","")->where("id_company","=",Auth::id())->sum('qte_vet');
        $total_prix_unit = DB::table("recepts")->where("id_service","!=","")->where("id_company","=",Auth::id())->sum('prix_unitaire');
        $total_prix = DB::table("recepts")->where("id_service","!=","")->where("id_company","=",Auth::id())->sum('prix');

        $vetements = DB::table("recepts")->where("id_service","!=","")->where("id_company","=",Auth::id())->get();
        $nbr_vetements = count($vetements);

        if($request->filled("search")){

            $liste_vetements = DB::table("recepts")->where("id_service","!=","")->where("id_company","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",


            ],"LIKE", "%".$request->search."%")->paginate(20);

            $total_qte = DB::table("recepts")->where("id_service","!=","")->where("id_company","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",


            ],"LIKE", "%".$request->search."%")->sum('qte_vet');

            $total_prix_unit = DB::table("recepts")->where("id_service","!=","")->where("id_company","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",


            ],"LIKE", "%".$request->search."%")->sum('prix_unitaire');

            $total_prix = DB::table("recepts")->where("id_service","!=","")->where("id_company","=",Auth::id())->whereAny([

                "nom_vet",
                "color_vet",
                "caract_vet",
                "cat_vet",
                "prix_unitaire",


            ],"LIKE", "%".$request->search."%")->sum('prix');


        }else{

            $liste_vetements = DB::table("recepts")->where("id_service","!=","")->where("id_company","=",Auth::id())->paginate(20);

        }


        return view("recepts/supplement/liste",[

            "liste_vetements" => $liste_vetements,
            "total_qte" => $total_qte,
            "total_prix_unit" => $total_prix_unit,
            "total_prix" => $total_prix,
            "nbr_vetements" => $nbr_vetements,

        ]);



    }






    public function receptFactureNombre(Facture $facture):View{

        $vet_recept = DB::table('recepts')->where('id_facture','=',$facture->id ,"and", "id_type_depot","=",$facture->id_type_depot)->first();

        if($vet_recept){

            $liste_recept_nombres = DB::table("recepts")->where("id_facture","=",$facture->id)->get();
            $total_qte = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('qte_vet');
            $total_prix_unit = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix_unitaire');
            $prix_depot = DB::table("depots")->where("id","=",$facture->id_type_depot)->first();
            $total_prix = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix');
            $type_depot = "nombre";
            $date_recept = DB::table("recepts")->where("id_facture","=",$facture->id)->first();
            $today = date("Y-m-d");
            $infos_livraison = DB::table("livraisons")->where("id_facture","=",$facture->id)->latest()->first();

            return view("recepts/nombre/facture",[

                "liste_recept_nombres" => $liste_recept_nombres,
                "total_qte" => $total_qte,
                "total_prix_unit" => $total_prix_unit,
                "total_prix" => $total_prix,
                "facture" => $facture,
                "type_depot" => $type_depot,
                "date_recept" => $date_recept,
                "today" => $today,
                "prix_depot" => $prix_depot,
                "infos_livraison" => $infos_livraison,

            ]);


        }else{

            $today = date("Y-m-d");
            $vetements = DB::table("vetements")->get();
            $couleurs = DB::table("couleur_vets")->get();
            $caracts = DB::table("specification_vets")->get();

            return view("factures/nombre/edit",[

                "today" => $today,
                "vetements" => $vetements,
                "couleurs" => $couleurs,
                "caracts" => $caracts,
                "facture" => $facture,

            ])->with("message","Désoler! aucun vêtement n'a été enregistré pour cette facture!");


        }

    }


    public function receptFacturePoids(Facture $facture):View{

        $vet_recept = DB::table('recepts')->where('id_facture','=',$facture->id ,"and", "id_type_depot","=",$facture->id_type_depot)->first();

        if($vet_recept){

            $liste_recept_poids = DB::table("recepts")->where("id_facture","=",$facture->id)->get();
            $total_qte = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('qte_vet');
            $total_prix_unit = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix_unitaire');
            $prix_depot = DB::table("depots")->where("id","=",$facture->id_type_depot)->first();
            $total_prix = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix');
            $type_depot = "poids";
            $date_recept = DB::table("recepts")->where("id_facture","=",$facture->id)->first();
            $today = date("Y-m-d");
            $infos_livraison = DB::table("livraisons")->where("id_facture","=",$facture->id)->latest()->first();

            return view("recepts/poids/facture",[

                "liste_recept_poids" => $liste_recept_poids,
                "total_qte" => $total_qte,
                "total_prix_unit" => $total_prix_unit,
                "total_prix" => $total_prix,
                "facture" => $facture,
                "type_depot" => $type_depot,
                "date_recept" => $date_recept,
                "today" => $today,
                "prix_depot" => $prix_depot,
                "infos_livraison" => $infos_livraison,

            ]);


        }else{

            $today = date("Y-m-d");
            $vetements = DB::table("vetements")->get();
            $couleurs = DB::table("couleur_vets")->get();
            $caracts = DB::table("specification_vets")->get();

            return view("factures/poids/edit",[

                "today" => $today,
                "vetements" => $vetements,
                "couleurs" => $couleurs,
                "caracts" => $caracts,
                "facture" => $facture,

            ])->with("message","Désoler! aucun vêtement n'a été enregistré pour cette facture!");


        }

    }


    public function receptFactureClassic(Facture $facture):View{


        $liste_recept_types = DB::table("recepts")->where("id_facture","=",$facture->id)->get();
        $total_qte = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('qte_vet');
        $total_prix_unit = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix_unitaire');
        $total_prix = DB::table("recepts")->where("id_facture","=",$facture->id)->sum('prix');
        $type_depot = "classique";
        $date_recept = DB::table("recepts")->where("id_facture","=",$facture->id)->first();
        $today = date("Y-m-d");
        $infos_livraison = DB::table("livraisons")->where("id_facture","=",$facture->id)->latest()->first();

        return view("recepts/type/facture",[

            "liste_recept_types" => $liste_recept_types,
            "total_qte" => $total_qte,
            "total_prix_unit" => $total_prix_unit,
            "total_prix" => $total_prix,
            "facture" => $facture,
            "type_depot" => $type_depot,
            "date_recept" => $date_recept,
            "facture" => $facture,
            "today" => $today,
            "infos_livraison" => $infos_livraison,

        ]);

    }


    public function modifyVetReceptClassic(Recept $vetement_classic){

        $info_recept = DB::table("users")->where("id","=",Auth::id())->first();

        $other_vetements = DB::table("vetements")->where("nom_vet","!=",$vetement_classic->nom_vet)->where("id_editor","=",$info_recept->id_user_action)->where("id_pack","=",0)->where("id_service","=",0)->get();
        $other_colors = DB::table("couleur_vets")->where("nom_couleur_vet","!=",$vetement_classic->color_vet)->where("id_editor","=",$info_recept->id_user_action)->get();
        $other_specificats = DB::table("specification_vets")->where("nom_specification_vet","!=",$vetement_classic->caract_vet)->where("id_editor","=",$info_recept->id_user_action)->get();
        $other_qualities = DB::table("quality_vetements")->where("nom","!=",$vetement_classic->quality_vet)->where("id_gerant","=",$info_recept->id_user_action)->where("id_pack","=",0)->get();

        return view("recepts/type/modify",[

            "vetement_classic" => $vetement_classic,
            "other_vetements" => $other_vetements,
            "other_colors" => $other_colors,
            "other_specificats" => $other_specificats,
            "other_qualities" => $other_qualities,

        ]);


    }


    public function modifyVetReceptNombre(Recept $vetement_nombre){

        $info_recept = DB::table("users")->where("id","=",Auth::id())->first();

        $other_vetements = DB::table("vetements")->where("nom_vet","!=",$vetement_nombre->nom_vet)->where("id_editor","=",$info_recept->id_user_action)->where("id_pack","=",0)->where("id_service","=",0)->get();
        $other_colors = DB::table("couleur_vets")->where("nom_couleur_vet","!=",$vetement_nombre->color_vet)->where("id_editor","=",$info_recept->id_user_action)->get();
        $other_specificats = DB::table("specification_vets")->where("nom_specification_vet","!=",$vetement_nombre->caract_vet)->where("id_editor","=",$info_recept->id_user_action)->get();
        $other_qualities = DB::table("quality_vetements")->where("nom","!=",$vetement_nombre->quality_vet)->where("id_gerant","=",$info_recept->id_user_action)->where("id_pack","=",0)->get();

        return view("recepts/nombre/modify",[

            "vetement_nombre" => $vetement_nombre,
            "other_vetements" => $other_vetements,
            "other_colors" => $other_colors,
            "other_specificats" => $other_specificats,
            "other_qualities" => $other_qualities,

        ]);


    }


    public function modifyVetReceptPoids(Recept $vetement_poids){

        $info_recept = DB::table("users")->where("id","=",Auth::id())->first();

        $other_vetements = DB::table("vetements")->where("nom_vet","!=",$vetement_poids->nom_vet)->where("id_editor","=",$info_recept->id_user_action)->where("id_pack","=",0)->where("id_service","=",0)->get();
        $other_colors = DB::table("couleur_vets")->where("nom_couleur_vet","!=",$vetement_poids->color_vet)->where("id_editor","=",$info_recept->id_user_action)->get();
        $other_specificats = DB::table("specification_vets")->where("nom_specification_vet","!=",$vetement_poids->caract_vet)->where("id_editor","=",$info_recept->id_user_action)->get();
        $other_qualities = DB::table("quality_vetements")->where("nom","!=",$vetement_poids->quality_vet)->where("id_gerant","=",$info_recept->id_user_action)->where("id_pack","=",0)->get();

        return view("recepts/poids/modify",[

            "vetement_poids" => $vetement_poids,
            "other_vetements" => $other_vetements,
            "other_colors" => $other_colors,
            "other_specificats" => $other_specificats,
            "other_qualities" => $other_qualities,

        ]);


    }




    public function putVetReceptClassic(Recept $vetement_classic, modifyVetClassicRequest $request){

        $info_recept = DB::table("users")->where("id","=",Auth::id())->first();

        $infos_vet = DB::table("vetements")->where("nom_vet","=",$request->nom_vet)->where("id_editor","=",$info_recept->id_user_action)->first();
        $cat_vet = DB::table('categorie_vets')->where("id","=",$infos_vet->id_cat_vet)->where("id_editor","=",$info_recept->id_user_action)->where("id_pack","=",0)->value("nom_cat_vet");
        $prix_total = $request->qte_vet * $infos_vet->prix_vet;

        $vetement_classic->nom_vet = $request->nom_vet;
        $vetement_classic->color_vet = $request->color_vet;
        $vetement_classic->caract_vet = $request->caract_vet;
        $vetement_classic->cat_vet = $cat_vet;
        $vetement_classic->quality_vet = $request->quality_vet;
        $vetement_classic->qte_vet = $request->qte_vet;
        $vetement_classic->prix_unitaire = $infos_vet->prix_vet;
        $vetement_classic->prix = $prix_total;

        $vetement_classic -> save();

        return redirect()->route('modifyVetReceptClassic',['vetement_classic' => $vetement_classic->id])->with("message","Mise à jour réussit!");

    }


    public function putVetReceptNombre(Recept $vetement_nombre, modifyVetClassicRequest $request){

        $info_recept = DB::table("users")->where("id","=",Auth::id())->first();

        $infos_vet = DB::table("vetements")->where("nom_vet","=",$request->nom_vet)->where("id_editor","=",$info_recept->id_user_action)->first();
        $cat_vet = DB::table('categorie_vets')->where("id","=",$infos_vet->id_cat_vet)->where("id_editor","=",$info_recept->id_user_action)->value("nom_cat_vet");
        $prix_total = $request->qte_vet * $infos_vet->prix_vet;


        $nbr_vet_recept = DB::table("recepts")->where("id_facture","=",$vetement_nombre->id_facture)->sum("qte_vet");
        $nbr_vet_depot = DB::table("depots")->where("id","=",$vetement_nombre->id_type_depot)->value("nbr_vet");


        $vet_bd = $nbr_vet_recept - $vetement_nombre->qte_vet;
        $reste_vet = $nbr_vet_depot - $nbr_vet_recept;
        $nbr_vet_autorise = $reste_vet + $vet_bd;


        if($request->qte_vet <= $nbr_vet_autorise){

            $vetement_nombre->nom_vet = $request->nom_vet;
            $vetement_nombre->color_vet = $request->color_vet;
            $vetement_nombre->caract_vet = $request->caract_vet;
            $vetement_nombre->cat_vet = $cat_vet;;
            $vetement_nombre->quality_vet = $request->quality_vet;
            $vetement_nombre->qte_vet = $request->qte_vet;
            $vetement_nombre->prix_unitaire = $infos_vet->prix_vet;
            $vetement_nombre->prix = $prix_total;

            $vetement_nombre -> save();

            return redirect()->route('modifyVetReceptNombre',['vetement_nombre' => $vetement_nombre->id])->with("message","Mise à réussit!");

        }else{


            return redirect()->route('modifyVetReceptNombre',['vetement_nombre' => $vetement_nombre->id])->with("message","Désoler, vous pouvez modifier que de: 1 à ".$nbr_vet_autorise." !");


        }


    }


    public function putVetReceptPoids(Recept $vetement_poids, modifyVetClassicRequest $request){

        $info_recept = DB::table("users")->where("id","=",Auth::id())->first();

        $infos_vet = DB::table("vetements")->where("nom_vet","=",$request->nom_vet)->where("id_editor","=",$info_recept->id_user_action)->first();
        $cat_vet = DB::table('categorie_vets')->where("id","=",$infos_vet->id_cat_vet)->where("id_editor","=",$info_recept->id_user_action)->value("nom_cat_vet");
        $prix_total = $request->qte_vet * $infos_vet->prix_vet;

        $vetement_poids->nom_vet = $request->nom_vet;
        $vetement_poids->color_vet = $request->color_vet;
        $vetement_poids->caract_vet = $request->caract_vet;
        $vetement_poids->cat_vet = $cat_vet;
        $vetement_poids->quality_vet = $request->quality_vet;
        $vetement_poids->qte_vet = $request->qte_vet;
        $vetement_poids->prix_unitaire = $infos_vet->prix_vet;
        $vetement_poids->prix = $prix_total;

        $vetement_poids -> save();

        return redirect()->route('modifyVetReceptPoids',['vetement_poids' => $vetement_poids->id])->with("message","Mise à réussit!");

    }



    public function deleteTypeRecept(Recept $vetement){

        $vetement -> delete();

        return redirect()->route('listeTypeRecept',['vetement' => $vetement->id])->with("message","Suppression réussit!");

    }



    public function deleteTypeAllRecept(){

        DB::table("recepts")->where("id_type_depot","=",0)->where("id_company","=",Auth::id())->delete();

        return redirect()->route('listeTypeRecept')->with("message","Nettoyage effectué avec succès!");

    }


    public function deleteSupplementRecept(Recept $vetement){

        $vetement -> delete();

        return redirect()->route('listeSupplementRecept',['vetement' => $vetement->id])->with("message","Suppression réussit!");

    }


    public function deleteSupplementAllRecept(){

        DB::table("recepts")->where("id_service","!=","")->where("id_company","=",Auth::id())->delete();

        return redirect()->route('listeSupplementRecept')->with("message","Nettoyage effectué avec succès!");

    }


    public function deleteNombrePoidsRecept(Recept $vetement){

        $vetement -> delete();

        return redirect()->route('listeNombrePoidsRecept',['vetement' => $vetement->id])->with("message","Suppression réussit!");

    }


    public function deleteAllNombrePoidsRecept(){

        DB::table("recepts")->where("id_type_depot","!=",0)->where("id_company","=",Auth::id())->delete();

        return redirect()->route('listeNombrePoidsRecept')->with("message","Nettoyage effectué avec succès!");

    }


}
