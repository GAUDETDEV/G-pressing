@extends('layouts/auth')
@section('title',"detail")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut affichage d'informations client-->

<div class="container mt-3">

    <div class="text-center rounded-2 shadow" style="color:rgb(246, 246, 246); background-color:rgb(9, 9, 75); padding: 5px;">
        <h2 style="color:rgb(255, 255, 255);">INFORMATIONS GENERALES SUR LE CLIENT</h2>
        <strong style="color:rgb(7, 194, 246);">{{ $client->civilite}} {{ $client->name }}</strong>
    </div>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations personnelles</h3>
        <div class="card-body">

            <div class="row">

                <div class="col">
                    <p><strong>Nom : </strong>{{ $client->name }}</p>
                    <p><strong>Email : </strong>{{ $client->email }}</p>
                    <p><strong>Téléphone : </strong>{{ $client->telephone }}</p>
                    <p><strong>Entreprise : </strong>{{ $client->entreprise }}</p>
                    <p><strong>Lieu d'habitation : </strong>{{ $client->lieu_habitation }}</p>
                    <p><strong>Adresse : </strong>{{ $client->adresse }}</p>
                </div>
                <div class="col text-center">

                    <p style="color:rgb(4, 96, 216); font-weight: bold;" >Photo de profile</p>

                    @if ($client->photo)

                    <img src="{{ asset('storage/'.$client->photo) }}" alt="Photo de profil" style="width: 15rem; height: 15rem; text-align: center; border-radius: 10px;">

                    @else

                    <img src="{{ asset('https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg')}}" alt="" style="width: 15rem; height: 15rem; text-align: center; border-radius: 10px;">

                    @endif

                </div>

            </div>

        </div>
    </div>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Autres informations</h3>
        <div class="card-body">
            <p><strong>Date de souscription : </strong>{{ $client->created_at }}</p>
            <p><strong>Dernière mise à jour : </strong>{{ $client->updated_at }}</p>

<!--debut option de modification de l'etat de l'utilisateur-->

            <div class="col">
                <form class="justify-center" action="{{route('receptionistPutEtatClient',['client' => $client->id])}}" method="POST">
                    @method('put')
                    @csrf
                    <label style="color:rgb(37, 5, 90); font-weight: bold;" class="form-label" for="">Etat</label>
                    <select name="id_etat_user" id="id_etat_user">
                        <option value="{{ $client->id_etat_user }}">{{ $info_etat_client->nom_etat_user }}</option>
                        @forelse ($other_etat_clients as $other_etat_client)
                        <option value="{{ $other_etat_client->id }}"> {{ $other_etat_client->nom_etat_user }} </option>
                        @empty
                            <p style="color:rgb(217, 17, 17);">Désoler! mais c'est le état de la liste</p>
                        @endforelse
                    </select>
                    <button class="btn" type="submit2" style="color: white; background-color: rgb(11, 198, 255);">changer</button>
                </form>
            </div>

<!--fin option de modification de l'etat de l'utilisateur-->

        </div>
    </div>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations sur l'abonnement</h3>
        <div class="card-body">

            @if ($client->id_pack)
                <p>En cours...</p>
            @else
                <p>Non abonner...</p>
            @endif

        </div>
    </div>

</div>

<!--fin affichage d'informations client-->

@endsection
