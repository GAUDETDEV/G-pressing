<?php

namespace App\Http\Controllers;

use App\Http\Requests\modifyCatVetRequest;
use App\Http\Requests\postCatVetRequest;
use App\Models\Categorie_user;
use App\Models\Categorie_vet;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class categorieController extends Controller
{
    //

    public function listeCategories():View{

        $cat_users = DB::table('categorie_users')->get();
        $cat_vets = DB::table('categorie_vets')->where("id_editor","=",Auth::id())->where("id_pack","=",0)->paginate(5);

        return view('categories/liste',[
            "cat_users" => $cat_users,
            "cat_vets" => $cat_vets,
        ]);

    }



    public function postCatUser(Request $request){

        Categorie_user::create([

            'nom_cat_user' => strtoupper($request->nom_cat_user),

        ]);

        return redirect()->route('listeCategories')->with('message', "Catégorie utilisateur enregistré avec succes!");

    }


    public function postCatVet(postCatVetRequest $request){

        Categorie_vet::create([

            'nom_cat_vet' => strtoupper($request->nom_cat_vet),
            'id_editor' => Auth::id(),
            'id_pack' => 0,

        ]);

        return redirect()->route('listeCategories')->with('message', "Catégorie de vêtements enregistré avec succes!");

    }


    public function detailCatUser(Categorie_user $cat_user):View{

        $nbr_user = DB::table('users')->where('id_cat_user','=', $cat_user->id)->get();

        return view("categories/details/user",[

            "nbr_user" => $nbr_user,
            "cat_user" => $cat_user

        ]);

    }


    public function detailCatVet(Categorie_vet $cat_vet):View{

        $liste_vets = DB::table("vetements")->where("id_cat_vet","=",$cat_vet->id)->where("id_editor","=",Auth::id())->get();

        $nbr_vets = count($liste_vets);

        return view("categories/details/vetement",[

            "cat_vet" => $cat_vet,
            "nbr_vets" => $nbr_vets,

        ]);

    }


    public function deleteCatVet(Categorie_vet $cat_vet){

        $cat_vet->delete();

        return redirect()->route("listeCategories",["cat_vet"=>$cat_vet->id])->with("message","Suppression réussit!");

    }


    public function modifyCatVet(Categorie_vet $cat_vet):View{

        return view("categories/vetements/modify",[

            "cat_vet" => $cat_vet,

        ]);

    }



    public function putCatVet(Categorie_vet $cat_vet, modifyCatVetRequest $request){

        $cat_vet->nom_cat_vet = strtoupper($request->nom_cat_vet);

        $cat_vet->save();

        return redirect()->route("modifyCatVet",["cat_vet" => $cat_vet->id])->with("message","Modification réussit!");

    }



}
