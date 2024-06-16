<?php

namespace App\Http\Controllers;

use App\Http\Requests\clientModifyRequest;
use App\Http\Requests\clientPostRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    //
    public function receptionistListeClient(Request $request):View{

        $user_auth = DB::table("users")->where("id","=",Auth::id())->first();
        $clients = DB::table("users")->where("role","=","client")->where("id_user_action","=",$user_auth->id_user_action)->paginate(10);

        if($request->filled("search")){

            $clients = DB::table("users")->where("role","=","client")->where("id_user_action","=",$user_auth->id_user_action)->whereAny([

                "name",
                "email",
                "telephone",
                "entreprise",

            ],"LIKE","%".$request->search."%")->paginate(10);

        }else{

            $clients = DB::table("users")->where("role","=","client")->where("id_user_action","=",$user_auth->id_user_action)->paginate(10);

        }


        return view("users/clients/receptionniste/liste",[

            "clients" => $clients,

        ]);


    }



    public function gerantListeClient(Request $request):View{


        $clients = DB::table("users")->where("role","=","client")->where("id_user_action","=",Auth::id())->paginate(10);

        if($request->filled("search")){

            $clients = DB::table("users")->where("role","=","client")->where("id_user_action","=",Auth::id())->whereAny([

                "name",
                "email",
                "telephone",
                "adresse",

            ],"LIKE","%".$request->search."%")->paginate(10);

        }else{

            $clients = DB::table("users")->where("role","=","client")->where("id_user_action","=",Auth::id())->paginate(10);

        }


        return view("users/clients/gerant/liste",[

            "clients" => $clients,

        ]);



    }




    public function receptionistAjoutClient():View{

        return view("users/clients/receptionniste/ajout");

    }


    public function gerantAjoutClient():View{

        return view("users/clients/gerant/ajout");

    }


    public function geantDeleteClient(User $client){

        $client -> delete();

        return redirect()->route("gerantListeClient",['client' => $client->id])->with('message',"Client supprimé avec succès!");

    }


    public function geantDeleteAllClient(){

        DB::table('users')->where('id_user_action','=', Auth::id())->where("role","=","client")->delete();

        return redirect()->route("gerantListeClient")->with('message',"Nettoyage effectué avec succès!");

    }



    public function receptionistPostClient(clientPostRequest $request){

        $info_receptionist = DB::table("users")->where("id","=",Auth::id())->first();
        $info_gerant = DB::table("users")->where("id","=",$info_receptionist->id_user_action)->first();
        $cat_client = DB::table("categorie_users")->where("nom_cat_user","=","CLIENT")->first();

        $users = DB::table("users")->where('id_user_action',"=",$info_receptionist->id_user_action)->get();
        $nbr_users = count($users);
        $nbr_user_formule = DB::table('formules')->where("id","=",$info_gerant->id_formule)->first();

        $photoPath ="";

        if($request->hasFile("photo")){

            $photoPath = $request->file('photo')->store('images', 'public');

            if($nbr_users <= $nbr_user_formule->nbr_user){

                User::create([

                    'name' => $request->name,
                    'email' =>  $request->email,
                    'telephone' => $request->telephone,
                    'entreprise' => $info_gerant->entreprise,
                    'password' => Hash::make($request->password),
                    'fin_souscription' => $info_gerant->fin_souscription,
                    'id_cat_user' => $cat_client->id,
                    'id_etat_user' => $info_gerant->id_etat_user,
                    'id_formule' => $info_gerant->id_formule,
                    'lieu_habitation' => $request->lieu_habitation,
                    'adresse' => $request->adresse,
                    'civilite' => $request->civilite,
                    'id_user_action' => $info_gerant->id,
                    'role' => "client",
                    'photo' => $photoPath,

                ]);

                return redirect()->route("receptionistAjoutClient")->with('message',"Client ajouté avec succès!");


            }else{

                return redirect()->route('receptionistAjoutClient')->with('message', "Désoler! Vous ne pouvez pas enregister plus de ".$nbr_user_formule->nbr_user." utilisateur(s)");

            }


        }else{


            if($nbr_users <= $nbr_user_formule->nbr_user){

                User::create([

                    'name' => $request->name,
                    'email' =>  $request->email,
                    'telephone' => $request->telephone,
                    'entreprise' => $info_gerant->entreprise,
                    'password' => Hash::make($request->password),
                    'fin_souscription' => $info_gerant->fin_souscription,
                    'id_cat_user' => $cat_client->id,
                    'id_etat_user' => $info_gerant->id_etat_user,
                    'id_formule' => $info_gerant->id_formule,
                    'lieu_habitation' => $request->lieu_habitation,
                    'adresse' => $request->adresse,
                    'civilite' => $request->civilite,
                    'id_user_action' => $info_gerant->id,
                    'role' => "client",

                ]);

                return redirect()->route("receptionistAjoutClient")->with('message',"Client ajouté avec succès!");


            }else{

                return redirect()->route('receptionistAjoutClient')->with('message', "Désoler! Vous ne pouvez pas enregister plus de ".$nbr_user_formule->nbr_user." utilisateur(s)");

            }


        }



    }


    public function gerantPostClient(clientPostRequest $request){

        $info_gerant = DB::table("users")->where("id","=",Auth::id())->first();

        $cat_client = DB::table("categorie_users")->where("nom_cat_user","=","CLIENT")->first();

        $users = DB::table("users")->where('id_user_action',"=",$info_gerant->id)->get();
        $nbr_users = count($users);
        $nbr = $nbr_users + 1;
        $nbr_user_formule = DB::table('formules')->where("id","=",$info_gerant->id_formule)->first();

        $photoPath ="";

        if($request->hasFile("photo")){

            $photoPath = $request->file('photo')->store('images', 'public');

            if($nbr < $nbr_user_formule->nbr_user){

                User::create([

                    'name' => $request->name,
                    'email' =>  $request->email,
                    'telephone' => $request->telephone,
                    'entreprise' => $info_gerant->entreprise,
                    'password' => Hash::make($request->password),
                    'fin_souscription' => $info_gerant->fin_souscription,
                    'id_cat_user' => $cat_client->id,
                    'id_etat_user' => $info_gerant->id_etat_user,
                    'id_formule' => $info_gerant->id_formule,
                    'lieu_habitation' => $request->lieu_habitation,
                    'adresse' => $request->adresse,
                    'civilite' => $request->civilite,
                    'id_user_action' => $info_gerant->id,
                    'role' => "client",
                    'photo' => $photoPath,

                ]);

                return redirect()->route("gerantAjoutClient")->with('message',"Client ajouté avec succès!");


            }else{

                return redirect()->route('gerantAjoutClient')->with('message', "Désoler! Vous ne pouvez pas enregister plus de ".$nbr_user_formule->nbr_user." utilisateur(s)");

            }


        }else{


            if($nbr < $nbr_user_formule->nbr_user){

                User::create([

                    'name' => $request->name,
                    'email' =>  $request->email,
                    'telephone' => $request->telephone,
                    'entreprise' => $info_gerant->entreprise,
                    'password' => Hash::make($request->password),
                    'fin_souscription' => $info_gerant->fin_souscription,
                    'id_cat_user' => $cat_client->id,
                    'id_etat_user' => $info_gerant->id_etat_user,
                    'id_formule' => $info_gerant->id_formule,
                    'lieu_habitation' => $request->lieu_habitation,
                    'adresse' => $request->adresse,
                    'civilite' => $request->civilite,
                    'id_user_action' => $info_gerant->id,
                    'role' => "client",

                ]);

                return redirect()->route("gerantAjoutClient")->with('message',"Client ajouté avec succès!");


            }else{

                return redirect()->route('gerantAjoutClient')->with('message', "Désoler! Vous ne pouvez pas enregister plus de ".$nbr_user_formule->nbr_user." utilisateur(s)");

            }


        }



    }



    public function receptionistDetailClient(User $client):View{

        $info_etat_client = DB::table('etat_users')->where('id','=',$client->id_etat_user)->first();
        $other_etat_clients = DB::table('etat_users')->where('id','!=',$client->id_etat_user)->get();

        return view("users/clients/receptionniste/detail",[

            "client" => $client,
            "info_etat_client" => $info_etat_client,
            "other_etat_clients" => $other_etat_clients,

        ]);

    }


    public function gerantDetailClient(User $client):View{

        $info_etat_client = DB::table('etat_users')->where('id','=',$client->id_etat_user)->first();
        $other_etat_clients = DB::table('etat_users')->where('id','!=',$client->id_etat_user)->get();

        //statistique employers

        $facture_delivres = DB::table("factures")->where("etat_traitement","!=","")->where("nom_titulaire","=",$client->nom_titulaire)->where("tel_titulaire","=",$client->tel_titulaire)->get();
        $nbr_facture_delivres = count($facture_delivres);

        $vetements = DB::table("recepts")->where("nom_client","=",$client->nom_titulaire)->where("tel_client","=",$client->tel_titulaire)->where("id_company","=",$client->id_user_action)->get();
        $nbr_vetements = count($vetements);

        $profil = DB::table("factures")->where("etat_traitement","!=","")->where("nom_titulaire","=",$client->nom_titulaire)->where("tel_titulaire","=",$client->tel_titulaire)->sum("montant");

        return view("users/clients/gerant/detail",[

            "client" => $client,
            "info_etat_client" => $info_etat_client,
            "other_etat_clients" => $other_etat_clients,
            "nbr_facture_delivres" => $nbr_facture_delivres,
            "profil" => $profil,
            "nbr_vetements" => $nbr_vetements,


        ]);

    }



    public function receptionistPutEtatClient(User $client, Request $request){

        $client->id_etat_user = $request->id_etat_user;

        $client -> save();

        return redirect()->route("receptionistDetailClient",["client" => $client->id])->with('message',"Etat modifié avec succès!");

    }


    public function gerantPutEtatClient(User $client, Request $request){

        $client->id_etat_user = $request->id_etat_user;

        $client -> save();

        return redirect()->route("gerantDetailClient",["client" => $client->id])->with('message',"Etat modifié avec succès!");

    }



    public function receptionistModifyClient(User $client){

        return view("users/clients/receptionniste/modify",[

            "client" => $client,

        ]);

    }


    public function gerantModifyClient(User $client){

        return view("users/clients/gerant/modify",[

            "client" => $client,

        ]);

    }


    public function receptionistPutClient(User $client, clientModifyRequest $request){

        if($request->hasFile("photo")){

            $photoPath = $request->file('photo')->store('images', 'public');

            $client->name = $request->name;
            $client->email = $request->email;
            $client->telephone = $request->telephone;
            $client->lieu_habitation = $request->lieu_habitation;
            $client->adresse = $request->adresse;
            $client->civilite = $request->civilite;
            $client->photo = $photoPath;

            $client -> save();

            return redirect()->route('receptionistModifyClient',['client' => $client->id])->with('message',"Mise à jour réussit!");

        }else{

            $client->name = $request->name;
            $client->email = $request->email;
            $client->telephone = $request->telephone;
            $client->lieu_habitation = $request->lieu_habitation;
            $client->adresse = $request->adresse;
            $client->civilite = $request->civilite;

            $client -> save();

            return redirect()->route('receptionistModifyClient',['client' => $client->id])->with('message',"Mise à jour réussit!");


        }


    }


    public function gerantPutClient(User $client, clientModifyRequest $request){

        if($request->hasFile("photo")){

            $photoPath = $request->file('photo')->store('images', 'public');

            $client->name = $request->name;
            $client->email = $request->email;
            $client->telephone = $request->telephone;
            $client->lieu_habitation = $request->lieu_habitation;
            $client->adresse = $request->adresse;
            $client->civilite = $request->civilite;
            $client->photo = $photoPath;

            $client -> save();

            return redirect()->route('gerantModifyClient',['client' => $client->id])->with('message',"Mise à jour réussit!");

        }else{

            $client->name = $request->name;
            $client->email = $request->email;
            $client->telephone = $request->telephone;
            $client->lieu_habitation = $request->lieu_habitation;
            $client->adresse = $request->adresse;
            $client->civilite = $request->civilite;

            $client -> save();

            return redirect()->route('gerantModifyClient',['client' => $client->id])->with('message',"Mise à jour réussit!");


        }


    }


}
