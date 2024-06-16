<?php

namespace App\Http\Controllers;

use App\Http\Requests\qualityPostRequest;
use App\Http\Requests\vetPostRequest;
use App\Models\Categorie_vet;
use App\Models\Pack;
use App\Models\Quality_vetement;
use App\Models\Vetement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class packController extends Controller
{
    //

    public function receptionistListePackClient():View{

        $info_auth = DB::table("users")->where("id","=",Auth::id())->first();

        $packs = DB::table('packs')->where("id_editor","=",$info_auth->id_user_action)->paginate(3);

        $vetement_packs="";
        $cat_vet_packs ="";
        $quality_vet_packs = "";

        foreach($packs as $pack){

            $vetement_packs = DB::table('vetements')->where("id_pack","=",$pack->id)->get();
            $cat_vet_packs = DB::table('categorie_vets')->where("id_pack","=",$pack->id)->get();
            $quality_vet_packs = DB::table('quality_vetements')->where("id_pack","=",$pack->id)->get();

        }

        return view("packs/receptionniste/liste",[

            "packs" => $packs,
            "vetement_packs" => $vetement_packs,
            "cat_vet_packs" => $cat_vet_packs,
            "quality_vet_packs" => $quality_vet_packs,

        ]);


    }




    public function accueilPacks():View{

        return view("packs/accueil");

    }


    public function listePacksNombre():View{

        $packs = DB::table("packs")->where("id_editor","=", Auth::id())->where("nbr_vet","!=","")->paginate(6);

        return view("packs/nombre/liste",[
            "packs" => $packs,
        ]);

    }


    public function listePacksPoids():View{

        $packs = DB::table("packs")->where("id_editor","=", Auth::id())->where("poids_vet","!=","")->paginate(6);

        return view("packs/poids/liste",[
            "packs" => $packs,
        ]);

    }


    public function modifyPackNombre(Pack $pack):View{

        $other_delivery = DB::table("packs")->where("id_editor","=",Auth::id())->where("delivery","!=",$pack->delivery)->first();
        $other_recovery = DB::table("packs")->where("id_editor","=",Auth::id())->where("recovery","!=",$pack->recovery)->first();

        return view("packs/nombre/modify",[
            "pack" => $pack,
            "other_delivery" => $other_delivery,
            "other_recovery" => $other_recovery,
        ]);

    }


    public function modifyPackPoids(Pack $pack):View{

        $other_delivery = DB::table("packs")->where("id_editor","=",Auth::id())->where("delivery","!=",$pack->delivery)->first();
        $other_recovery = DB::table("packs")->where("id_editor","=",Auth::id())->where("recovery","!=",$pack->recovery)->first();

        return view("packs/poids/modify",[
            "pack" => $pack,
            "other_delivery" => $other_delivery,
            "other_recovery" => $other_recovery,
        ]);

    }



    public function putPackNombre(Pack $pack, Request $request){

        $pack->nom_pack = $request->nom_pack;
        $pack->nbr_vet = $request->nbr_vet;
        $pack->duration_pack = $request->duration_pack;
        $pack->delivery = $request->delivery;
        $pack->recovery = $request->recovery;
        $pack->prix_pack = $request->prix_pack;

        $pack -> save();

        return redirect()->route("modifyPackNombre",['pack' => $pack->id])->with('message',"Mise à jour réussit");

    }


    public function putPackPoids(Pack $pack, Request $request){

        $pack->nom_pack = $request->nom_pack;
        $pack->poids_vet = $request->poids_vet;
        $pack->duration_pack = $request->duration_pack;
        $pack->delivery = $request->delivery;
        $pack->recovery = $request->recovery;
        $pack->prix_pack = $request->prix_pack;

        $pack -> save();

        return redirect()->route("modifyPackPoids",['pack' => $pack->id])->with('message',"Mise à jour réussit");

    }



    public function deletePackNombre(Pack $pack){

        $pack -> delete();

        return redirect()->route("listePacksNombre",["pack" => $pack->id])->with('message',"Suppression réussit!");

    }


    public function deletePackPoids(Pack $pack){

        $pack -> delete();

        return redirect()->route("listePacksPoids",["pack" => $pack->id])->with('message',"Suppression réussit!");

    }


    public function formNombrePacks():View{

        $liste_services = DB::table("services")->where("id_gerant","=", Auth::id())->get();
        $liste_vets = DB::table("vetements")->where("id_editor","=", Auth::id())->get();
        $liste_traitements = DB::table("type_traitements")->where("id_gerant","=", Auth::id())->get();
        $liste_qualities = DB::table("quality_vetements")->where("id_gerant","=", Auth::id())->get();

        $packs = DB::table("packs")->where("id_editor","=", Auth::id())->where('nbr_vet',"!=","")->get();

        return view("packs/nombre/form",[
            "liste_services" => $liste_services,
            "packs" => $packs,
            "liste_vets" => $liste_vets,
            "liste_traitements" => $liste_traitements,
            "liste_qualities" => $liste_qualities,
        ]);

    }


    public function formPoidsPacks():View{

        $liste_services = DB::table("services")->where("id_gerant","=", Auth::id())->get();
        $liste_vets = DB::table("vetements")->where("id_editor","=", Auth::id())->get();
        $liste_traitements = DB::table("type_traitements")->where("id_gerant","=", Auth::id())->get();
        $liste_qualities = DB::table("quality_vetements")->where("id_gerant","=", Auth::id())->get();

        $packs = DB::table("packs")->where("id_editor","=", Auth::id())->where('poids_vet',"!=","")->get();

        return view("packs/poids/form",[
            "liste_services" => $liste_services,
            "packs" => $packs,
            "liste_vets" => $liste_vets,
            "liste_traitements" => $liste_traitements,
            "liste_qualities" => $liste_qualities,
        ]);

    }






    public function postPackNombre(Request $request){

        if($request->duration_pack <= 31){

            Pack::create([

                'nom_pack' => $request->nom_pack,
                'prix_pack' => $request->prix_pack,
                'nbr_vet' => $request->nbr_vet,
                'duration_pack' => $request->duration_pack,
                'id_editor' => Auth::id(),
                'delivery' => $request->delivery,
                'recovery' => $request->recovery,

            ]);

            return redirect()->route('listePacksNombre')->with("message","Paquetage enregistré avec succès!");

        }else{

            return redirect()->route('listePacksNombre')->with("message","Désoler! la durée ne doit pas être supérieur à 31 jours!");

        }


    }


    public function postPackPoids(Request $request){

        if($request->duration_pack <= 31){

            Pack::create([

                'nom_pack' => $request->nom_pack,
                'prix_pack' => $request->prix_pack,
                'poids_vet' => $request->poids_vet,
                'duration_pack' => $request->duration_pack,
                'id_editor' => Auth::id(),
                'delivery' => $request->delivery,
                'recovery' => $request->recovery,

            ]);

            return redirect()->route('listePacksPoids')->with("message","Paquetage enregistré avec succès!");

        }else{

            return redirect()->route('listePacksPoids')->with("message","Désoler! la durée ne doit pas être supérieur à 31 jours!");

        }


    }







    public function configPackNombre(Pack $pack){

        $vetements = DB::table("vetements")->where("id_editor","=", Auth::id())->where("id_pack","=",0)->get();
        $cat_vets = DB::table("categorie_vets")->where("id_editor","=", Auth::id())->where("id_pack","=",0)->get();
        $quality_vets = DB::table("quality_vetements")->where("id_gerant","=", Auth::id())->where("id_pack","=",0)->get();

        return view("packs/nombre/config",[
            "pack" => $pack,
            "vetements" => $vetements,
            "cat_vets" => $cat_vets,
            "quality_vets" => $quality_vets,
        ]);

    }


    public function configPackPoids(Pack $pack){

        $vetements = DB::table("vetements")->where("id_editor","=", Auth::id())->where("id_pack","=",0)->get();
        $cat_vets = DB::table("categorie_vets")->where("id_editor","=", Auth::id())->where("id_pack","=",0)->get();
        $quality_vets = DB::table("quality_vetements")->where("id_gerant","=", Auth::id())->where("id_pack","=",0)->get();

        return view("packs/poids/config",[
            "pack" => $pack,
            "vetements" => $vetements,
            "cat_vets" => $cat_vets,
            "quality_vets" => $quality_vets,
        ]);

    }


    public function detailPackNombre(Pack $pack){

        $vetements = DB::table("vetements")->where("id_editor","=", Auth::id())->where("id_pack","=", $pack->id)->get();
        $cat_vets = DB::table("categorie_vets")->where("id_editor","=", Auth::id())->where("id_pack","=", $pack->id)->get();
        $quality_vets = DB::table("quality_vetements")->where("id_gerant","=", Auth::id())->where("id_pack","=", $pack->id)->get();

        return view("packs/nombre/detail",[
            "pack" => $pack,
            "vetements" => $vetements,
            "cat_vets" => $cat_vets,
            "quality_vets" => $quality_vets,
        ]);

    }


    public function detailPackPoids(Pack $pack){

        $vetements = DB::table("vetements")->where("id_editor","=", Auth::id())->where("id_pack","=", $pack->id)->get();
        $cat_vets = DB::table("categorie_vets")->where("id_editor","=", Auth::id())->where("id_pack","=", $pack->id)->get();
        $quality_vets = DB::table("quality_vetements")->where("id_gerant","=", Auth::id())->where("id_pack","=", $pack->id)->get();

        return view("packs/poids/detail",[
            "pack" => $pack,
            "vetements" => $vetements,
            "cat_vets" => $cat_vets,
            "quality_vets" => $quality_vets,
        ]);

    }





    public function postVetPackNombre(Pack $pack, Request $request){

        Vetement::create([
            "nom_vet" => $request->nom_vet,
            "id_pack" => $pack->id,
            "id_editor" => Auth::id(),
        ]);

        return redirect()->route("configPackNombre",["pack" => $pack->id])->with('message',"Vêtement ajouté avec succès!");

    }


    public function postVetPackPoids(Pack $pack, Request $request){

        Vetement::create([
            "nom_vet" => $request->nom_vet,
            "id_pack" => $pack->id,
            "id_editor" => Auth::id(),
        ]);

        return redirect()->route("configPackPoids",["pack" => $pack->id])->with('message',"Vêtement ajouté avec succès!");

    }




    public function postCatVetPackNombre(Pack $pack, Request $request){

        Categorie_vet::create([
            "nom_cat_vet" => $request->nom_cat_vet,
            "id_pack" => $pack->id,
            "id_editor" => Auth::id(),
        ]);

        return redirect()->route("configPackNombre",["pack" => $pack->id])->with('message',"Catégorie ajoutée avec succès!");

    }

    public function postCatVetPackPoids(Pack $pack, Request $request){

        Categorie_vet::create([
            "nom_cat_vet" => $request->nom_cat_vet,
            "id_pack" => $pack->id,
            "id_editor" => Auth::id(),
        ]);

        return redirect()->route("configPackPoids",["pack" => $pack->id])->with('message',"Catégorie ajoutée avec succès!");

    }




    public function postQualityVetPackNombre(Pack $pack, qualityPostRequest $request){

        Quality_vetement::create([
            "nom" => $request->nom,
            "id_pack" => $pack->id,
            "id_gerant" => Auth::id(),
        ]);

        return redirect()->route("configPackNombre",["pack" => $pack->id])->with('message',"Qualité ajoutée avec succès!");

    }


    public function postQualityVetPackPoids(Pack $pack, qualityPostRequest $request){

        Quality_vetement::create([
            "nom" => $request->nom,
            "id_pack" => $pack->id,
            "id_gerant" => Auth::id(),
        ]);

        return redirect()->route("configPackPoids",["pack" => $pack->id])->with('message',"Qualité ajoutée avec succès!");

    }


    public function modifyVetNombre(Vetement $vetement):View{

        return view("packs/nombre/vetements/modify",[

            "vetement" => $vetement,

        ]);

    }

    public function modifyVetPoids(Vetement $vetement):View{

        return view("packs/poids/vetements/modify",[

            "vetement" => $vetement,

        ]);

    }


    public function modifyCatVetNombre(Categorie_vet $cat_vet):View{

        return view("packs/nombre/categories/modify",[

            "cat_vet" => $cat_vet,

        ]);

    }


    public function modifyCatVetPoids(Categorie_vet $cat_vet):View{

        return view("packs/poids/categories/modify",[

            "cat_vet" => $cat_vet,

        ]);

    }




    public function modifyQualityVetNombre(Quality_vetement $quality_vet):View{

        return view("packs/nombre/qualities/modify",[

            "quality_vet" => $quality_vet,

        ]);

    }

    public function modifyQualityVetPoids(Quality_vetement $quality_vet):View{

        return view("packs/poids/qualities/modify",[

            "quality_vet" => $quality_vet,

        ]);

    }



    public function putVetNombre(Vetement $vetement, Request $request){

        $vetement->nom_vet = $request->nom_vet;

        $vetement -> save();

        return redirect()->route("modifyVetNombre",['vetement' => $vetement->id])->with("message","Vêtement modifié avec succès!");

    }


    public function putVetPoids(Vetement $vetement, Request $request){

        $vetement->nom_vet = $request->nom_vet;

        $vetement -> save();

        return redirect()->route("modifyVetPoids",['vetement' => $vetement->id])->with("message","Vêtement modifié avec succès!");

    }



    public function putCatVetNombre(Categorie_vet $cat_vet, Request $request){

        $cat_vet->nom_cat_vet = $request->nom_cat_vet;

        $cat_vet -> save();

        return redirect()->route("modifyCatVetNombre",['cat_vet' => $cat_vet->id])->with("message","Catégorie modifiée avec succès!");

    }

    public function putCatVetPoids(Categorie_vet $cat_vet, Request $request){

        $cat_vet->nom_cat_vet = $request->nom_cat_vet;

        $cat_vet -> save();

        return redirect()->route("modifyCatVetPoids",['cat_vet' => $cat_vet->id])->with("message","Catégorie modifiée avec succès!");

    }


    public function putQualityVetNombre(Quality_vetement $quality_vet, Request $request){

        $quality_vet->nom = $request->nom;

        $quality_vet -> save();

        return redirect()->route("modifyQualityVetNombre",['quality_vet' => $quality_vet->id])->with("message","Qualité modifiée avec succès!");

    }


    public function putQualityVetPoids(Quality_vetement $quality_vet, Request $request){

        $quality_vet->nom = $request->nom;

        $quality_vet -> save();

        return redirect()->route("modifyQualityVetPoids",['quality_vet' => $quality_vet->id])->with("message","Qualité modifiée avec succès!");

    }



    public function deleteVetNombre(Vetement $vetement){

        $vetement -> delete();

        return redirect()->route("listePacksNombre",['vetement' => $vetement->id])->with("message","Vêtement supprimé avec succès!");

    }


    public function deleteVetPoids(Vetement $vetement){

        $vetement -> delete();

        return redirect()->route("listePacksPoids",['vetement' => $vetement->id])->with("message","Vêtement supprimé avec succès!");

    }


    public function deleteCatVetNombre(Categorie_vet $cat_vet){

        $cat_vet -> delete();

        return redirect()->route("listePacksNombre",['cat_vet' => $cat_vet->id])->with("message","Catégorie supprimée avec succès!");

    }

    public function deleteCatVetPoids(Categorie_vet $cat_vet){

        $cat_vet -> delete();

        return redirect()->route("listePacksPoids",['cat_vet' => $cat_vet->id])->with("message","Catégorie supprimée avec succès!");

    }


    public function deleteQualityVetNombre(Quality_vetement $quality_vet){

        $quality_vet -> delete();

        return redirect()->route("listePacksNombre",['quality_vet' => $quality_vet->id])->with("message","Qualité supprimée avec succès!");

    }


    public function deleteQualityVetPoids(Quality_vetement $quality_vet){

        $quality_vet -> delete();

        return redirect()->route("listePacksPoids",['quality_vet' => $quality_vet->id])->with("message","Qualité supprimée avec succès!");

    }



}
