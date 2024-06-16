<?php

namespace App\Http\Controllers;

use App\Http\Requests\employerModifyCompteRequest;
use App\Http\Requests\employerModifyRequest;
use App\Http\Requests\gerantModifyCompteRequest;
use App\Http\Requests\gerantModifyRequest;
use App\Http\Requests\sudoModifyCompteRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class compteController extends Controller
{
    //

    public function indexCompteUser():View{

        $info_user = DB::table("users")->where("id","=",Auth::id())->first();
        $infos_formule = DB::table("formules")->where("id","=",$info_user->id_formule)->first();
        $infos_etat = DB::table("etat_users")->where("id","=",$info_user->id_etat_user)->first();

        $my_users = DB::table("users")->where("id_user_action","=",$info_user->id)->get();
        $nbr_my_users = count($my_users);


        if($info_user->role == "sudo" ){

            $users = DB::table("users")->where("role","!=","sudo")->get();
            $nbr_users = count($users);

            $gerants = DB::table("users")->where("role","=","gerant")->get();
            $nbr_gerants = count($gerants);

            return view("comptes/sudo/index",[

                "info_user" => $info_user,
                "infos_formule" => $infos_formule,
                "infos_etat" => $infos_etat,
                "nbr_users" => $nbr_users,
                "nbr_gerants" => $nbr_gerants,


            ]);


        }


        if($info_user->role =="gerant" ){

            return view("comptes/gerants/index",[

                "info_user" => $info_user,
                "infos_formule" => $infos_formule,
                "infos_etat" => $infos_etat,
                "nbr_my_users" => $nbr_my_users,

            ]);


        }


        if($info_user->role =="receptionniste" or $info_user->role =="laveur" or $info_user->role =="repasseur" or $info_user->role =="livreur"){

            $info_gerant = DB::table("users")->where("id","=",$info_user->id_user_action)->first();
            $info_poste = DB::table("postes")->where("id","=",$info_user->id_poste)->first();

            return view("comptes/employers/index",[

                "info_user" => $info_user,
                "infos_formule" => $infos_formule,
                "infos_etat" => $infos_etat,
                "info_gerant" => $info_gerant,
                "info_poste" => $info_poste,

            ]);


        }


        if($info_user->role =="client"){

            $info_gerant = DB::table("users")->where("id","=",$info_user->id_user_action)->first();
            $info_client = DB::table("users")->where("id","=",$info_user->id_user_action)->first();
            $factures = DB::table("factures")->where("nom_titulaire","=",$info_user->name)->where("tel_titulaire","=",$info_user->telephone)->get();
            $nbr_vet_recept = DB::table("recepts")->where("nom_client","=",$info_user->name)->where("tel_client","=",$info_user->telephone)->where("id_company","=",$info_user->id_user_action)->sum("qte_vet");

            $nbr_fature = count($factures);

            return view("comptes/clients/index",[

                "info_user" => $info_user,
                "infos_formule" => $infos_formule,
                "infos_etat" => $infos_etat,
                "info_client" => $info_client,
                "info_gerant" => $info_gerant,
                "nbr_fature" => $nbr_fature,
                "nbr_vet_recept" => $nbr_vet_recept,

            ]);


        }


    }



    public function modifyCompteSudo(User $sudo):View{

        $formule = DB::table("formules")->where("id","=",$sudo->id_formule)->first();
        $other_formules = DB::table("formules")->where("id","!=",$sudo->id_formule)->get();

        return view("comptes/sudo/modify",[

            "sudo" => $sudo,
            "formule" => $formule,
            "other_formules" => $other_formules,

        ]);


    }




    public function modifyCompteGerant(User $gerant):View{

        return view("comptes/gerants/modify",[

            "gerant" => $gerant,

        ]);


    }



    public function modifyCompteEmployer(User $employer):View{

        return view("comptes/employers/modify",[

            "employer" => $employer,

        ]);


    }


    public function modifyCompteClient(User $client):View{

        return view("comptes/clients/modify",[

            "client" => $client,

        ]);


    }


    public function putCompteGerant(User $gerant, gerantModifyCompteRequest $request){

        $today = date('Y-m-d h:i:s');

        $photoPath = "";

        if($request->hasFile("photo")){

            $photoPath = $request->file('photo')->store('images', "public");

            $gerant->name = $request->name;
            $gerant->lieu_habitation = $request->lieu_habitation;
            $gerant->adresse = $request->adresse;
            $gerant->entreprise = $request->entreprise;
            $gerant->civilite = $request->civilite;
            $gerant->photo = $photoPath;

            $gerant -> save();

            return redirect()->route('modifyCompteGerant',["gerant"=>$gerant->id])->with('message', "Mise à jour réussit!");

        }else{


            $gerant->name = $request->name;
            $gerant->lieu_habitation = $request->lieu_habitation;
            $gerant->adresse = $request->adresse;
            $gerant->civilite = $request->civilite;
            $gerant->entreprise = $request->entreprise;

            $gerant -> save();

            return redirect()->route('modifyCompteGerant',["gerant"=>$gerant->id])->with('message', "Mise à jour réussit!");


        }


    }



    public function putCompteSudo(User $sudo, sudoModifyCompteRequest $request){

        $today = date('Y-m-d h:i:s');

        $photoPath = "";

        if($request->hasFile("photo")){

            $photoPath = $request->file('photo')->store('images', "public");

            $sudo->name = $request->name;
            $sudo->email = $request->email;
            $sudo->telephone = $request->telephone;
            $sudo->lieu_habitation = $request->lieu_habitation;
            $sudo->adresse = $request->adresse;
            $sudo->civilite = $request->civilite;
            $sudo->entreprise = $request->entreprise;
            $sudo->fin_souscription = $request->fin_souscription;
            $sudo->id_formule = $request->id_formule;
            $sudo->photo = $photoPath;

            $sudo -> save();

            return redirect()->route('modifyCompteSudo',["sudo"=>$sudo->id])->with('message', "Mise à jour réussit!");

        }else{

            $sudo->name = $request->name;
            $sudo->email = $request->email;
            $sudo->telephone = $request->telephone;
            $sudo->lieu_habitation = $request->lieu_habitation;
            $sudo->adresse = $request->adresse;
            $sudo->civilite = $request->civilite;
            $sudo->entreprise = $request->entreprise;
            $sudo->fin_souscription = $request->fin_souscription;
            $sudo->id_formule = $request->id_formule;

            $sudo -> save();

            return redirect()->route('modifyCompteSudo',["sudo"=>$sudo->id])->with('message', "Mise à jour réussit!");


        }


    }




    public function putCompteEmployer(User $employer, employerModifyCompteRequest $request){

        $today = date('Y-m-d h:i:s');

        $info_gerant = DB::table("users")->where("id","=", $employer->id_user_action)->first();

        $photoPath = "";

        if($request->hasFile("photo")){

            $photoPath = $request->file('photo')->store('images', "public");

            $employer->name = $request->name;
            $employer->lieu_habitation = $request->lieu_habitation;
            $employer->adresse = $request->adresse;
            $employer->entreprise = $info_gerant->entreprise;
            $employer->civilite = $request->civilite;
            $employer->photo = $photoPath;

            $employer -> save();

            return redirect()->route('modifyCompteEmployer',["employer"=>$employer->id])->with('message', "Mise à jour réussit!");

        }else{


            $employer->name = $request->name;
            $employer->lieu_habitation = $request->lieu_habitation;
            $employer->adresse = $request->adresse;
            $employer->civilite = $request->civilite;
            $employer->entreprise = $info_gerant->entreprise;

            $employer -> save();

            return redirect()->route('modifyCompteEmployer',["employer"=>$employer->id])->with('message', "Mise à jour réussit!");


        }


    }




    public function putCompteClient(User $client, employerModifyCompteRequest $request){

        $today = date('Y-m-d h:i:s');

        $info_gerant = DB::table("users")->where("id","=", $client->id_user_action)->first();

        $photoPath = "";

        if($request->hasFile("photo")){

            $photoPath = $request->file('photo')->store('images', "public");

            $client->name = $request->name;
            $client->lieu_habitation = $request->lieu_habitation;
            $client->adresse = $request->adresse;
            $client->entreprise = $info_gerant->entreprise;
            $client->civilite = $request->civilite;
            $client->photo = $photoPath;

            $client -> save();

            return redirect()->route('modifyCompteClient',["client"=>$client->id])->with('message', "Mise à jour réussit!");

        }else{


            $client->name = $request->name;
            $client->lieu_habitation = $request->lieu_habitation;
            $client->adresse = $request->adresse;
            $client->civilite = $request->civilite;
            $client->entreprise = $info_gerant->entreprise;

            $client -> save();

            return redirect()->route('modifyCompteClient',["client"=>$client->id])->with('message', "Mise à jour réussit!");


        }


    }





}
