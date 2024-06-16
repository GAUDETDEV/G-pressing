@extends('layouts/auth')
@section('title',"Liste des factures")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>


<!-- debut barre de recherche -->

<div class="container mt-3">
    <form action="" method="get" action="{{route('listeFactureLivraison')}}" style="display: flex;">

        @csrf
        @method('get')
        <input class="form-control no-border-input" type="text" name="search" placeholder="Recherche...">
        <button type="submit" class="btn no-border-button" style="background-color:rgb(8, 134, 173); color: white;">Rechercher</button>

    </form>
</div>

<!-- fin barre de recherche -->

<div class="mt-5">
    <table class="table table-striped shadow">
        <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des factures en attente de livraison</strong></caption>
        <thead>
            <tr>
                <th class="text-primary">N°</th>
                <th class="text-primary">Titulaire</th>
                <th class="text-primary">Téléphone</th>
                <th class="text-primary">Etape</th>
                <th class="text-primary">Créer le</th>
                <th class="text-primary">Retrait le</th>
                <th class="text-primary">Mis à jour le</th>
                <th class="text-primary">Actions</th>
            </tr>
        </thead>
        <tbody>


            @forelse ($facture_livraisons as $facture_livraison)
            <tr>
                <td>{{ $facture_livraison->id}}</td>
                <td>{{ $facture_livraison->nom_titulaire}}</td>
                <td>{{ $facture_livraison->tel_titulaire}}</td>
                <td>{{ $facture_livraison->etat_traitement}}</td>
                <td>{{ $facture_livraison->created_at}}</td>
                <td>{{ $facture_livraison->date_retrait}}</td>
                <td>{{ $facture_livraison->updated_at}}</td>
                <td>
                    <a href="{{route('planningLivraison',["facture_livraison" => $facture_livraison->id])}}" type="button" class="btn" title="Editer" style='color: rgb(255, 255, 255); background-color:rgb(4, 96, 216);'><i class="fa-solid fa-pen-to-square"></i></a><!--boutton éditer-->
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <p class="text-center"><strong class="text-danger"> La liste des factures est vite! <strong></p>
                </td>
            </tr>
            @endforelse


            @forelse ($facture_supplements as $facture_supplement)
            <tr>
                <td>{{ $facture_supplement->id}}</td>
                <td>{{ $facture_supplement->nom_titulaire}}</td>
                <td>{{ $facture_supplement->tel_titulaire}}</td>
                <td>{{ $facture_supplement->etat_traitement}}</td>
                <td>{{ $facture_supplement->created_at}}</td>
                <td>{{ $facture_supplement->date_retrait}}</td>
                <td>{{ $facture_supplement->updated_at}}</td>
                <td>
                    <a href="{{route('planningLivraison',["facture_livraison" => $facture_supplement->id])}}" type="button" class="btn" title="Editer" style='color: rgb(255, 255, 255); background-color:rgb(4, 96, 216);'><i class="fa-solid fa-pen-to-square"></i></a><!--boutton éditer-->
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <p class="text-center"><strong class="text-danger"> La liste des factures est vite! <strong></p>
                </td>
            </tr>
            @endforelse


        </tbody>
        <tfoot>

        </tfoot>
    </table>
    <tr>
        <a type="button" class="btn" href="" style='color: rgb(255, 255, 255); background-color: rgb(5, 5, 5); margin: 5px;'>Imprimer</a>
    </tr>
</div>


@endsection

