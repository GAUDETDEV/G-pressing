@extends('layouts/auth')
@section('title',"vêtements receptionnés")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!-- debut barre de recherche -->

<div class="container mt-3">
    <form action="" method="get" action="{{route('indexMyRecept')}}" style="display: flex;">

        @csrf
        @method('get')
        <i class="fa-solid fa-filter fa-2x" style="color: rgb(15, 138, 163); padding-right: 5px;"></i>
        <input class="form-control no-border-input" type="text" name="search" placeholder="Recherche...">
        <button type="submit" class="btn no-border-button" style="background-color:rgb(8, 134, 173); color: white;">Rechercher</button>

    </form>
</div>

<!-- fin barre de recherche -->

<div class="mt-5">
    <table class="table table-striped shadow">
        <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste de mes vêtements deposés</strong></caption>
        <thead>
            <tr>
                <th class="text-primary">Nom vet</th>
                <th class="text-primary">Couleur</th>
                <th class="text-primary">Specificat</th>
                <th class="text-primary">Catg</th>
                <th class="text-primary">Qualité(s)</th>
                <th class="text-primary">Qte</th>
                <th class="text-primary">Prix unit</th>
                <th class="text-primary">Prix total</th>
                <th class="text-primary">Date de reception</th>
                <th class="text-primary">Dernière mise à jour</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($liste_recepts as $liste_recept)
            <tr>
                <td>{{ $liste_recept->nom_vet}}</td>
                <td>{{ $liste_recept->color_vet}}</td>
                <td>{{ $liste_recept->caract_vet}}</td>
                <td>{{ $liste_recept->cat_vet}}</td>
                <td>{{ $liste_recept->quality_vet}}</td>
                <td>{{ $liste_recept->qte_vet}}</td>
                <td>{{ $liste_recept->prix_unitaire}} Frs</td>
                <td>{{ $liste_recept->prix}} Frs</td>
                <td>{{ $liste_recept->created_at}}</td>
                <td>{{ $liste_recept->updated_at}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="10">
                    <p class="text-center"><strong class="text-danger"> La liste des vêtements réceptionnés est vite! <strong></p>
                </td>
            </tr>
            @endforelse

            <tr>
                <td colspan="5"><strong class="text-danger">Total</strong></td>
                <td><strong class="text-danger">{{$total_qte}}</strong></td>
                <td><strong class="text-danger">{{$total_prix_unit}} Frs</strong></td>
                <td><strong class="text-danger">{{$total_prix}} Frs</strong></td>
                <td colspan="2">
                    @if ($count!==0)
                    <a type="button" class="btn" href="{{route('downloadAllMyVetRecept')}}" style='color: rgb(255, 255, 255); background-color: rgb(5, 5, 5); margin: 5px;'><i class="fa-solid fa-download"></i> Télécharger</a>
                    @endif
                </td>
            </tr>

        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>

<div class="container mt-3">
    {{$liste_recepts->links()}}
</div>

@endsection
