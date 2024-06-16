<?php

namespace App\Http\Controllers;

use App\Http\Requests\vetPostRequest;
use App\Models\Vetement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class vetementController extends Controller
{
    //

    public function listeVetements(Request $request):View{


        if($request->filled("search")){

            $vetements = DB::table('vetements')->where("id_editor","=",Auth::id())->where("prix_vet","!=","")->whereAny([

                "nom_vet",
                "prix_vet",

            ],"LIKE","%".$request->search."%")->paginate(10);


        }else{

            $vetements = DB::table('vetements')->where("id_editor","=",Auth::id())->where("prix_vet","!=","")->paginate(10);


        }


        return view("vetements/gerants/liste",[

            "vetements" => $vetements,

        ]);

    }


    public function ajouterVet():View{

        $cat_vets = DB::table('categorie_vets')->where("id_editor","=",Auth::id())->where("id_pack","=",0)->get();

        return view("vetements/gerants/ajout",[

            "cat_vets" => $cat_vets,

        ]);

    }


    public function postVet(vetPostRequest $request){

        Vetement::create([

            'nom_vet' => $request->nom_vet,
            'prix_vet' => $request->prix_vet,
            'id_cat_vet' => $request->id_cat_vet,
            'id_editor' => Auth::id(),
            'id_service' => 0,
            'id_pack' => 0,

        ]);

        return redirect()->route('listeVetements')->with('message', "Vêtement enregistré avec succes!");

    }


    public function deleteVet(Vetement $vetement){

        $vetement -> delete();

        return redirect()->route("listeVetements",['vetement' => $vetement->id])->with('message',"Suppression réussit!");

    }



    public function deleteAllVetement(){

        DB::table("vetements")->where("id_editor","=",Auth::id())->delete();

        return redirect()->route("listeVetements")->with('message',"Nettoyage effectué avec succès!");

    }



    public function detailVet(Vetement $vetement):View{

        $nbr_vet = DB::table("recepts")->where("nom_vet","=",$vetement->nom_vet)->where("id_company","=",Auth::id())->get();

        return view("vetements/gerants/detail",[

            "vetement" => $vetement,
            "nbr_vet" => $nbr_vet,

        ]);

    }



    public function modifyVet(Vetement $vetement):View{

        $cat_vet = DB::table("categorie_vets")->where("id","=",$vetement->id_cat_vet)->first();
        $other_cat_vets = DB::table("categorie_vets")->where("id","!=",$vetement->id_cat_vet)->where("id_pack","=",0)->get();

        return view("vetements/gerants/modify",[

            "vetement" => $vetement,
            "cat_vet" => $cat_vet,
            "other_cat_vets" => $other_cat_vets,

        ]);

    }


    public function putVet(Vetement $vetement, vetPostRequest $request){

        $vetement->nom_vet = $request->nom_vet;
        $vetement->prix_vet = $request->prix_vet;
        $vetement->id_cat_vet = $request->id_cat_vet;

        $vetement -> save();

        return redirect()->route("modifyVet",['vetement' => $vetement->id])->with('message',"Mise à jour réussit avec succès!");

    }

}
