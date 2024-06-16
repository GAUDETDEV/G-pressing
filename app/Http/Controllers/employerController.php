<?php

namespace App\Http\Controllers;

use App\Http\Requests\employerModifyRequest;
use App\Http\Requests\employerPostRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class employerController extends Controller
{
    //
    public function listeEmployers(Request $request):View{

        $id_cat_employer = DB::table('categorie_users')->where('nom_cat_user','=', "EMPLOYER")->value("id");
        $employers = DB::table('users')->where("id_user_action","=",Auth::id())->where('id_cat_user','=', $id_cat_employer)->paginate(5);
        $postes = DB::table("postes")->where("id_user_auth","=",Auth::id())->get();

        if($request->filled("search")){

            $employers = DB::table('users')->where("id_user_action","=",Auth::id())->where('id_cat_user','=', $id_cat_employer)->whereAny([

                "name",
                "email",
                "telephone",
                "entreprise",
                "role",

            ],"LIKE","%".$request->search."%")->paginate(5);

        }else{

            $employers = DB::table('users')->where("id_user_action","=",Auth::id())->where('id_cat_user','=', $id_cat_employer)->paginate(5);

        }


        return view('users/employers/gerant/liste',[
            "employers" => $employers,
            "postes" => $postes,
        ]);



    }



    public function modifyEmployer(User $employer):View{

        $poste_employer = DB::table('postes')->where('id','=',$employer->id_poste)->where('id_user_auth','=', Auth::id())->first();
        $other_postes = DB::table('postes')->where('id','!=',$employer->id_poste)->where('id_user_auth','=', Auth::id())->get();

        return view('users/employers/gerant/modify',[
            "employer" => $employer,
            "poste_employer" => $poste_employer,
            "other_postes" => $other_postes,
        ]);

    }


    public function putEmployer(User $employer, employerModifyRequest $request){

        $today = date('Y-m-d h:i:s');

        $photoPath = "";

        if($request->hasFile("photo")){

            $photoPath = $request->file('photo')->store('images', "public");


                $employer->name = $request->name;
                $employer->email = $request->email;
                $employer->telephone = $request->telephone;
                $employer->lieu_habitation = $request->lieu_habitation;
                $employer->adresse = $request->adresse;
                $employer->entreprise = $request->entreprise;
                $employer->debut_poste = $request->debut_poste;
                $employer->fin_poste = $request->fin_poste;
                $employer->photo = $photoPath;

                $employer -> save();

                return redirect()->route('modifyEmployer',["employer"=>$employer->id])->with('message', "Mise à jour réussit!");

        }else{


            $employer->name = $request->name;
            $employer->email = $request->email;
            $employer->telephone = $request->telephone;
            $employer->lieu_habitation = $request->lieu_habitation;
            $employer->adresse = $request->adresse;
            $employer->entreprise = $request->entreprise;
            $employer->debut_poste = $request->debut_poste;
            $employer->fin_poste = $request->fin_poste;

            $employer -> save();

            return redirect()->route('modifyEmployer',["employer"=>$employer->id])->with('message', "Mise à jour réussit!");


        }


    }



    public function putEtatEmployer(User $employer, Request $request){

        $employer->id_etat_user = $request->id_etat_user;

        $employer -> save();

        return redirect()->route('detailEmployer',['employer' => $employer->id])->with('message', "L'état a été modifiée avec succès!");

    }


    public function deleteEmployer(User $employer){

        $employer->delete();

        return redirect()->route('listeEmployers',["employer" => $employer->id])->with('message', "Suppression réussit!");

    }


    public function deleteAllEmployer(){

        DB::table("users")->where("id_user_action","=",Auth::id())->where("role","!=","client")->delete();

        return redirect()->route('listeEmployers')->with('message', "Nettoyage effectue avec succès!");

    }

    public function postEmployer(employerPostRequest $request){

        $infos_gerant = DB::table("users")->where('id',"=",Auth::id())->first();
        $cat_emp = DB::table('categorie_users')->where("nom_cat_user","=","EMPLOYER")->first();
        $etat_emp = DB::table('etat_users')->where("nom_etat_user","=","ACTIF")->first();

        $users = DB::table("users")->where('id_user_action',"=",Auth::id())->get();
        $nbr_users = count($users);
        $nbr = $nbr_users + 1;
        $nbr_user_formule = DB::table('formules')->where("id","=",$infos_gerant->id_formule)->first();

        $role = DB::table("postes")->where("id","=",$request->id_poste)->value("titre_poste");

        $photoPath = "";

        if($request->hasFile('photo')){

            $photoPath = $request->file('photo')->store('images', 'public');

            if($nbr < $nbr_user_formule->nbr_user){

                User::create([

                    'name' => $request->name,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'entreprise' => $infos_gerant->entreprise,
                    'adresse' => $request->adresse,
                    'password' => Hash::make($request->password),
                    'fin_souscription' => $infos_gerant->fin_souscription,
                    "id_cat_user" => $cat_emp->id,
                    "id_etat_user" => $etat_emp->id,
                    "id_formule" => $infos_gerant->id_formule,
                    'lieu_habitation' => $request->lieu_habitation,
                    'debut_poste' => $request->debut_poste,
                    'fin_poste' => $request->fin_poste,
                    'id_poste' => $request->id_poste,
                    'id_user_action' => $infos_gerant->id,
                    'role' => $role,
                    'photo' => $photoPath,

                ]);

                return redirect()->route('listeEmployers')->with('message', "Employer enregistré avec succes!");

            }else{

                return redirect()->route('listeEmployers')->with('message', "Désoler! Vous ne pouvez pas enregister plus de ".$nbr_user_formule->nbr_user." utilisateur(s)");

            }


        }else{


            if($nbr < $nbr_user_formule->nbr_user){

                User::create([

                    'name' => $request->name,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'entreprise' => $infos_gerant->entreprise,
                    'adresse' => $request->adresse,
                    'password' => Hash::make($request->password),
                    'fin_souscription' => $infos_gerant->fin_souscription,
                    "id_cat_user" => $cat_emp->id,
                    "id_etat_user" => $etat_emp->id,
                    "id_formule" => $infos_gerant->id_formule,
                    'lieu_habitation' => $request->lieu_habitation,
                    'debut_poste' => $request->debut_poste,
                    'fin_poste' => $request->fin_poste,
                    'id_poste' => $request->id_poste,
                    'id_user_action' => $infos_gerant->id,
                    'role' => $role,
                    'photo' => $photoPath,

                ]);

                return redirect()->route('listeEmployers')->with('message', "Employer enregistré avec succes!");

            }else{

                return redirect()->route('listeEmployers')->with('message', "Désoler! Vous ne pouvez pas enregister plus de ".$nbr_user_formule->nbr_user." utilisateur(s)");

            }



        }



    }



    public function detailEmployer(User $employer):View{

        $info_etat_user = DB::table('etat_users')->where('id','=',$employer->id_etat_user)->first();
        $info_cat_user = DB::table('categorie_users')->where('id','=',$employer->id_cat_user)->first();
        $other_cat_users = DB::table('categorie_users')->where('id','!=',$employer->id_cat_user)->get();
        $other_etat_users = DB::table('etat_users')->where('id','!=',$employer->id_etat_user)->get();
        $info_poste = DB::table("postes")->where("id","=",$employer->id_poste)->first();

        //statistique employers
        $tache_hold = DB::table("taches")->where("type_tache","=","reception")->where("etat_tache","=","En attente")->where("id_executant","=",$employer->id)->get();
        $tache_finish = DB::table("taches")->where("type_tache","=","reception")->where("etat_tache","=","Terminée")->where("id_executant","=",$employer->id)->get();
        $nbr_tache_hold = count($tache_hold);
        $nbr_tache_finish = count($tache_finish);

        $facture_delivres = DB::table("factures")->where("etat_traitement","!=","")->where("id_editor","=",$employer->id)->get();
        $nbr_facture_delivres = count($facture_delivres);

        $vetement_recepts = DB::table("recepts")->where("id_receptionist","=",$employer->id)->get();
        $nbr_vetement_recepts = count($vetement_recepts);

        $profil = DB::table("factures")->where("etat_traitement","!=","")->where("id_editor","=",$employer->id)->sum("montant");



        return view('users/employers/gerant/detail',[
            "employer" => $employer,
            "info_etat_user" => $info_etat_user,
            "info_cat_user" => $info_cat_user,
            "other_cat_users" => $other_cat_users,
            "other_etat_users" => $other_etat_users,
            "info_poste" => $info_poste,
            "nbr_tache_hold" => $nbr_tache_hold,
            "nbr_tache_finish" => $nbr_tache_finish,
            "nbr_facture_delivres" => $nbr_facture_delivres,
            "nbr_vetement_recepts" => $nbr_vetement_recepts,
            "profil" => $profil,
        ]);

    }




}
