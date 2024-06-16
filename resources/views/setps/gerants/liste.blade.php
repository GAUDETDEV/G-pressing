@extends('layouts/auth')
@section('title',"liste vêtements")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<!-- debut barre de recherche -->

<div class="container mt-3">
    <form action="" method="get" action="{{route('listeSpet')}}" style="display: flex;">

        @csrf
        @method('get')

        <input class="form-control no-border-input" type="text" name="search" placeholder="Recherche...">
        <button type="submit" class="btn no-border-button" style="background-color:rgb(8, 134, 173); color: white;">Rechercher</button>

    </form>
</div>

<!-- fin barre de recherche -->

<div class="mt-5">

    <table class="table table-striped shadow">
        <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des factures en cours de traitement</strong></caption>
        <thead>
            <tr>
                <th class="text-primary">N°</th>
                <th class="text-primary">Titulaire</th>
                <th class="text-primary">Téléphone</th>
                <th class="text-primary">Créer le</th>
                <th class="text-primary">Mis à jour le</th>
                <th class="text-primary">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($liste_factures as $liste_facture)

            @if ($liste_facture->etat_traitement)

            <tr>
                <td>{{ $liste_facture->id}}</td>
                <td>{{ $liste_facture->nom_titulaire}}</td>
                <td>{{ $liste_facture->tel_titulaire}}</td>
                <td>{{ $liste_facture->created_at}}</td>
                <td>{{ $liste_facture->updated_at}}</td>
                <td>

                    <a href="{{route('voirSetp',['liste_facture' => $liste_facture ->id])}}" type="button" class="btn" title="Editer" style='color: rgb(255, 255, 255); background-color:rgb(4, 96, 216);'><i class="fa-solid fa-stairs"></i> Traitement</a><!--boutton de vue-->

                    @if (Auth::user()->role == "gerant")
                    <a href="" type="button" class="btn" title="Modifier" style='color: rgb(255, 255, 255); background-color:rgb(14, 103, 76);'><i class="fa-solid fa-pen-nib"></i></a><!--boutton modifier-->
                    <a href="" type="button" class="btn" title="Détails" style='color: rgb(255, 255, 255); background-color:rgb(28, 8, 79);'><i class="fa-solid fa-eye"></i></a><!--boutton détails-->
                    <a href="" type="button" class="btn" title="Supprimer" style='color: rgb(255, 255, 255); background-color:rgb(62, 4, 7);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
                    @endif

                </td>
            </tr>

            @endif

            @empty
            <tr>
                <td colspan="8">
                    <p class="text-center"><strong class="text-danger"> La liste des factures en cours de traitement est vite! <strong></p>
                </td>
            </tr>
            @endforelse

        </tbody>
        <tfoot>

        </tfoot>
    </table>
    <p>
        <a type="button" class="btn" href="" style='color: rgb(255, 255, 255); background-color: rgb(5, 5, 5); margin: 5px;'>Imprimer</a>
    </p>

</div>

@endsection
