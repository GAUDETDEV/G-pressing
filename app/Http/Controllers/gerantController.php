<?php

namespace App\Http\Controllers;

use App\Http\Requests\gerantModifyRequest;
use App\Http\Requests\gerantPostRequest;
use App\Models\Formule;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use LDAP\Result;
use PhpParser\NodeVisitor\FirstFindingVisitor;

class gerantController extends Controller
{
    //

    public function putEtatGerant(User $gerant, Request $request){


        DB::table('users')->where('id','=', $gerant->id)->update(['id_etat_user' => $request->id_etat_user]);

        DB::table('users')->where('id_user_action','=', $gerant->id)->update(['id_etat_user' => $request->id_etat_user]);

        return redirect()->route('detailGerant',['gerant' => $gerant->id])->with('message', "L'état a été modifiée avec succès!");


    }


    public function putCatGerant(User $gerant, Request $request){

        $gerant->id_cat_user = $request->id_cat_user;

        $gerant -> save();

        return redirect()->route('detailGerant',['gerant' => $gerant->id])->with('message', "La catégorie a été modifiée avec succès!");

    }



    public function detailGerant(User $gerant):View{

        $info_formule = DB::table('formules')->where('id','=',$gerant->id_formule)->first();
        $info_etat_user = DB::table('etat_users')->where('id','=',$gerant->id_etat_user)->first();
        $other_etat_users = DB::table('etat_users')->where('id','!=',$gerant->id_etat_user)->get();
        $info_cat_user = DB::table('categorie_users')->where('id','=',$gerant->id_cat_user)->first();
        $other_cat_users = DB::table('categorie_users')->where('id','!=',$gerant->id_cat_user)->get();
        $nbr_user = DB::table('users')->where('id_user_action','=',$gerant->id)->get();
        $total_user = count($nbr_user);


        return view('users/gerants/detail',[
            "gerant" => $gerant,
            "info_formule" => $info_formule,
            "info_etat_user" => $info_etat_user,
            "info_cat_user" => $info_cat_user,
            "other_cat_users" => $other_cat_users,
            "other_etat_users" => $other_etat_users,
            "total_user" => $total_user,
        ]);

    }



    public function deleteGerant(User $gerant){

        $gerant->delete();

        return redirect()->route('listeGerants')->with('message', "Suppression réussit!");

    }


    public function modifyGerant(User $gerant):View{

        return view('users/gerants/modify',[
            "gerant" => $gerant,
        ]);

    }

    public function putGerant(User $gerant, gerantModifyRequest $request){

        $photoPath = "";

        if($request->filled("photo")){

            $photoPath = $request->file('photo')->store('images','public');

            $today = date('Y-m-d h:i:s');

            $gerant->name = $request->name;
            $gerant->entreprise = $request->entreprise;
            $gerant->lieu_habitation = $request->lieu_habitation;
            $gerant->adresse = $request->adresse;
            $gerant->civilite = $request->civilite;
            $gerant->updated_at = $today;
            $gerant->photo = $photoPath;
            $gerant -> save();

            return redirect()->route('modifyGerant',["gerant"=>$gerant->id])->with('message', "Mise à jour réussit!");


        }else{

            $today = date('Y-m-d h:i:s');

            $gerant->name = $request->name;
            $gerant->entreprise = $request->entreprise;
            $gerant->lieu_habitation = $request->lieu_habitation;
            $gerant->adresse = $request->adresse;
            $gerant->civilite = $request->civilite;
            $gerant->updated_at = $today;
            $gerant -> save();

            return redirect()->route('modifyGerant',["gerant"=>$gerant->id])->with('message', "Mise à jour réussit!");


        }

    }



    public function listeGerant(Request $request):View{

        $id_cat_gerant = DB::table('categorie_users')->where('nom_cat_user','=', "GERANT")->value('id');

        if($request->filled('search')){


            $gerants = DB::table('users')->where('id_cat_user','=', $id_cat_gerant)->whereAny([

                "name",
                "email",
                "telephone",
                "entreprise",

            ],"LIKE",$request->search."%")->paginate(10);

        }else{

            $gerants = DB::table('users')->where('id_cat_user','=', $id_cat_gerant)->paginate(10);

        }


        return view('users/gerants/liste',[
            "gerants" => $gerants,
        ]);

    }



    public function ajouterGerant():View{

        $formules = DB::table('formules')->get();

        return view("users/gerants/ajout",[
            "formules" => $formules,
        ]);

    }



    public function showForm(Formule $formule){

        return view("users/gerants/formulaire",[
            "formule" => $formule,
        ]);

    }

