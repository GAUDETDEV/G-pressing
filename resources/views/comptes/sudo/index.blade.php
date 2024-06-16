@extends('layouts/auth')
@section('title',"detail compte")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut affichage du details tache-->

<div class="container mt-3">

    <div class="text-center rounded-2 shadow" style="color:rgb(246, 246, 246); background-color:rgb(9, 9, 75); padding: 5px;">
        <h2 style="color:rgb(255, 255, 255);">LES DETAILS SUR MON COMPTE</h2>
    </div>


    <a class="btn mt-4" href="{{route('modifyCompteSudo',['sudo' => $info_user->id])}}" style="color: white; background-color:rgb(0, 127, 53); padding: 9px; border-radius: 5px;"><i class="fa-solid fa-pen-nib"></i> Mettre à jour</a>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations personnelles</h3>

        <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card-body">
                    <p><strong>Nom : </strong>{{ $info_user->name }}</p>
                    <p><strong>Email : </strong>{{ $info_user->email }}</p>
                    <p><strong>Téléphone : </strong>{{ $info_user->telephone }}</p>
                    <p><strong>Lieu d'habitation : </strong>{{ $info_user->lieu_habitation }}</p>
                    <p><strong>Adresse : </strong>{{ $info_user->adresse }}</p>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card-body text-center">

                    @if (Auth::user()->photo)

                    <img src="{{ asset('storage/'.Auth::user()->photo) }}" alt="Photo de profil" style="width: 7rem; height: 10rem; text-align: center; border-radius: 10px;">

                    @else

                    <img src="{{ asset('https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg')}}" alt="" style="width: 7rem; height: 10rem; text-align: center; border-radius: 10px;">

                    @endif

                    <p style="color:rgb(14, 14, 170);"> Photo de profile </p>

                </div>
            </div>

        </div>

    </div>


    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Autres informations</h3>

        <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card-body">
                    <p><strong>Role : </strong>{{ $info_user->role }}</p>
                    <p><strong>Entreprise : </strong>{{ $info_user->entreprise }}</p>
                    <p><strong>Date de souscription : </strong>{{ $info_user->created_at }}</p>
                    <p><strong>Date de fin de souscription : </strong><strong style="color: rgb(224, 1, 1); font-size: 20px;">{{ $info_user->fin_souscription }}</strong></p>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card-body">
                    <p><strong>Etat du compte : </strong>

                        @if ($infos_etat->nom_etat_user == "ACTIF")
                            <span style="color: white; background-color: rgb(0, 203, 41); padding: 2px; border-radius: 2px;">{{ $infos_etat->nom_etat_user }}</span>
                        @else
                            <span style="color: white; background-color: rgb(224, 1, 1); padding: 2px; border-radius: 2px;">{{ $infos_etat->nom_etat_user }}</span>
                        @endif

                    </p>
                    <p><strong>Formule : </strong> <span style="color: rgb(4, 132, 160); font-size: 20px; font-style: italic;">{{ $infos_formule->nom_formule }} </span> </p>
                    <p><strong>Nombre de gérants : </strong> <strong style="color: rgb(224, 1, 1); font-size: 20px;">{{ $nbr_gerants }}</strong> </p>
                    <p><strong>Nombre d'utilisateurs total : </strong> <strong style="color: rgb(224, 1, 1); font-size: 20px;">{{ $nbr_users }}</strong> </p>
                </div>
            </div>

        </div>

    </div>



</div>

<!--fin affichage du details tache-->

@endsection
