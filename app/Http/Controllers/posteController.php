<?php

namespace App\Http\Controllers;

use App\Http\Requests\postPosteRequest;
use App\Models\Poste;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psy\Command\WhereamiCommand;

class posteController extends Controller
{
    //
    public function listePostes():View{

        $postes = DB::table("postes")->where("id_user_auth","=",Auth::id())->paginate(3);

        return view("postes/liste",[
            "postes" => $postes,
        ]);

    }


    public function postPoste(postPosteRequest $request){

        $id_user_auth = Auth::id();

        $liste_poste = DB::table('postes')->where("id_user_auth","=",Auth::id())->get();

        $count = count($liste_poste);

        if($count < 4){

            Poste::create([

                "titre_poste" => $request->titre_poste,
                "desc_poste" => $request->desc_poste,
                "salaire_poste" => $request->salaire_poste,
                "id_user_auth" => $id_user_auth,

            ]);

            return redirect()->route("listePostes")->with("message","Poste en enregistré avec succès!");

        }else{

            return redirect()->route("listePostes")->with("message","Désoler vous ne pouvez en enregistré plus quatre postes!");

        }


    }



    public function modifyPoste(Poste $poste){

        $other_postes = DB::table('postes')->where('id','!=',$poste->id)->where('id_user_auth','=', Auth::id())->get();

        return view("postes/modify",[
            "poste" => $poste,
            "other_postes" => $other_postes,
        ]);

    }



    public function putPoste(Poste $poste, Request $request){

        $poste->titre_poste = $request->titre_poste;
        $poste->desc_poste = $request->desc_poste;
        $poste->salaire_poste = $request->salaire_poste;

        $poste->save();

        return redirect()->route("listePostes",['poste' => $poste])->with("message","Poste modifié avec succès!");

    }


    public function geantTruncatePoste(){

        DB::table('postes')->where("id_user_auth","=",Auth::id())->truncate();

        return redirect()->route("listePostes")->with("message","Nettoyage effectué avec succès!");

    }



}