    public function postGerant(gerantPostRequest $request, Formule $formule){

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
                    'telephone' => $request->telephone,
                    'lieu_habitation' => $request->lieu_habitation,
                    'adresse' => $request->adresse,
                    'civilite' => $request->civilite,
                    'email' => $request->email,
                    'entreprise' => $request->entreprise,
                    'password' =>Hash::make($request->password),
                    'photo' =>$photoPath,
                    'fin_souscription' => $fin_souscription_free,
                    "id_cat_user" => $id_cat_user->id,
                    "id_etat_user" => $id_etat_user_default->id,
                    "id_formule" => $formule->id,
                    "role" => "gerant",

                ]);

                return redirect()->route('showForm',['formule'=>$formule])->with('message', "Gérant enregistré avec succes!");


            }else{

                User::create([

                    'name' => $request->name,
                    'telephone' => $request->telephone,
                    'lieu_habitation' => $request->lieu_habitation,
                    'adresse' => $request->adresse,
                    'civilite' => $request->civilite,
                    'email' => $request->email,
                    'entreprise' => $request->entreprise,
                    'password' =>Hash::make($request->password),
                    'fin_souscription' => $fin_souscription_free,
                    "id_cat_user" => $id_cat_user->id,
                    "id_etat_user" => $id_etat_user_default->id,
                    "id_formule" => $formule->id,
                    "role" => "gerant",

                ]);

                return redirect()->route('showForm',['formule'=>$formule])->with('message', "Gérant enregistré avec succes!");

            }


        }else{


            $photoPath = "";

            if($request->hasFile('photo')){

                $photoPath = $request->file('photo')->store("images", "public");

                User::create([

                    'name' => $request->name,
                    'telephone' => $request->telephone,
                    'lieu_habitation' => $request->lieu_habitation,
                    'adresse' => $request->adresse,
                    'civilite' => $request->civilite,
                    'email' => $request->email,
                    'entreprise' => $request->entreprise,
                    'password' =>Hash::make($request->password),
                    'photo' =>$photoPath,
                    'fin_souscription' => $fin_souscription_other,
                    "id_cat_user" => $id_cat_user->id,
                    "id_etat_user" => $id_etat_user_default->id,
                    "id_formule" => $formule->id,
                    "role" => "gerant",

                ]);

                return redirect()->route('showForm',['formule'=>$formule])->with('message', "Gérant enregistré avec succes!");



            }else{


                User::create([

                    'name' => $request->name,
                    'telephone' => $request->telephone,
                    'lieu_habitation' => $request->lieu_habitation,
                    'adresse' => $request->adresse,
                    'civilite' => $request->civilite,
                    'email' => $request->email,
                    'entreprise' => $request->entreprise,
                    'password' =>Hash::make($request->password),
                    'fin_souscription' => $fin_souscription_other,
                    "id_cat_user" => $id_cat_user->id,
                    "id_etat_user" => $id_etat_user_default->id,
                    "id_formule" => $formule->id,
                    "role" => "gerant",

                ]);

                return redirect()->route('showForm',['formule'=>$formule])->with('message', "Gérant enregistré avec succes!");


            }



        }


    }




    public function reabonnerGerant():View{

        $formules = DB::table('formules')->where('nom_formule',"!=","Free")->get();

        return view('users/gerants/reinsert',[
            "formules" => $formules,
        ]);

    }


    public function reabonnerRecapGerant(Formule $formule){

        $user_auth = DB::table('users')->where('id','=',Auth::id())->first();

        return view('users/gerants/recapReinsert',[
            "user_auth" => $user_auth,
            "formule" => $formule,
        ]);

    }


    public function reabonnerPutGerant(User $gerant, Request $request){

        $today = date("Y-m-d h:i:s");
        $infos_gerant = DB::table("users")->where("name","=",$gerant->name)->first();
        $fin_souscription = date("Y-m-d",strtotime('+1 month'));

        DB::table('users')->where('id','=', $gerant->id)->update(['id_formule' => $request->id_formule, 'fin_souscription' => $fin_souscription, 'id_etat_user' => $request->id_etat_user, 'created_at' => $today]);

        DB::table('users')->where('id_user_action','=', $infos_gerant->id)->update(['id_formule' => $request->id_formule, 'fin_souscription' => $fin_souscription, 'id_etat_user' => $request->id_etat_user, 'created_at' => $today]);

        return redirect()->route('reabonnerGerants')->with('message',"Félicitation votre abonnement a été renouvélé avec succès!");

    }



}

