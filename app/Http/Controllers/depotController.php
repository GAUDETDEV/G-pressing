<?php

namespace App\Http\Controllers;

use App\Http\Requests\depotModifyNombreRequest;
use App\Http\Requests\depotModifyPoidsRequest;
use App\Http\Requests\depotModifyRequest;
use App\Http\Requests\depotPostPoidsRequest;
use App\Http\Requests\depotPostNombreRequest;
use App\Http\Requests\depotPostNombreResquest;
use App\Http\Requests\depotPostRequest;
use App\Http\Requests\postNombreRequest;
use App\Http\Requests\postPoidsRequest;
use App\Models\Depot;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class depotController extends Controller
{
    //


    public function indexDepot():View {

        return view("depots/accueil");

    }

    public function listePoids():View {

        $depot_edit_company_poids = DB::table("depots")->where("type_depot","!=", "nombre")->where("id_company","=",Auth::id())->paginate(6);

        return view("depots/company/poids/liste",[
            "depot_edit_company_poids" => $depot_edit_company_poids,
        ]);

    }

    public function listeNombre():View {

        $depot_edit_company_nombres = DB::table("depots")->where("type_depot","!=", "poids")->where("id_company","=",Auth::id())->paginate(6);

        return view("depots/company/nombre/liste",[
            "depot_edit_company_nombres" => $depot_edit_company_nombres,
        ]);

    }

    public function postNombre(Request $request){

        Depot::create([

            'type_depot'=> "nombre",
            'nbr_vet'=>$request->nbr_vet,
            'prix_depot'=>$request->prix_depot,
            'id_company'=>Auth::id(),

        ]);

        return redirect()->route('listeNombre')->with("message","Dépôt enregistré avec succès!");

    }


    public function postPoids(Request $request){

        Depot::create([

            'type_depot'=> "poids",
            'poids_vet'=>$request->poids_vet,
            'prix_depot'=>$request->prix_depot,
            'id_company'=>Auth::id(),

        ]);

        return redirect()->route('listePoids')->with("message","Dépôt enregistré avec succès!");

    }


    public function postDepotPoidsRecept(Request $request){

        $infos_auth = DB::table("users")->where("id","=",Auth::id())->first();

        Depot::create([

            'type_depot'=> "poids",
            'poids_vet'=>$request->poids_vet,
            'prix_depot'=>$request->prix_depot,
            'id_company'=>$infos_auth->id_user_action,

        ]);

        return redirect()->route('listeDepotPoids')->with("message","Dépôt enregistré avec succès!");

    }


    public function postDepotNombreRecept(Request $request){

        $infos_auth = DB::table("users")->where("id","=",Auth::id())->first();

        Depot::create([

            'type_depot'=> "nombre",
            'nbr_vet'=>$request->nbr_vet,
            'prix_depot'=>$request->prix_depot,
            'id_company'=>$infos_auth->id_user_action,

        ]);

        return redirect()->route('listeDepotNombre')->with("message","Dépôt enregistré avec succès!");

    }



    public function modifyPoids(Depot $depot_poids):View{

        return view("depots/poids/modify",[

            "depot_poids" => $depot_poids,

        ]);

    }


    public function deletePoids(Depot $depot_poids){

        $depot_poids -> delete();

        return redirect()->route("listePoids",['depot_poids' => $depot_poids->id])->with("message","Suppression réussit!");

    }


    public function deleteNombre(Depot $depot_nombre){

        $depot_nombre -> delete();

        return redirect()->route("listeNombre",['depot_nombre' => $depot_nombre->id])->with("message","Suppression réussit!");

    }



    public function modifyNombre(Depot $depot_nombre):View{

        return view("depots/nombre/modify",[

            "depot_nombre" => $depot_nombre,

        ]);

    }


    public function putPoids(Depot $depot_poids, depotModifyPoidsRequest $request){

        $depot_poids->poids_vet = $request->poids_vet;
        $depot_poids->prix_depot = $request->prix_depot;

        $depot_poids -> save();

        return redirect()->route('modifyPoids',['depot_poids' => $depot_poids->id])->with("message","Mise à jour réussit!");

    }


    public function putNombre(Depot $depot_nombre, depotModifyNombreRequest $request){

        $depot_nombre->nbr_vet = $request->nbr_vet;
        $depot_nombre->prix_depot = $request->prix_depot;

        $depot_nombre -> save();

        return redirect()->route('modifyNombre',['depot_nombre' => $depot_nombre->id])->with("message","Mise à jour réussit!");

    }




}
