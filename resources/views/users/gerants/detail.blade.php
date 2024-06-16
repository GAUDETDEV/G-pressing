@extends('layouts/auth')
@section('title',"detail")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut affichage d'informations gerants-->

<div class="container mt-3">

    <div class="text-center rounded-2 shadow" style="color:rgb(246, 246, 246); background-color:rgb(9, 9, 75); padding: 5px;">
        <h2 style="color:rgb(255, 255, 255);">INFORMATIONS GENERALES SUR LE GERANT</h2>
        <strong style="color:rgb(7, 194, 246);">

            @if ($gerant->civilite == "Mr")
                Mr {{ $gerant->name }}
            @elseif($gerant->civilite == "Mme")
                Mme {{ $gerant->name }}
            @elseif($gerant->civilite == "Mlle")
                Mlle {{ $gerant->name }}
            @endif

        </strong>
    </div>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations personnelles</h3>
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <p><strong>Nom : </strong>{{ $gerant->name }}</p>
                    <p><strong>Email : </strong>{{ $gerant->email }}</p>
                    <p><strong>Téléphone : </strong>{{ $gerant->telephone }}</p>
                    <p><strong>Entreprise : </strong>{{ $gerant->entreprise }}</p>
                    <p><strong>Lieu d'habitation : </strong>{{ $gerant->lieu_habitation }}</p>
                    <p><strong>Adresse : </strong>{{ $gerant->adresse }}</p>
                </div>
                <div class="col text-center">

                    @if ($gerant->photo)

                    <img src="{{ asset('storage/'.$gerant->photo) }}" alt="Photo de profil" style="width: 15rem; height: 15rem; text-align: center; border-radius: 10px;">

                    @else

                    <img src="{{ asset('https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg')}}" alt="" style="width: 15rem; height: 15rem; text-align: center; border-radius: 10px;">

                    @endif

                    <p class="text-primary">Photo actuelle de profile</p>

                </div>
            </div>


        </div>
    </div>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations sur l'abonnement</h3>
        <div class="card-body">

            <div class="row">

                <div class="col">
                    <p><strong>Type de formule : </strong> <strong style="color:rgb(0, 122, 179);">{{ $info_formule->nom_formule }}</strong></p>
                    <p><strong>Prix : </strong> <strong style="color:rgb(217, 17, 17);">{{ $info_formule->prix_formule }} Frs</strong> </p>
                    <p><strong>Nombre utilisateurs : </strong>{{ $info_formule->nbr_user }}</p>
                    <p><strong>Nombre d'essai : </strong>{{ $info_formule->nbr_essai }}</p>
                    <p><strong>La durée : </strong>{{ $info_formule->periode }} Jour(s)</p>
                    <p><strong>Les fonctionnalités proposées :</strong></p>
                    <p class="card-text" style="color:rgb(182, 235, 255); background-color:rgb(3, 119, 123); border-radius: 5px; padding:7px; width: 100%;">{!! nl2br(e( $info_formule->fonctionnalite)) !!}</p>

                </div>

                <div class="col">

                    <p><strong>Date de souscription : </strong>{{ $gerant->created_at }}</p>
                    <p><strong>Date de fin de souscription : </strong><strong style="color:rgb(217, 17, 17);">{{ $gerant->fin_souscription }}</strong></p>

                    <div class="row">
                        <div class="col text-center" style="color:rgb(182, 235, 255); background-color:rgb(3, 119, 123); border-radius: 5px; padding:7px; width: 100%;">
                            <p style="font-size: 1.7em;">Nombre d'utilisateurs</p>
                            <strong style="font-size: 3em;">{{ $total_user }}</strong>
                        </div>
                    </div>

                </div>

            </div>



        </div>

    </div>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations sur l'état de l'utilisateur</h3>
        <div class="card-body">

            <div class="row">

                <div class="col">
                    <form class="justify-center" action="{{route('putCatGerant',['gerant'=>$gerant->id])}}" method="POST">
                        @method('put')
                        @csrf
                        <select name="id_cat_user" id="id_cat_user">
                            <option value="{{ $gerant->id_cat_user }}">{{ $info_cat_user->nom_cat_user }}</option>
                            @forelse ($other_cat_users as $other_cat_user)
                            <option value="{{ $other_cat_user->id }}"> {{ $other_cat_user->nom_cat_user }} </option>
                            @empty
                                <p style="color:rgb(217, 17, 17);">Désoler! mais c'est la seule catégorie de la liste</p>
                            @endforelse
                        </select>
                        <button class="btn" type="submit1" style="color: white; background-color: rgb(0, 102, 133);">changer</button>
                    </form>
                </div>

<!--debut option de modification de l'etat de l'utilisateur-->

                <div class="col">
                    <form class="justify-center" action="{{route('putEtatGerant',['gerant'=>$gerant->id])}}" method="POST">
                        @method('put')
                        @csrf
                        <select name="id_etat_user" id="id_etat_user">
                            <option value="{{ $gerant->id_etat_user }}">{{ $info_etat_user->nom_etat_user }}</option>
                            @forelse ($other_etat_users as $other_etat_user)
                            <option value="{{ $other_etat_user->id }}"> {{ $other_etat_user->nom_etat_user }} </option>
                            @empty
                                <p style="color:rgb(217, 17, 17);">Désoler! mais c'est le état de la liste</p>
                            @endforelse
                        </select>
                        <button class="btn" type="submit2" style="color: white; background-color: rgb(0, 102, 133);">changer</button>
                    </form>
                </div>

<!--fin option de modification de l'etat de l'utilisateur-->

            </div>

        </div>
    </div>

</div>

<!--fin affichage d'informations gerants-->

@endsection
