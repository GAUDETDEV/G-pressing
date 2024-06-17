<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class setpController extends Controller
{
    //
    public function listeSpet(Request $request):View{

        $info_auth = DB::table("users")->where("id","=",Auth::id())->first();

        if($info_auth->role == "gerant"){

            $liste_factures = DB::table("factures")->where("id_company","=",Auth::id())->get();

            if($request->filled('search')){

                $liste_factures = DB::table("factures")->where("id_company","=",Auth::id())->whereAny([
                    'nom_titulaire',
                    'tel_titulaire',
                ], 'LIKE', '%'.$request->search.'%')->get();

            }else{

                $liste_factures = DB::table("factures")->where("id_company","=",Auth::id())->get();

            }


            return view("setps/gerants/liste",[
                "liste_factures" => $liste_factures,
            ]);


        }elseif($info_auth->role == "receptionniste"){

            $info_auth = DB::table("users")->where("id","=",Auth::id())->first();

            $liste_factures = DB::table("factures")->where("id_company","=",$info_auth->id_user_action)->paginate(10);

            if($request->filled('search')){

                $liste_factures = DB::table("factures")->where("id_company","=",$info_auth->id_user_action)->whereAny([
                    'nom_titulaire',
                    'tel_titulaire',
                ], 'LIKE', '%'.$request->search.'%')->paginate(10);

            }else{

                $liste_factures = DB::table("factures")->where("id_company","=",$info_auth->id_user_action)->paginate(10);

            }

            return view("setps/employers/receptionists/liste",[
                "liste_factures" => $liste_factures,
            ]);


        }elseif($info_auth->role == "client"){

            $info_auth = DB::table("users")->where("id","=",Auth::id())->first();

            $liste_factures = DB::table("factures")->where("id_company","=",$info_auth->id_user_action)->where("nom_titulaire","=",$info_auth->name)->where("tel_titulaire","=",$info_auth->telephone)->paginate(10);

            if($request->filled('search')){

                $liste_factures = DB::table("factures")->where("id_company","=",$info_auth->id_user_action)->where("nom_titulaire","=",$info_auth->name)->where("tel_titulaire","=",$info_auth->telephone)->whereAny([
                    'nom_titulaire',
                    'tel_titulaire',
                ], 'LIKE', '%'.$request->search.'%')->paginate(10);

            }else{

                $liste_factures = DB::table("factures")->where("id_company","=",$info_auth->id_user_action)->where("nom_titulaire","=",$info_auth->name)->where("tel_titulaire","=",$info_auth->telephone)->paginate(10);

            }

            return view("setps/clients/liste",[
                "liste_factures" => $liste_factures,
            ]);


        }


    }



    public function voirSetp(Facture $liste_facture):View{

        return view("setps/view",[
            "liste_facture" => $liste_facture,
        ]);

    }
}
