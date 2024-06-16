<?php

namespace App\Http\Controllers;

use App\Http\Requests\tachePostRequest;
use App\Models\Facture;
use App\Models\Tache;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class planningController extends Controller
{
    //

    public function indexPlanning():View{

        return view("planning/accueil");

    }


    public function planningRecep():View{

        $today = date("Y-m-d");
        $poste_recept = DB::table('postes')->where("titre_poste","=","receptionniste")->where("id_user_auth","=",Auth::id())->first();
        $liste_receptionnistes = DB::table("users")->where("id_poste","=",$poste_recept->id)->where("id_user_action","=",Auth::id())->get();

        return view("planning/reception/edit",[

            "liste_receptionnistes" => $liste_receptionnistes,
            "today" => $today,

        ]);

    }

    public function planningLavage(Facture $facture_lavage):View{

        $today = date("Y-m-d");
        $poste_laveur = DB::table('postes')->where("titre_poste","=","laveur")->where("id_user_auth","=",Auth::id())->first();
        $liste_laveurs = DB::table("users")->where("id_poste","=",$poste_laveur->id)->where("id_user_action","=",Auth::id())->get();

        return view("planning/lavage/edit",[

            "facture_lavage" => $facture_lavage,
            "liste_laveurs" => $liste_laveurs,
            "today" => $today,

        ]);

    }


    public function planningRepassage(Facture $facture_repassage):View{

        $today = date("Y-m-d");
        $poste_repasseur = DB::table('postes')->where("titre_poste","=","repasseur")->where("id_user_auth","=",Auth::id())->first();
        $liste_repasseurs = DB::table("users")->where("id_poste","=",$poste_repasseur->id)->where("id_user_action","=",Auth::id())->get();

        return view("planning/repassage/edit",[

            "facture_repassage" => $facture_repassage,
            "liste_repasseurs" => $liste_repasseurs,
            "today" => $today,

        ]);

    }


    public function planningLivraison(Facture $facture_livraison):View{

        $today = date("Y-m-d");
        $poste_livreur = DB::table('postes')->where("titre_poste","=","livreur")->where("id_user_auth","=",Auth::id())->first();
        $liste_livreurs = DB::table("users")->where("id_poste","=",$poste_livreur->id)->where("id_user_action","=",Auth::id())->get();

        return view("planning/livraison/edit",[

            "facture_livraison" => $facture_livraison,
            "liste_livreurs" => $liste_livreurs,
            "today" => $today,

        ]);

    }


    public function postPlanningRecep(tachePostRequest $request){

        Tache::create([

            'type_tache' => "reception",
            'etat_tache' => "En attente",
            'debut_tache' => $request->debut_tache,
            'fin_tache' => $request->fin_tache,
            'id_executant' => $request->id_executant,
            'id_create_tache' => Auth::id(),

        ]);

        return redirect()->route('planningRecep')->with('message', "Tâche enregistré avec succes!");


    }


    public function postPlanningLavage(Facture $facture_lavage, tachePostRequest $request){

        Tache::create([

            'type_tache' => "lavage",
            'etat_tache' => "En attente",
            'debut_tache' => $request->debut_tache,
            'fin_tache' => $request->fin_tache,
            'id_executant' => $request->id_executant,
            'id_facture' => $facture_lavage->id,
            'id_create_tache' => Auth::id(),

        ]);

        return redirect()->route('planningLavage',['facture_lavage' => $facture_lavage])->with('message', "Tâche enregistré avec succes!");


    }


    public function postPlanningRepassage(Facture $facture_repassage, tachePostRequest $request){

        Tache::create([

            'type_tache' => "repassage",
            'etat_tache' => "En attente",
            'debut_tache' => $request->debut_tache,
            'fin_tache' => $request->fin_tache,
            'id_executant' => $request->id_executant,
            'id_facture' => $facture_repassage->id,
            'id_create_tache' => Auth::id(),

        ]);

        return redirect()->route('planningRepassage',['facture_repassage' => $facture_repassage])->with('message', "Tâche enregistré avec succes!");


    }


    public function postPlanningLivraison(Facture $facture_livraison, tachePostRequest $request){

        Tache::create([

            'type_tache' => "livraison",
            'etat_tache' => "En attente",
            'debut_tache' => $request->debut_tache,
            'fin_tache' => $request->fin_tache,
            'id_executant' => $request->id_executant,
            'id_facture' => $facture_livraison->id,
            'id_create_tache' => Auth::id(),

        ]);

        return redirect()->route('planningLivraison',['facture_livraison' => $facture_livraison])->with('message', "Tâche enregistré avec succes!");


    }


    public function listeFactureLavage(Request $request):View{

        $facture_lavages = DB::table("factures")->where("etat_traitement","=","Depot")->where("id_company","=",Auth::id())->paginate(15);

        if($request->filled("search")){

            $facture_lavages = DB::table("factures")->where("etat_traitement","=","Depot")->where("id_company","=",Auth::id())->whereAny([

                "nom_titulaire",
                "tel_titulaire",
                "etat_traitement",

            ],"LIKE","%".$request->search."%")->paginate(15);

        }else{

            $facture_lavages = DB::table("factures")->where("etat_traitement","=","Depot")->where("id_company","=",Auth::id())->paginate(15);

        }


        return view("planning/lavage/liste",[

            "facture_lavages" => $facture_lavages,

        ]);

    }


    public function listeFactureRepassage(Request $request):View{

        $facture_repassages = DB::table("factures")->where("id_company","=",Auth::id())->where("etat_traitement","=","Lavage")->paginate(15);
        $facture_supplements = DB::table("factures")->where("id_company","=",Auth::id())->where("id_service","!=","")->where("etat_traitement","=","Depot")->paginate(15);


        if($request->filled("search")){

            $facture_repassages = DB::table("factures")->where("id_company","=",Auth::id())->where("etat_traitement","=","Lavage")->whereAny([

                "nom_titulaire",
                "tel_titulaire",
                "etat_traitement",

            ],"LIKE","%".$request->search."%")->paginate(15);


            $facture_supplements = DB::table("factures")->where("id_company","=",Auth::id())->where("id_service","!=","")->where("etat_traitement","=","Depot")->whereAny([

                "nom_titulaire",
                "tel_titulaire",
                "etat_traitement",

            ],"LIKE","%".$request->search."%")->paginate(15);


        }else{

            $facture_repassages = DB::table("factures")->where("id_company","=",Auth::id())->where("etat_traitement","=","Lavage")->paginate(15);

            $facture_supplements = DB::table("factures")->where("id_company","=",Auth::id())->where("id_service","!=","")->where("etat_traitement","=","Depot")->paginate(15);

        }


        return view("planning/repassage/liste",[

            "facture_repassages" => $facture_repassages,
            "facture_supplements" => $facture_supplements,

        ]);

    }


    public function listeFactureLivraison(Request $request):View{

        $facture_livraisons = DB::table("factures")->where("id_company","=",Auth::id())->where("etat_livraison","=","Oui")->where("etat_traitement","=","Repassage")->paginate(15);

        $facture_supplements = DB::table("factures")->where("id_company","=",Auth::id())->where("etat_livraison","=", "Oui" )->where("etat_traitement","=","Lavage")->where("id_service","!=","")
        ->orWhere("id_company","=",Auth::id())->where("etat_livraison","=", "Oui" )->where("etat_traitement","=","Repassage")->where("id_service","!=","")->paginate(15);


        if($request->filled("search")){

            $facture_livraisons = DB::table("factures")->where("id_company","=",Auth::id())->where("etat_livraison","=", "Oui" )->where("etat_traitement","=","Repassage")->whereAny([

                "nom_titulaire",
                "tel_titulaire",
                "etat_traitement",

            ],"LIKE","%".$request->search."%")->paginate(15);


            $facture_supplements = DB::table("factures")->where("id_company","=",Auth::id())->where("etat_livraison","=", "Oui" )->where("etat_traitement","=","Lavage")->where("id_service","!=","")
            ->orWhere("id_company","=",Auth::id())->where("etat_livraison","=", "Oui" )->where("etat_traitement","=","Repassage")->where("id_service","!=","")
            ->whereAny([

                "nom_titulaire",
                "tel_titulaire",
                "etat_traitement",

            ],"LIKE","%".$request->search."%")->paginate(15);


        }else{

            $facture_livraisons = DB::table("factures")->where("id_company","=",Auth::id())->where("etat_livraison","=", "Oui" )->where("etat_traitement","=","Repassage")->paginate(15);

            $facture_supplements = DB::table("factures")->where("id_company","=",Auth::id())->where("etat_livraison","=", "Oui" )->where("etat_traitement","=","Lavage")->where("id_service","!=","")
            ->orWhere("id_company","=",Auth::id())->where("etat_livraison","=", "Oui" )->where("etat_traitement","=","Repassage")->where("id_service","!=","")->paginate(15);

        }


        return view("planning/livraison/liste",[

            "facture_livraisons" => $facture_livraisons,
            "facture_supplements" => $facture_supplements,

        ]);

    }



    public function editFactureLavage(Facture $facture_lavage):View{

        return view("planning/lavage/edit",[

            "facture_lavage" => $facture_lavage,

        ]);

    }

}
