@extends('layouts/auth')
@section('title',"liste vêtements")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<h4 class="card-title  mt-5" style="border-left: 20px solid rgb(97, 95, 96); color: rgb(251, 251, 251); background-color: rgb(0, 0, 0); padding: 7px;">Liste des vêtements receptionnés selon leur poids</h4>

<!-- debut barre de recherche -->

<div class="container mt-3">

    <form action="" method="get" action="{{route('listVetReceptPoids',["depot_poid" => $depot_poid->id])}}" style="display: flex;">

        @csrf
        @method('get')

        <input class="form-control no-border-input" style="margin-right: 5px; font-size: 15px;" type="text" name="search" placeholder="Recherche un vêtement...">
        <button type="submit" class="btn no-border-button" style="background-color:rgb(68, 70, 71); color: white;">Rechercher</button>

    </form>
</div>

<!-- fin barre de recherche -->

<table class="table table-striped mt-3 shadow">
    <thead>
        <tr>
            <th style="color: rgb(27, 27, 27);">N° facture</th>
            <th style="color: rgb(27, 27, 27);">type vet</th>
            <th style="color: rgb(27, 27, 27);">couleur(s)</th>
            <th style="color: rgb(27, 27, 27);">Caractéristique(s)</th>
            <th style="color: rgb(27, 27, 27);">Catégorie(s)</th>
            <th style="color: rgb(27, 27, 27);">Qualité(s)</th>
            <th style="color: rgb(27, 27, 27);">Qte</th>
            <th style="color: rgb(27, 27, 27);">Prix unit</th>
            <th style="color: rgb(27, 27, 27);">Prix</th>
            <th style="color: rgb(27, 27, 27);">Receptionner le</th>
            <th style="color: rgb(27, 27, 27);">Modifier le</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($liste_vet_poids as $liste_vet_poid)
        <tr>
            <td>{{ $liste_vet_poid->id_facture }}</td>
            <td>{{ $liste_vet_poid->nom_vet }}</td>
            <td>{{ $liste_vet_poid->color_vet }}</td>
            <td>{{ $liste_vet_poid->caract_vet }}</td>
            <td>{{ $liste_vet_poid->cat_vet }}</td>
            <td>{{ $liste_vet_poid->quality_vet }}</td>
            <td>{{ $liste_vet_poid->qte_vet }}</td>
            <td>{{ $liste_vet_poid->prix_unitaire }} Francs CFA</td>
            <td>{{ $liste_vet_poid->prix }} Francs CFA</td>
            <td>{{ $liste_vet_poid->created_at }}</td>
            <td>{{ $liste_vet_poid->updated_at }}</td>
        </tr>

    </tbody>
    <tfoot>

    </tfoot>

    @empty

        <p class="text-center"><strong class="text-danger"> La liste des vêtements est vite! <strong></p>

    @endforelse

    <tr>
        <td colspan="6" style="color: rgb(0, 0, 0); font-weight: bold;"> Total </td>
        <td style="color: rgb(191, 13, 22); font-weight: bold;"> {{$total_qte}} </td>
        <td style="color: rgb(191, 13, 22); font-weight: bold;"> {{$total_prix_unit}} Frs CFA</td>
        <td style="color: rgb(191, 13, 22); font-weight: bold;"> {{$total_prix}} Frs CFA</td>
        <td colspan="2">
            @if ($count !== 0 )
            <a type="button" class="btn" href="{{route('downloadVetPoids',["depot_poid" => $depot_poid->id])}}" style='color: rgb(255, 255, 255); background-color: rgb(4, 0, 0); margin: 5px;'><i class="fa-solid fa-download"></i> Télécharger</a>
            @endif
        </td>
    </tr>

</table>

<div class="container mt-3">
    {{$liste_vet_poids->links()}}
</div>

@endsection
