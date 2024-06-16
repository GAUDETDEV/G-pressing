<?php

namespace App\Http\Controllers;

use App\Http\Requests\modifyServiceRequest;
use App\Http\Requests\postServiceRequest;
use App\Http\Requests\vetPostRequest;
use App\Models\Service;
use App\Models\Vetement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class serviceController extends Controller
{
    //
    public function listeServices():View{

        $liste_services = DB::table('services')->where("id_gerant","=",Auth::id())->paginate(3);

        return view("services/liste",[

            "liste_services" => $liste_services,

        ]);


    }

    public function postService(postServiceRequest $request){


        Service::create([

            "type_service" => $request->type_service,
            "description" => $request->description,
            "id_gerant" => Auth::id(),

        ]);

        return redirect()->route("listeServices")->with('message',"Service ajouté avec succès!");

    }



    public function modifyVetService(Vetement $vetement):View{

        $cat_vet = DB::table("categorie_vets")->where("id","=",$vetement->id_cat_vet)->first();
        $other_cat_vets = DB::table("categorie_vets")->where("id","!=",$vetement->id_cat_vet)->where("id_pack","=",0)->get();

        return view("services/configuration/modify",[

            "vetement" => $vetement,
            "cat_vet" => $cat_vet,
            "other_cat_vets" => $other_cat_vets,

        ]);

    }


    public function modifyService(Service $service):View{

        return view("services/modify",[

            "service" => $service,

        ]);

    }

    public function putService(Service $service, modifyServiceRequest $request){

        $service->type_service = $request->type_service;
        $service->description = $request->description;

        $service -> save();

        return redirect()->route("modifyService",["service" => $service->id])->with('message',"Mise à jour effectuée avec succès!");

    }


    public function putVetService(Vetement $vetement, vetPostRequest $request){

        $vetement->nom_vet = $request->nom_vet;
        $vetement->prix_vet = $request->prix_vet;
        $vetement->id_cat_vet = $request->id_cat_vet;

        $vetement -> save();

        return redirect()->route("modifyVetService",["vetement" => $vetement->id])->with('message',"Mise à jour effectuée avec succès!");

    }

    public function accueilConfigService(Service $service):View{

        $liste_vets = DB::table("vetements")->where("id_service","=",$service->id)->where("id_editor","=",Auth::id())->get();
        $liste_cat_vets = DB::table("categorie_vets")->where("id_editor","=",Auth::id())->where("id_pack","=",0)->get();

        return view("services/configuration/accueil",[

            "service" => $service,
            "liste_vets" => $liste_vets,
            "liste_cat_vets" => $liste_cat_vets,

        ]);

    }



    public function postVetService(Service $service, vetPostRequest $request){

        Vetement::create([

            "nom_vet" => $request->nom_vet,
            "prix_vet" => $request->prix_vet,
            "id_cat_vet" => $request->id_cat_vet,
            "id_editor" => Auth::id(),
            "id_service" => $service->id,

        ]);

        return redirect()->route("accueilConfigService",['service' => $service->id])->with('message',"Vêtement ajouté avec succès!");

    }



    public function deleteService(Service $service){

        $service -> delete();

        return redirect()->route("listeServices")->with('message',"Suppression réussit!");

    }


    public function deleteVetService(Vetement $vetement){

        $vetement -> delete();

        return redirect()->route("listeServices",['vetement' => $vetement->id])->with('message',"Suppression réussit!");

    }


}
