<?php

namespace App\Http\Controllers;

use App\Http\Requests\optCatVetPostRequest;
use App\Http\Requests\optColorPostRequest;
use App\Http\Requests\optQualityVetPostRequest;
use App\Http\Requests\optSpVetPostRequest;
use App\Http\Requests\optVetPostRequest;
use App\Models\Categorie_vet;
use App\Models\Couleur_vet;
use App\Models\Quality_vetement;
use App\Models\Service;
use App\Models\Specification_vet;
use App\Models\Vetement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class optionController extends Controller
{
    //
    public function postOptionVetClassic(optVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Vetement::create([

            "nom_vet" => $request->nom_vet,
            "prix_vet" => $request->prix_vet,
            "id_cat_vet" => $request->id_cat_vet,
            "id_editor" => $infos_auth->id_user_action,
            "id_pack" => 0,
            "id_service" => 0,

        ]);

        return redirect()->route('listeFactureClassic')->with("message","Vêtements ajouté!");

    }

    public function postOptionColorClassic(optColorPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Couleur_vet::create([

            "nom_couleur_vet" => $request->nom_couleur_vet,
            "id_editor" => $infos_auth->id_user_action,

        ]);

        return redirect()->route('listeFactureClassic')->with("message","Couleur ajouté!");

    }

    public function postOptionSpVetClassic(optSpVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Specification_vet::create([

            "nom_specification_vet" => $request->nom_specification_vet,
            "id_editor" => $infos_auth->id_user_action,

        ]);

        return redirect()->route('listeFactureClassic')->with("message","Spécification ajouté!");

    }


    public function postOptionCatVetClassic(optCatVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Categorie_vet::create([

            "nom_cat_vet" => strtoupper($request->nom_cat_vet),
            "id_editor" => $infos_auth->id_user_action,
            "id_pack" => 0,

        ]);

        return redirect()->route('listeFactureClassic')->with("message","Catégorie ajouté!");

    }


    public function postOptionQualityVetClassic(optQualityVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Quality_vetement::create([

            "nom" => $request->nom,
            "description_quality" => $request->description_quality,
            "id_gerant" => $infos_auth->id_user_action,
            "id_pack" => 0,

        ]);

        return redirect()->route('listeFactureClassic')->with("message","Qualité ajoutée!");

    }


    public function postOptionQualityVetNombre(optQualityVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Quality_vetement::create([

            "nom" => $request->nom,
            "description_quality" => $request->description_quality,
            "id_gerant" => $infos_auth->id_user_action,
            "id_pack" => 0,

        ]);

        return redirect()->route('listeDepotNombre')->with("message","Qualité ajoutée!");

    }



    public function postOptionVetNombre(optVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Vetement::create([

            "nom_vet" => $request->nom_vet,
            "prix_vet" => $request->prix_vet,
            "id_cat_vet" => $request->id_cat_vet,
            "id_editor" => $infos_auth->id_user_action,
            "id_service" => 0,
            "id_pack" => 0,

        ]);

        return redirect()->route('listeDepotNombre')->with("message","Vêtements ajouté!");

    }

    public function postOptionColorNombre(optColorPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Couleur_vet::create([

            "nom_couleur_vet" => $request->nom_couleur_vet,
            "id_editor" => $infos_auth->id_user_action,

        ]);

        return redirect()->route('listeDepotNombre')->with("message","Couleur ajouté!");

    }

    public function postOptionSpVetNombre(optSpVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Specification_vet::create([

            "nom_specification_vet" => $request->nom_specification_vet,
            "id_editor" => $infos_auth->id_user_action,

        ]);

        return redirect()->route('listeDepotNombre')->with("message","Spécification ajouté!");

    }


    public function postOptionCatVetNombre(optCatVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Categorie_vet::create([

            "nom_cat_vet" => strtoupper($request->nom_cat_vet),
            "id_editor" => $infos_auth->id_user_action,
            "id_pack" => 0,

        ]);

        return redirect()->route('listeDepotNombre')->with("message","Catégorie ajouté!");

    }


    public function postOptionVetPoids(optVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Vetement::create([

            "nom_vet" => $request->nom_vet,
            "prix_vet" => $request->prix_vet,
            "id_cat_vet" => $request->id_cat_vet,
            "id_editor" => $infos_auth->id_user_action,
            "id_pack" => 0,
            "id_service" => 0,

        ]);

        return redirect()->route('listeDepotPoids')->with("message","Vêtements ajouté!");

    }

    public function postOptionColorPoids(optColorPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Couleur_vet::create([

            "nom_couleur_vet" => $request->nom_couleur_vet,
            "id_editor" => $infos_auth->id_user_action,

        ]);

        return redirect()->route('listeDepotPoids')->with("message","Couleur ajouté!");

    }

    public function postOptionSpVetPoids(optSpVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Specification_vet::create([

            "nom_specification_vet" => $request->nom_specification_vet,
            "id_editor" => $infos_auth->id_user_action,

        ]);

        return redirect()->route('listeDepotPoids')->with("message","Spécification ajouté!");

    }


    public function postOptionCatVetPoids(optCatVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Categorie_vet::create([

            "nom_cat_vet" => strtoupper($request->nom_cat_vet),
            "id_editor" => $infos_auth->id_user_action,

        ]);

        return redirect()->route('listeDepotPoids')->with("message","Catégorie ajouté!");

    }


    public function postOptionQualityVetPoids(optQualityVetPostRequest $request){

        $infos_auth = DB::table('users')->where("id","=",Auth::id())->first();

        Quality_vetement::create([

            "nom" => $request->nom,
            "description_quality" => $request->description_quality,
            "id_gerant" => $infos_auth->id_user_action,
            "id_pack" => 0,

        ]);

        return redirect()->route('listeDepotPoids')->with("message","Qualité ajoutée!");

    }








}
