@extends('layouts/auth')
@section('title',"liste vêtements")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<h4 class="card-title  mt-5" style="border-left: 20px solid rgb(62, 143, 176); color: rgb(251, 251, 251); background-color: rgb(7, 13, 120); padding: 7px;">Liste des vêtements receptionnés de façon classique</h4>

<!-- debut barre de recherche -->

<div class="container mt-3">

    <form action="" method="get" action="{{route('listVetReceptClassic')}}" style="display: flex;">

        @csrf
        @method('get')

        <input class="form-control no-border-input" style="margin-right: 5px; font-size: 15px;" type="text" name="search" placeholder="Recherche un vêtement...">
        <button type="submit" class="btn no-border-button" style="background-color:rgb(2, 118, 153); color: white;">Rechercher</button>

    </form>
</div>

<!-- fin barre de recherche -->

<table class="table table-striped mt-3 shadow">
    <thead>
        <tr>
            <th>N° facture</th>
            <th>type vet</th>
            <th>couleur(s)</th>
            <th>Caractéristique(s)</th>
            <th>Catégorie(s)</th>
            <th>Qualité(s)</th>
            <th>Qte</th>
            <th>Prix unit</th>
            <th>Prix</th>
            <th>Receptionner le</th>
            <th>Modifier le</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($liste_vet_classics as $liste_vet_classic)
        <tr>
            <td>{{ $liste_vet_classic->id_facture }}</td>
            <td>{{ $liste_vet_classic->nom_vet }}</td>
            <td>{{ $liste_vet_classic->color_vet }}</td>
            <td>{{ $liste_vet_classic->caract_vet }}</td>
            <td>{{ $liste_vet_classic->cat_vet }}</td>
            <td>{{ $liste_vet_classic->quality_vet }}</td>
            <td>{{ $liste_vet_classic->qte_vet }}</td>
            <td>{{ $liste_vet_classic->prix_unitaire }} Francs CFA</td>
            <td>{{ $liste_vet_classic->prix }} Francs CFA</td>
            <td>{{ $liste_vet_classic->created_at }} </td>
            <td>{{ $liste_vet_classic->updated_at }} </td>
        </tr>

    </tbody>
    <tfoot>

    </tfoot>

    @empty

        <p class="text-center"><strong class="text-danger"> La liste des vêtements est vite! <strong></p>

    @endforelse

    <tr>
        <td colspan="6" style="color: rgb(39, 16, 240); font-weight: bold;"> Total </td>
        <td style="color: rgb(191, 13, 22); font-weight: bold;"> {{$total_qte}} </td>
        <td style="color: rgb(191, 13, 22); font-weight: bold;"> {{$total_prix_unit}} Frs CFA</td>
        <td style="color: rgb(191, 13, 22); font-weight: bold;"> {{$total_prix}} Frs CFA</td>
        <td colspan="2">
            @if ($count !== 0 )
            <a type="button" class="btn" href="{{route('downloadVetClassic')}}" style='color: rgb(255, 255, 255); background-color: rgb(4, 0, 0); margin: 5px;'><i class="fa-solid fa-download"></i> Télécharger</a>
            @endif
        </td>
    </tr>

</table>

<div class="container mt-3">
    {{$liste_vet_classics->links()}}
</div>

@endsection
