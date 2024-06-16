<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class recuController extends Controller
{
    //

    public function listeAllRecu(Request $request):View{

        $all_recus = DB::table('factures')->where("id_company","=",Auth::id())->paginate(10);

        $recus = DB::table('factures')->where("id_company","=",Auth::id())->get();

        $nbr_recus = count($recus);

        $montant_total = DB::table('factures')->where("id_company","=",Auth::id())->sum('montant');

        $reste_total = DB::table('factures')->where("id_company","=",Auth::id())->sum('reste');

        if($request->filled("search")){

            $all_recus = DB::table('factures')->where("id_company","=",Auth::id())->whereAny([

                "nom_titulaire",
                "tel_titulaire",
                "statut_facture",
                "montant",
                "reste",

            ],"LIKE","%".$request->search."%")->paginate(10);

            $nbr_recus = count($recus);

            $montant_total = DB::table('factures')->where("id_company","=",Auth::id())->whereAny([

                "nom_titulaire",
                "tel_titulaire",
                "statut_facture",
                "montant",
                "reste",

            ],"LIKE","%".$request->search."%")->sum('montant');

            $reste_total = DB::table('factures')->where("id_company","=",Auth::id())->whereAny([

                "nom_titulaire",
                "tel_titulaire",
                "statut_facture",
                "montant",
                "reste",

            ],"LIKE","%".$request->search."%")->sum('reste');


        }else{

            $all_recus = DB::table('factures')->where("id_company","=",Auth::id())->paginate(10);

        }

        return view("recus/all/liste",[

            "all_recus" => $all_recus,
            "montant_total" => $montant_total,
            "nbr_recus" => $nbr_recus,
            "reste_total" => $reste_total,

        ]);


    }

    public function AllDetails(Facture $recu):View{

        $editor = DB::table("users")->where("id","=",$recu->id_editor)->value("name");

        $liste_vet_recepts = DB::table("recepts")->where("id_facture","=",$recu->id)->get();

        $total_qte = DB::table("recepts")->where("id_facture","=",$recu->id)->where("id_company","=",Auth::id())->sum('qte_vet');
        $total_prix_unit = DB::table("recepts")->where("id_facture","=",$recu->id)->where("id_company","=",Auth::id())->sum('prix_unitaire');
        $total_prix = DB::table("recepts")->where("id_facture","=",$recu->id)->where("id_company","=",Auth::id())->sum('prix');

        return view("recus/all/details",[

            "recu" => $recu,
            "editor" => $editor,
            "liste_vet_recepts" => $liste_vet_recepts,
            "total_qte" => $total_qte,
            "total_prix_unit" => $total_prix_unit,
            "total_prix" => $total_prix,

        ]);

    }


    public function AllDelete(Facture $recu){

      $recu -> delete();

      return redirect()->route("listeAllRecu")->with('message',"Suppression réussit!");

    }



    public function listeMyRecu(Request $request):View{

        $infos_user = DB::table("users")->where("id","=",Auth::id())->first();

        if($infos_user->role === "receptionniste"){

            $my_recus = DB::table('factures')->where("id_editor","=",Auth::id())->where("etat_traitement","!=","")->paginate(10);


            if($request->filled('search')){

                $my_recus = DB::table('factures')->where("id_editor","=",Auth::id())->where("etat_traitement","!=","")->whereAny([

                    "nom_titulaire",
                    "tel_titulaire",

                ],"LIKE","%".$request->search."%")->paginate(10);

            }else{

                $my_recus = DB::table('factures')->where("id_editor","=",Auth::id())->where("etat_traitement","!=","")->paginate(10);

            }


            return view("recus/my/liste",[

                "my_recus" => $my_recus,

            ]);


        }elseif($infos_user->role === "client"){

            $my_recus = DB::table('factures')->where("nom_titulaire","=",$infos_user->name)->where("tel_titulaire","=",$infos_user->telephone)->where("etat_traitement","!=","")->paginate(10);


            if($request->filled('search')){

                $my_recus = DB::table('factures')->where("nom_titulaire","=",$infos_user->name)->where("tel_titulaire","=",$infos_user->telephone)->where("etat_traitement","!=","")->whereAny([

                    "nom_titulaire",
                    "tel_titulaire",

                ],"LIKE","%".$request->search."%")->paginate(10);

            }else{

                $my_recus = DB::table('factures')->where("nom_titulaire","=",$infos_user->name)->where("tel_titulaire","=",$infos_user->telephone)->where("etat_traitement","!=","")->paginate(10);

            }


            return view("recus/clients/liste",[

                "my_recus" => $my_recus,

            ]);


        }

        

    }



}
