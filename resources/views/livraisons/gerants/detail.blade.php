@extends('layouts/auth')
@section('title',"details")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut affichage d'informations livraison-->

<div class="card shadow mt-4">
    <h3 class="card-header" style="color:rgb(14, 14, 170);">DETAILS SUR LA LIVRAISON</h3>
    <div class="card-body">

        <div class="row ">
            <div class="col">
                <p><strong>Destinataire : </strong> Mr/Mlle {{ $livraison->nom_destinataire }}</p>
                <p><strong>Téléphone : </strong>{{ $livraison->tel_destinataire }}</p>
                <p><strong>Commune : </strong>{{ $commune_livraison->nom_commune }}</p>
                <p><strong>Quartier : </strong>{{ $quartier_livraison->nom_quartier }}</p>
            </div>
            <div class="col">
                <p><strong>Adresse : </strong>{{ $adresse_livraison->nom_adresse }}</p>
                <p><strong>Frais de livraison : </strong> <span style="color: red; font-weight: bold;">{{ $prix_livraison->valeur_prix }} Frs</span> </p>
                <p><strong>Date : </strong>{{ $livraison->date_livraison }}</p>
                <p><strong>Heure : </strong>{{ $livraison->heure_livraison }}</p>
            </div>
        </div>

    </div>
</div>

<!--fin affichage d'informations livraison-->

@endsection
