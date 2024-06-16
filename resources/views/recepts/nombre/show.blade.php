@extends('layouts/auth')
@section('title',"liste vêtements")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<h4 class="card-title  mt-5" style="border-left: 20px solid rgb(223, 86, 169); color: rgb(251, 251, 251); background-color: rgb(123, 7, 80); padding: 7px;">Liste des vêtements receptionnés leur nombre</h4>

<!-- debut barre de recherche -->

<div class="container mt-3">

    <form action="" method="get" action="{{route('listVetReceptNombre',["depot_nombre" => $depot_nombre->id])}}" style="display: flex;">

        @csrf
        @method('get')

        <input class="form-control no-border-input" style="margin-right: 5px; font-size: 15px;" type="text" name="search" placeholder="Recherche un vêtement...">
        <button type="submit" class="btn no-border-button" style="background-color:rgb(150, 8, 91); color: white;">Rechercher</button>

    </form>
</div>

<!-- fin barre de recherche -->

<table class="table table-striped mt-3 shadow">
    <thead>
        <tr>
            <th style="color: rgb(117, 6, 61);">N° facture</th>
            <th style="color: rgb(117, 6, 61);">type vet</th>
            <th style="color: rgb(117, 6, 61);">couleur(s)</th>
            <th style="color: rgb(117, 6, 61);">Caractéristique(s)</th>
            <th style="color: rgb(117, 6, 61);">Catégorie(s)</th>
            <th style="color: rgb(117, 6, 61);">Qualité(s)</th>
            <th style="color: rgb(117, 6, 61);">Qte</th>
            <th style="color: rgb(117, 6, 61);">Prix unit</th>
            <th style="color: rgb(117, 6, 61);">Prix</th>
            <th style="color: rgb(117, 6, 61);">Receptionner le</th>
            <th style="color: rgb(117, 6, 61);">Modifier le</th>

        </tr>
    </thead>
    <tbody>
        @forelse ($liste_vet_nombres as $liste_vet_nombre)
        <tr>
            <td>{{ $liste_vet_nombre->id_facture }}</td>
            <td>{{ $liste_vet_nombre->nom_vet }}</td>
            <td>{{ $liste_vet_nombre->color_vet }}</td>
            <td>{{ $liste_vet_nombre->caract_vet }}</td>
            <td>{{ $liste_vet_nombre->cat_vet }}</td>
            <td>{{ $liste_vet_nombre->quality_vet }}</td>
            <td>{{ $liste_vet_nombre->qte_vet }}</td>
            <td>{{ $liste_vet_nombre->prix_unitaire }} Francs CFA</td>
            <td>{{ $liste_vet_nombre->prix }} Francs CFA</td>
            <td>{{ $liste_vet_nombre->created_at }}</td>
            <td>{{ $liste_vet_nombre->updated_at }}</td>

        </tr>

    </tbody>
    <tfoot>

    </tfoot>

    @empty

        <p class="text-center"><strong class="text-danger"> La liste des vêtements est vite! <strong></p>

    @endforelse

    <tr>
        <td colspan="6" style="color: rgb(126, 0, 103); font-weight: bold;"> Total </td>
        <td style="color: rgb(191, 13, 22); font-weight: bold;"> {{$total_qte}} </td>
        <td style="color: rgb(191, 13, 22); font-weight: bold;"> {{$total_prix_unit}} Frs CFA</td>
        <td style="color: rgb(191, 13, 22); font-weight: bold;"> {{$total_prix}} Frs CFA</td>
        <td colspan="2">
            @if ($count !== 0 )
            <a type="button" class="btn" href="{{route('downloadVetNombre',["depot_nombre" => $depot_nombre->id])}}" style='color: rgb(255, 255, 255); background-color: rgb(4, 0, 0); margin: 5px;'><i class="fa-solid fa-download"></i> Télécharger</a>
            @endif
        </td>
    </tr>

</table>

<div class="container mt-3">
    {{$liste_vet_nombres->links()}}
</div>

@endsection
