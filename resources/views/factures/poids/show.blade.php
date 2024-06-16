@extends('layouts/auth')
@section('title',"factures poids")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut bouton d'ajout facture-->

<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAddFacture" style="background-color:rgb(174, 174, 174); color: rgb(0, 0, 0);">
    <i class="fa-solid fa-plus"></i> Ajouter
</button>

<a href="{{route('listVetReceptPoids',['depot_poid' => $depot_poid->id])}}" type="button" class="btn" style="background-color:rgb(0, 0, 0); color: white;">
    <i class="fa-solid fa-list"></i> Liste des vêtements receptionnés
</a>

<!--fin bouton d'ajout facture-->

<!--debut modal add facture -->
<div class="modal fade" id="exampleModalAddFacture" tabindex="-1" aria-labelledby="exampleModalAddFactureLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddFactureLabel" style="color:rgb(87, 87, 87); font-weight: bold; border-bottom: solid 5px rgb(0, 0, 0); ">AJOUT DE FACTURE EN FONCTION DU POIDS DE VÊTEMENTS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postFacturePoids',['depot_poid' => $depot_poid->id])}}" method="POST">

                @method('post')
                @csrf

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Titulaire</label>
                <input type="text" class="form-control mt-3" name="nom_titulaire">
                @if ($errors)
                @error('nom_titulaire')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Téléphone</label>
                <input type="text" class="form-control mt-3" name="tel_titulaire">
                @if ($errors)
                @error('tel_titulaire')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer </button>
                <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
        </div>

    </div>
    </div>
</div>
<!--fin modal add facture -->


<div class="mt-5">
    <table class="table table-striped shadow">
        <caption class="fs-5" style="color:rgb(120, 120, 120); border-top: solid 5px rgb(0, 0, 0);"><strong>Liste des factures</strong></caption>
        <thead>
            <tr>
                <th style="color:rgb(115, 115, 115);">N°</th>
                <th style="color:rgb(115, 115, 115);">Titulaire</th>
                <th style="color:rgb(115, 115, 115);">Téléphone</th>
                <th style="color:rgb(115, 115, 115);">Créer le</th>
                <th style="color:rgb(115, 115, 115);">Mis à jour le</th>
                <th style="color:rgb(115, 115, 115);">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($factures as $facture)
            <tr>
                <td>{{ $facture->id}}</td>
                <td>{{ $facture->nom_titulaire}}</td>
                <td>{{ $facture->tel_titulaire}}</td>
                <td>{{ $facture->created_at}}</td>
                <td>{{ $facture->updated_at}}</td>
                <td>
                    @if ($facture->etat_traitement === "Depot" or $facture->etat_traitement === "Lavage" or $facture->etat_traitement === "Repassage" or $facture->etat_traitement === "Stockage" or $facture->etat_traitement === "Fin")
                    <fieldset disabled>
                    <a href="{{route('editFacturePoids',["facture" => $facture->id])}}" type="button" class="btn" title="Editer" style='color: rgb(255, 255, 255); background-color: gray;'><i class="fa-solid fa-pen-to-square"></i></a><!--boutton éditer-->
                    <a href="{{route('modifyFacturePoids',["facture" => $facture->id])}}" type="button" class="btn" title="Modifier" style='color: rgb(255, 255, 255); background-color: gray;'><i class="fa-solid fa-pen-nib"></i></a><!--boutton modifier-->
                    </fieldset>
                    @else
                    <a href="{{route('editFacturePoids',["facture" => $facture->id])}}" type="button" class="btn" title="Editer" style='color: rgb(255, 255, 255); background-color:rgb(4, 96, 216);'><i class="fa-solid fa-pen-to-square"></i></a><!--boutton éditer-->
                    <a href="{{route('modifyFacturePoids',["facture" => $facture->id])}}" type="button" class="btn" title="Modifier" style='color: rgb(255, 255, 255); background-color:rgb(14, 103, 76);'><i class="fa-solid fa-pen-nib"></i></a><!--boutton modifier-->
                    @endif

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
            <tr>
                @if ($count !== 0)
                <a type="button" class="btn" href="{{route('downloadFacturePoids',['depot_poid' => $depot_poid->id])}}" style='color: rgb(255, 255, 255); background-color: rgb(5, 5, 5); margin: 5px;'><i class="fa-solid fa-download"></i> Télécharger</a>
                @endif
            </tr>
        </tfoot>
    </table>

    <div class="mt-3">

        {{$factures->links()}}

    </div>

</div>


@endsection
