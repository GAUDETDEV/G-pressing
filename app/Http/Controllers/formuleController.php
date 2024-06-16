<?php

namespace App\Http\Controllers;

use App\Http\Requests\formuleModifyRequest;
use App\Http\Requests\formulePostRequest;
use App\Models\Formule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class formuleController extends Controller
{
    //
    public function listeFormules():View{

        $formules = DB::table('formules')->get();

        return view('formules/liste',[
            "formules" => $formules,
        ]);

    }

    public function modifyFormule(Formule $formule):View{

        return view('formules/modify',[
            "formule" => $formule,
        ]);

    }

    public function putFormule(Formule $formule, formuleModifyRequest $request){

        $today = date('Y-m-d h:i:s');
        $id_etat_formule_default = 1;

        $formule->nom_formule = $request->nom_formule;
        $formule->prix_formule = $request->prix_formule;
        $formule->nbr_user = $request->nbr_user;
        $formule->nbr_essai = $request->nbr_essai;
        $formule->periode = $request->periode;
        $formule->fonctionnalite = $request->fonctionnalite;
        $formule->id_etat_formule = $id_etat_formule_default;

        $formule -> save();

        return redirect()->route('modifyFormule',["formule"=>$formule->id])->with('message', "Mise à jour réussit!");

    }


    public function detailFormule(Formule $formule):View{

        $info_etat_formule = DB::table('etat_formules')->where('id','=',$formule->id_etat_formule)->first();
        $other_etat_formules = DB::table('etat_formules')->where('id','!=',$formule->id_etat_formule)->get();
        $result_users = DB::table('users')->where('id_formule','=',$formule->id)->where('role','=',"gerant")->get();

        return view('formules/detail',[
            "formule" => $formule,
            "info_etat_formule" => $info_etat_formule,
            "other_etat_formules" => $other_etat_formules,
            "result_users" => $result_users,
        ]);

    }


    public function putEtatFormule(Formule $formule, Request $request){

        $formule->id_etat_formule = $request->id_etat_formule;

        $formule -> save();

        return redirect()->route('detailFormule',['formule' => $formule->id])->with('message', "L'état a été modifié avec succès!");

    }


    public function deleteFormule(Formule $formule){

        $formule->delete();

        return redirect()->route('listeFormules')->with('message', "Suppression réussit!");

    }

    public function postFormule(formulePostRequest $request){

        $id_etat_formule_default = DB::table('etat_formules')->where('nom_etat_formule','=',"DISPONIBLE")->first();

        Formule::create([

            'nom_formule' => ucfirst($request->nom_formule),
            'prix_formule' => $request->prix_formule,
            'nbr_user' => $request->nbr_user,
            'nbr_essai' => strtolower($request->nbr_essai),
            'periode' => $request->periode,
            'fonctionnalite' => $request->fonctionnalite,
            'id_etat_formule' => $id_etat_formule_default->id,

        ]);

        return redirect()->route('listeFormules')->with('message', "Formule enregistré avec succes!");

    }






}
