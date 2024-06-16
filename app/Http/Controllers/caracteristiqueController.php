<?php

namespace App\Http\Controllers;

use App\Http\Requests\colorPostRequest;
use App\Http\Requests\qualityPostRequest;
use App\Http\Requests\specificationPostRequest;
use App\Models\Couleur_vet;
use App\Models\Quality_vetement;
use App\Models\Specification_vet;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class caracteristiqueController extends Controller
{
    //
    public function listeCaracteristiques():View{

        $color_vets = DB::table('couleur_vets')->where("id_editor","=",Auth::id())->paginate(5);
        $sp_vets = DB::table('specification_vets')->where("id_editor","=",Auth::id())->paginate(5);
        $quality_vets = DB::table('quality_vetements')->where("id_gerant","=",Auth::id())->where("id_pack","=",0)->paginate(5);

        return view('caracteristiques/liste',[
            "color_vets" => $color_vets,
            "sp_vets" => $sp_vets,
            "quality_vets" => $quality_vets,
        ]);
    }

    public function postColor(colorPostRequest $request){

        Couleur_vet::create([

            'nom_couleur_vet' => $request->nom_couleur_vet,
            'id_editor' => Auth::id(),

        ]);

        return redirect()->route('listeCaracteristiques')->with('message', "Couleur enregistré avec succes!");
    }

    public function detailColor(Couleur_vet $color_vet):View{

        $liste_vet = DB::table('recepts')->where('color_vet','=', $color_vet->nom_couleur_vet)->where("id_company","=",Auth::id())->get();
        $nbr_vet = count($liste_vet);

        return view("caracteristiques/details/color",[

            "color_vet" => $color_vet,
            "nbr_vet" => $nbr_vet,

        ]);

    }


    public function deleteColor(Couleur_vet $color_vet){

        $color_vet -> delete();

        return redirect()->route("listeCaracteristiques",["color_vet"=>$color_vet->id])->with("message","Suppression réussit!");

    }


    public function deleteSp(Specification_vet $sp_vet){

        $sp_vet -> delete();

        return redirect()->route("listeCaracteristiques",["color_vet"=>$sp_vet->id])->with("message","Suppression réussit!");

    }


    public function detailSp(Specification_vet $sp_vet):View{

        $liste_vet = DB::table('recepts')->where('caract_vet','=', $sp_vet->nom_specification_vet)->where("id_company","=",Auth::id())->get();
        $nbr_vet = count($liste_vet);

        return view("caracteristiques/details/specification",[

            "sp_vet" => $sp_vet,
            "nbr_vet" => $nbr_vet,

        ]);

    }


    public function postSpVet(specificationPostRequest $request){

        Specification_vet::create([

            'nom_specification_vet' => $request->nom_specification_vet,
            'id_editor' => Auth::id(),

        ]);

        return redirect()->route('listeCaracteristiques')->with('message', "Spécification enregistrée avec succes!");
    }

    public function postQualityVet(qualityPostRequest $request){

        Quality_vetement::create([

            'nom' => $request->nom,
            'description_quality' => $request->description_quality,
            'id_gerant' => Auth::id(),
            'id_pack' => 0,

        ]);

        return redirect()->route('listeCaracteristiques')->with('message', "Qualité enregistrée avec succes!");
    }



}
