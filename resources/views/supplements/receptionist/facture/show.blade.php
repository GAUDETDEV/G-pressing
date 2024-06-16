@extends('layouts/auth')
@section('title',"liste vêtements")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<h4 class="card-title  mt-5" style="border-left: 20px solid rgb(62, 143, 176); color: rgb(251, 251, 251); background-color: rgb(7, 13, 120); padding: 7px;">Liste des vêtements receptionnés</h4>

<!-- debut barre de recherche -->

<div class="container mt-3">

    <form method="get" action="{{route('receptionistlistVetReceptSupplement',['service' => $service->id])}}" style="display: flex;">

        @csrf
        @method('get')

        <input class="form-control no-border-input" style="margin-right: 5px; font-size: 15px;" type="text" name="search" placeholder="Recherche un vêtement...">
        <button type="submit" class="btn no-border-button" style="background-color:rgb(2, 118, 153); color: white;">Rechercher</button>

    </form>
</div>

<!-- fin barre de recherche -->

<div class="mt-3">

    <p><strong style="color: rgb(255, 255, 255); background-color: rgb(191, 13, 22); border-radius: 5px; padding: 3px; margin: 3px;"> Type de service </strong><small style="font-weight: bold;">{{ $service->type_service}}</small></p>

</div>

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
        @forelse ($liste_vet_supplements as $liste_vet_supplement)
        <tr>
            <td>{{ $liste_vet_supplement->id_facture }}</td>
            <td>{{ $liste_vet_supplement->nom_vet }}</td>
            <td>{{ $liste_vet_supplement->color_vet }}</td>
            <td>{{ $liste_vet_supplement->caract_vet }}</td>
            <td>{{ $liste_vet_supplement->cat_vet }}</td>
            <td>{{ $liste_vet_supplement->quality_vet }}</td>
            <td>{{ $liste_vet_supplement->qte_vet }}</td>
            <td>{{ $liste_vet_supplement->prix_unitaire }} Francs CFA</td>
            <td>{{ $liste_vet_supplement->prix }} Francs CFA</td>
            <td>{{ $liste_vet_supplement->created_at }} </td>
            <td>{{ $liste_vet_supplement->updated_at }} </td>
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
            <a type="button" class="btn" href="{{route('receptionistDownloadVetSupplement',['service' => $service->id])}}" style='color: rgb(255, 255, 255); background-color: rgb(4, 0, 0); margin: 5px;'><i class="fa-solid fa-download"></i> Télécharger</a>
            @endif
        </td>
    </tr>

</table>

<div class="container mt-3">
    {{$liste_vet_supplements->links()}}
</div>

@endsection
