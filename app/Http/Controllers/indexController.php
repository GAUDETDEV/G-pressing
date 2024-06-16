<?php

namespace App\Http\Controllers;

use App\Http\Requests\gerantPostRequest;
use App\Models\Formule;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class indexController extends Controller
{
    //
    public function index():View{

        $infos_sudo = DB::table('users')->where('role','=','sudo')->first();
        $infos_formules = DB::table('formules')->get();

        return view('index',[

            "infos_sudo" => $infos_sudo,
            "infos_formules" => $infos_formules,

        ]);

    }

    public function suscribeFormule(Formule $formule){

        return view("formules/suscribe",[
            "formule" => $formule,
        ]);

    }


    public function postSuscribe(gerantPostRequest $request, Formule $formule){

        $id_etat_user = DB::table('etat_users')->where('nom_etat_user','=','INACTIF')->first();
        $id_etat_user_default = DB::table('etat_users')->where('nom_etat_user','=','ACTIF')->first();
        $id_cat_user = DB::table('categorie_users')->where('nom_cat_user','=','GERANT')->first();
        $fin_souscription_free = date("Y-m-d",strtotime('+14days'));
        $fin_souscription_other = date("Y-m-d",strtotime('+1month'));

        if($formule->nom_formule == "Free"){

            $photoPath = "";

            if($request->hasFile("photo")){

                $photoPath = $request->file('photo')->store('images', "public");

                User::create([

                    'name' => $request->name,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'entreprise' => $request->entreprise,
                    'password' =>Hash::make($request->password),
                    'fin_souscription' => $fin_souscription_free,
                    'lieu_habitation' => $request->lieu_habitation,
                    'adresse' => $request->adresse,
                    'civilite' => $request->civilite,
                    "id_cat_user" => $id_cat_user->id,
                    "id_etat_user" => $id_etat_user_default->id,
                    "id_formule" => $formule->id,
                    "role" => "gerant",
                    'photo' =>$photoPath,

                ]);

                return redirect()->route('suscribeFormule',['formule'=>$formule])->with('message', "Souscription réussit! Vous pouvez dès à présent profiter de l'offre en vous connectant!");


            }else{

                User::create([

                    'name' => $request->name,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'entreprise' => $request->entreprise,
                    'password' =>Hash::make($request->password),
                    'fin_souscription' => $fin_souscription_free,
                    'lieu_habitation' => $request->lieu_habitation,
                    'adresse' => $request->adresse,
                    'civilite' => $request->civilite,
                    "id_cat_user" => $id_cat_user->id,
                    "id_etat_user" => $id_etat_user_default->id,
                    "id_formule" => $formule->id,
                    "role" => "gerant",

                ]);

                return redirect()->route('suscribeFormule',['formule'=>$formule])->with('message', "Souscription réussit! Vous pouvez dès à présent profiter de l'offre en vous connectant!");

            }


        }else{


            $photoPath = "";

            if($request->hasFile('photo')){

                $photoPath = $request->file('photo')->store("images", "public");

                User::create([

                    'name' => $request->name,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'entreprise' => $request->entreprise,
                    'password' =>Hash::make($request->password),
                    'fin_souscription' => $fin_souscription_other,
                    'lieu_habitation' => $request->lieu_habitation,
                    'adresse' => $request->adresse,
                    'civilite' => $request->civilite,
                    "id_cat_user" => $id_cat_user->id,
                    "id_etat_user" => $id_etat_user->id,
                    "id_formule" => $formule->id,
                    "role" => "gerant",
                    'photo' =>$photoPath,

                ]);

                return redirect()->route('suscribeFormule',['formule'=>$formule])->with('message', "Souscription réussit! Veulliez nous connacter à l'effet de valider votre souscription pour profiter de l'offre!");


            }else{


                User::create([

                    'name' => $request->name,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'entreprise' => $request->entreprise,
                    'password' =>Hash::make($request->password),
                    'fin_souscription' => $fin_souscription_other,
                    'lieu_habitation' => $request->lieu_habitation,
                    'adresse' => $request->adresse,
                    'civilite' => $request->civilite,
                    "id_cat_user" => $id_cat_user->id,
                    "id_etat_user" => $id_etat_user->id,
                    "id_formule" => $formule->id,
                    "role" => "gerant",

                ]);

                return redirect()->route('suscribeFormule',['formule'=>$formule])->with('message', "Souscription réussit! Veulliez nous connacter à l'effet de valider votre souscription pour profiter de l'offre!");


            }



        }


    }





















}
