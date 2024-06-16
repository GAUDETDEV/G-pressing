@extends('layouts/auth')
@section('title',"details")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut affichage d'informations recu-->

<div class="container mt-3">

    <div class="text-center rounded-2 shadow" style="color:rgb(246, 246, 246); background-color:rgb(43, 5, 167); padding: 5px;">
        <h2 style="color:rgb(255, 255, 255);">Pressing </h2>
        <h3 style="color:rgb(255, 255, 255);">Détails sur le reçu de:</h3>
        <strong class="fs-3" style="color:rgb(7, 194, 246);"> Mr/Mme : {{ $recu->nom_titulaire }}</strong>
    </div>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations sur le client</h3>
        <div class="card-body">
            <p><strong>Nom : </strong>{{ $recu->nom_titulaire }}</p>
            <p><strong>Téléphone : </strong>{{ $recu->tel_titulaire }}</p>
        </div>
    </div>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations sur le reçu</h3>
        <div class="card-body">
            <p><strong>Statut : </strong>
                @if($recu->statut_facture == "Non régler")
                    <span style="color:aliceblue; background-color:rgb(174, 9, 9); padding: 5px; border-radius: 4px;">{{ $recu->statut_facture }}</span>
                @endif
                @if($recu->statut_facture == "Régler")
                    <span style="color:aliceblue; background-color:rgb(12, 174, 9); padding: 5px; border-radius: 4px;">{{ $recu->statut_facture }}</span>
                @endif
                @if($recu->statut_facture == "")
                    <span style="color:aliceblue; background-color:rgb(104, 12, 134); padding: 5px; border-radius: 4px;">Inconnu</span>
                @endif
            </p>
            <p><strong>Délivré par : </strong>{{ $editor }}</p>
            <p><strong>Délivré le : </strong>{{ $recu->created_at }}</p>
        </div>
    </div>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Liste des vêtements réceptionnés</h3>
        <div class="card-body">

            <table class="table table-striped shadow">
                <thead>
                    <tr>
                        <th class="text-primary">Nom vet</th>
                        <th class="text-primary">Couleur</th>
                        <th class="text-primary">Specificat</th>
                        <th class="text-primary">Catg</th>
                        <th class="text-primary">Qte</th>
                        <th class="text-primary">Prix unit</th>
                        <th class="text-primary">Prix total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($liste_vet_recepts as $liste_vet_recept)
                    <tr>
                        <td>{{ $liste_vet_recept->nom_vet}}</td>
                        <td>{{ $liste_vet_recept->color_vet}}</td>
                        <td>{{ $liste_vet_recept->caract_vet}}</td>
                        <td>{{ $liste_vet_recept->cat_vet}}</td>
                        <td>{{ $liste_vet_recept->qte_vet}}</td>
                        <td>{{ $liste_vet_recept->prix_unitaire}} frs CFA</td>
                        <td>{{ $liste_vet_recept->prix}} frs CFA</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <p class="text-center"><strong class="text-danger"> La liste des vêtements réceptionnés est vite! <strong></p>
                        </td>
                    </tr>
                    @endforelse
                    <tr>
                        <td colspan="4"><strong class="text-danger">Total</strong></td>
                        <td><strong class="text-danger">{{$total_qte}}</strong></td>
                        <td><strong class="text-danger">{{$total_prix_unit}} frs CFA</strong></td>
                        <td><strong class="text-danger">{{$total_prix}} frs CFA</strong></td>
                    </tr>

                </tbody>
                <tfoot>

                </tfoot>
            </table>

        </div>
    </div>

</div>

<!--fin affichage d'informations recu-->

@endsection
