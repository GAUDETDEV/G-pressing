@extends('layouts/auth')
@section('title',"factures classiques")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>


<!-- debut barre de recherche -->

<div class="container mt-3">

    <form action="{{route('listeAllFacture')}}" method="get" action="" style="display: flex; background-color:rgb(3, 49, 70); padding: 5px; border-radius: 3px;">

        @csrf
        @method('get')

        <input class="form-control no-border-input m-2" type="text" name="search" placeholder="Recherchez ici ...">
        <button type="submit" class="btn no-border-button m-2" style="background-color:rgb(8, 134, 173); color: white;"><i class="fa-solid fa-magnifying-glass"></i></button>

    </form>
</div>

<!-- fin barre de recherche -->

<div class="d-flex">

<!-- Button trigger modal -->
    <button type="button" class="btn mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style='background-color:rgb(240, 0, 0); color: rgb(244, 244, 244); margin-left: 3px;'>
        <i class="fa-solid fa-broom"></i> Nettoyage complet
    </button>

</div>

<!-- Debut Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel" style='color:rgb(240, 0, 0);'>Attention <i class="fa-solid fa-2x fa-circle-info" style='color:rgb(240, 0, 0);'></i></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-5 text-danger">
                Toutes les factures seront supprimées!
            </div>
            <div class="modal-footer">
            <a class="btn btn-primary" href="{{route('deleteAllFactureGerant')}}"><i class="fa-solid fa-check"></i> Je confirme</a>
            <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-rotate-left"></i> Annuler</button>
            </div>
        </div>
    </div>
  </div>
<!-- Fin Modal -->



<!--debut block liste de mes(receptionniste) facture-->


<div class="mt-5">
    <table class="table table-striped shadow">
        <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des factures</strong></caption>
        <thead>
            <tr class="text-center">
                <th class="text-primary">N°</th>
                <th class="text-primary">Titulaire(s)</th>
                <th class="text-primary">Téléphone(s)</th>
                <th class="text-primary">Montant(s)</th>
                <th class="text-primary">Reste(s)</th>
                <th class="text-primary">Etat</th>
                <th class="text-primary">Livraison(s)</th>
                <th class="text-primary">Créer le</th>
                <th class="text-primary">Mis à jour le</th>
                <th class="text-primary">Action(s)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($allfactures as $allfacture)
            <tr class="text-center">
                <td><strong>{{ $allfacture->id}}</strong></td>
                <td>{{ $allfacture->nom_titulaire}}</td>
                <td>{{ $allfacture->tel_titulaire}}</td>
                <td><strong style='color: rgb(202, 3, 3);'>{{ $allfacture->montant }} frs</strong></td>
                <td><strong>{{ $allfacture->reste}} frs</strong></td>

                @if ($allfacture->statut_facture == "Régler")
                <td>
                    <button style="color:white; background-color:rgb(39, 198, 7); padding: 5px; border-radius: 10px; border: none;">{{ $allfacture->statut_facture }}</button>
                </td>
                @elseif ($allfacture->statut_facture == "Non régler")
                <td>
                    <form action="{{route('putEtatFacture',['facture' => $allfacture->id])}}" method="post">
                        @method('put')
                        @csrf
                        <input type="text" name="statut_facture" value="Régler" style="display: none">
                        <button type="submit" style="color:white; background-color:rgb(244, 74, 12); padding: 5px; border-radius: 10px; border: none;">{{ $allfacture->statut_facture }}</button>
                    </form>
                </td>
                @else
                <td>
                    <button style="color:white; background-color:rgb(2, 101, 129); padding: 5px; border-radius: 10px; border: none;">Inconnu</button>
                </td>
                @endif

                @if ($allfacture->etat_livraison == "Oui")
                    <td>
                        <button style="color:white; background-color:rgb(39, 198, 7); padding: 5px; border-radius: 10px; border: none;">{{ $allfacture->etat_livraison }}</button>
                    </td>
                @else
                    <td>
                        <button style="color:white; background-color:rgb(212, 9, 9); padding: 5px; border-radius: 10px; border: none;">{{ $allfacture->etat_livraison }}</button>
                    </td>
                @endif

                <td>{{ $allfacture->created_at}}</td>
                <td>{{ $allfacture->updated_at}}</td>

                <td>
                    <a href="{{route('detailFactureGerant',['facture' => $allfacture->id])}}" type="button" class="btn" title="Détails" style='color: rgb(0, 0, 0);'><i class="fa-solid fa-eye"></i></a><!--boutton détails-->
                    <a href="{{route('modifyFactureGerant',['facture' => $allfacture->id])}}" type="button" class="btn" title="Modifier" style='color: rgb(6, 100, 58);'><i class="fa-solid fa-pen"></i></a><!--boutton modifier-->
                    <a href="{{route('deleteFactureGerant',['facture' => $allfacture->id])}}" type="button" class="btn" title="Supprimer" style='color: rgb(202, 3, 3);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
                    <a href="{{route('gerantDownloadFacture',['facture' => $allfacture->id])}}" type="button" class="btn" title="Télécharger" style='color: rgb(1, 43, 254);'><i class="fa-solid fa-download"></i></a><!--boutton download-->
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

        {{$allfactures->links()}}

    </div>

</div>
<!--fin block liste de mes(receptionniste) facture-->

@endsection
