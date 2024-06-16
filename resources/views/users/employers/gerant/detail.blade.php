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
        <h2 style="color:rgb(255, 255, 255);">INFORMATIONS GENERALES SUR L'EMPLOYER</h2>
        <strong style="color:rgb(7, 194, 246);">{{ $employer->name }}</strong>
    </div>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations personnelles</h3>
        <div class="card-body">

            <div class="row">

                <div class="col">
                    <p><strong>Nom : </strong>{{ $employer->name }}</p>
                    <p><strong>Email : </strong>{{ $employer->email }}</p>
                    <p><strong>Téléphone : </strong>{{ $employer->telephone }}</p>
                    <p><strong>Entreprise : </strong>{{ $employer->entreprise }}</p>
                    <p><strong>Lieu d'habitation : </strong>{{ $employer->lieu_habitation }}</p>
                </div>

                <div class="col text-center">

                    <p class="text-primary">Photo de profile</p>

                    @if ($employer->photo)

                    <img src="{{ asset('storage/'.$employer->photo) }}" alt="Photo de profil" style="width: 10rem; height: 15rem; text-align: center; border-radius: 10px;">

                    @else

                    <img src="{{ asset('https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg')}}" alt="" style="width: 10rem; height: 15rem; text-align: center; border-radius: 10px;">

                    @endif

                </div>
            </div>

        </div>
    </div>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations professionnelles</h3>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <p><strong>Poste : </strong>{{ $info_poste->titre_poste }}</p>
                        <p><strong>Date de prise de fonction : </strong>{{ $employer->debut_poste }}</p>
                        <p><strong>Date de fin de fonction : </strong>{{ $employer->fin_poste }}</p>
                        <p><strong>Salaire :</strong> {{ $info_poste->salaire_poste }} frs CFA / Mois</p>
                        <p><strong>Description du poste :</strong></p>
                        <p class="card-text" style="color:rgb(31, 16, 64); background-color:rgb(198, 201, 204); border-radius: 5px; padding:7px;">{!! nl2br(e( $info_poste->desc_poste)) !!}</p>
                    </div>

                    <div class="col" style="background-color:rgb(198, 201, 204); border-radius: 5px;">

                        <div class="row mt-5">
                            <div class="col text-center" style="border-right: 5px solid white;">
                                <h5 style="color:rgb(2, 109, 128);">Tâches</h5>
                                <p>En attente<strong style="color:rgb(243, 5, 5); font-size: 1.5rem;"> {{ $nbr_tache_hold }}</strong></p>
                                <p>Terminée<strong style="color:rgb(243, 5, 5); font-size: 1.5rem;"> {{ $nbr_tache_finish }}</strong></p>
                            </div>

                            @if ($employer->role === "receptionniste")
                            <div class="col text-center" style="border-right: 5px solid white;">
                                <h5 style="color:rgb(2, 109, 128);">Factures délivrées</h5>
                                <p><strong style="color:rgb(243, 5, 5); font-size: 1.5rem;">{{ $nbr_facture_delivres }}</strong></p>
                            </div>
                            <div class="col text-center" style="border-right: 5px solid white;">
                                <h5 style="color:rgb(2, 109, 128);">Vêtements receptionnés</h5>
                                <p><strong style="color:rgb(243, 5, 5); font-size: 1.5rem;">{{ $nbr_vetement_recepts }}</strong></p>
                            </div>
                            <div class="col text-center">
                                <h5 style="color:rgb(2, 109, 128);">Profit réalisé</h5>
                                <p><strong style="color:rgb(243, 5, 5); font-size: 1.5rem;">{{ $profil }} Frs</strong></p>
                            </div>
                            @endif

                        </div>

                    </div>

                </div>

            </div>


        </div>
    </div>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Autres informations</h3>
        <div class="card-body">

            <div class="row">

<!--debut option de modification de l'etat de l'utilisateur-->

                <div class="col">
                    <form class="justify-center" action="{{route('putEtatEmployer',['employer'=>$employer->id])}}" method="POST">
                        @method('put')
                        @csrf
                        <label style="color:rgb(37, 5, 90); font-weight: bold;" class="form-label" for="">Etat</label>
                        <select name="id_etat_user" id="id_etat_user">
                            <option value="{{ $employer->id_etat_user }}">{{ $info_etat_user->nom_etat_user }}</option>
                            @forelse ($other_etat_users as $other_etat_user)
                            <option value="{{ $other_etat_user->id }}"> {{ $other_etat_user->nom_etat_user }} </option>
                            @empty
                                <p style="color:rgb(217, 17, 17);">Désoler! mais c'est le état de la liste</p>
                            @endforelse
                        </select>
                        <button class="btn" type="submit2" style="color: white; background-color: rgb(7, 91, 117);">changer</button>
                    </form>
                </div>

<!--fin option de modification de l'etat de l'utilisateur-->

            </div>

        </div>
    </div>

</div>

<!--fin affichage d'informations gerants-->

@endsection
