@extends('layouts/auth')
@section('title',"Liste factures")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!-- debut barre de recherche -->

<div class="container mt-3">
    <form action="" method="get" action="{{route('listeMyFacture')}}" style="display: flex;">

        @csrf
        @method('get')

        <input class="form-control no-border-input" type="text" name="search" placeholder="Recherche...">
        <button type="submit" class="btn no-border-button" style="background-color:rgb(8, 134, 173); color: white;">Rechercher</button>

    </form>
</div>

<!-- fin barre de recherche -->


<div class="mt-5">
    <table class="table table-striped shadow">
        <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des factures</strong></caption>
        <thead>
            <tr>
                <th class="text-primary">N°</th>
                <th class="text-primary">Titulaire</th>
                <th class="text-primary">Téléphone</th>
                <th class="text-primary">Etat(s)</th>
                <th class="text-primary">Montant(s)</th>
                <th class="text-primary">Reste(s)</th>
                <th class="text-primary">Livraison(s)</th>
                <th class="text-primary">Créer le</th>
                <th class="text-primary">Mis à jour le</th>
                <th class="text-primary">Action(s)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($factures as $facture)
            <tr>
                <td style="font-weight: bold;">{{ $facture->id }}</td>
                <td>{{ $facture->nom_titulaire }}</td>
                <td>{{ $facture->tel_titulaire }}</td>

                @if ($facture->statut_facture == "Régler")
                <td>
                    <button style="color:white; background-color:rgb(39, 198, 7); padding: 5px; border-radius: 10px; border: none;">{{ $facture->statut_facture }}</button>
                </td>
                @elseif ($facture->statut_facture == "Non régler")
                <td>
                    <button style="color:white; background-color:rgb(244, 74, 12); padding: 5px; border-radius: 10px; border: none;">{{ $facture->statut_facture }}</button>
                </td>
                @else
                <td>
                    <button style="color:white; background-color:rgb(2, 101, 129); padding: 5px; border-radius: 10px; border: none;">En attente...</button>
                </td>
                @endif

                <td style="color:rgb(21, 5, 161); font-weight: bold;">{{ $facture->montant }} Frs</td>
                <td style="color:rgb(21, 5, 161); font-weight: bold;">{{ $facture->reste }} Frs</td>

                @if ($facture->etat_livraison == "Oui")
                    <td class="text-center">
                        <button style="color:white; background-color:rgb(39, 198, 7); padding: 5px; border-radius: 10px; border: none;">{{ $facture->etat_livraison }}</button>
                    </td>
                @elseif ($facture->etat_livraison == "Non")
                    <td class="text-center">
                        <button style="color:white; background-color:rgb(212, 9, 9); padding: 5px; border-radius: 10px; border: none;">{{ $facture->etat_livraison }}</button>
                    </td>
                @else
                    <td class="text-center">
                        <button style="color:white; background-color:rgb(26, 8, 187); padding: 5px; border-radius: 10px; border: none;">Non defini</button>
                    </td>
                @endif

                <td>{{ $facture->created_at }}</td>
                <td>{{ $facture->updated_at }}</td>
                <td>
                    <a href="{{route("detailFactureClient",["facture" => $facture->id])}}" type="button" class="btn" title="Détails" style='color: rgb(65, 11, 203);'><i class="fa-solid fa-eye"></i></a><!--boutton détails-->
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

    <div class="mt-3">
        {{$factures->links()}}
    </div>

</div>


@endsection
