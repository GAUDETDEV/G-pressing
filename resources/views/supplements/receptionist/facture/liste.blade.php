@extends('layouts/auth')
@section('title',"liste facture")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut bouton d'ajout facture-->

<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAddFacture" style="background-color:rgb(66, 16, 250); color: white;">
    <i class="fa-solid fa-plus"></i> Ajouter
</button>

@if ($nbr_vet_supplement !== 0)
<a href="{{route('receptionistlistVetReceptSupplement',["service" => $service->id])}}" type="button" class="btn" style="background-color:rgb(0, 0, 0); color: white;">
    <i class="fa-solid fa-list"></i> Liste des vêtements receptionnés
</a>
@endif

<!--fin bouton d'ajout facture-->

<!--debut block liste de mes(receptionniste) facture-->

<!--debut modal add facture -->
<div class="modal fade" id="exampleModalAddFacture" tabindex="-1" aria-labelledby="exampleModalAddFactureLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddFactureLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE FACTURE</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('receptionistPostFacture',["service" => $service->id])}}" method="POST">

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
                <input type="text" class="form-control mt-3" name="tel_titulaire" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}">
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
        <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des factures</strong></caption>
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
            <tr>
                <td>{{ $liste_facture->id}}</td>
                <td>{{ $liste_facture->nom_titulaire}}</td>
                <td>{{ $liste_facture->tel_titulaire}}</td>
                <td>{{ $liste_facture->created_at}}</td>
                <td>{{ $liste_facture->updated_at}}</td>
                <td>
                    @if ($liste_facture->etat_traitement === "Depot" or $liste_facture->etat_traitement === "Lavage" or $liste_facture->etat_traitement === "Repassage" or $liste_facture->etat_traitement === "Stockage" or $liste_facture->etat_traitement === "Fin")

                    <fieldset disabled>
                    <a href="{{route('receptionistReceptVetSupplement',["facture" => $liste_facture->id])}}" type="button" class="btn" title="Editer" style='color: rgb(255, 255, 255); background-color: gray;'><i class="fa-solid fa-pen-to-square"></i></a><!--boutton éditer-->
                    <a href="{{route('receptionistModifyFactureSupplement',["facture" => $liste_facture->id])}}" type="button" class="btn" title="Modifier" style='color: rgb(255, 255, 255); background-color: gray;'><i class="fa-solid fa-pen-nib"></i></a><!--boutton modifier-->
                    </fieldset>

                    @else

                    <a  href="{{route('receptionistReceptVetSupplement',["facture" => $liste_facture->id])}}" type="button" class="btn" title="Editer" style='color: rgb(255, 255, 255); background-color:rgb(4, 96, 216);'><i class="fa-solid fa-pen-to-square"></i></a><!--boutton éditer-->
                    <a  href="{{route('receptionistModifyFactureSupplement',["facture" => $liste_facture->id])}}" type="button" class="btn" title="Modifier" style='color: rgb(255, 255, 255); background-color:rgb(14, 103, 76);'><i class="fa-solid fa-pen-nib"></i></a><!--boutton modifier-->

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

        </tfoot>
    </table>
    <tr>
        @if ($count !== 0 )
        <a type="button" class="btn" href="{{route('receptionistDownloadFactureSupplement',["service" => $service->id])}}" style='color: rgb(255, 255, 255); background-color: rgb(0, 0, 0); margin: 5px;'><i class="fa-solid fa-download"></i> Télécharger</a>
        @endif
    </tr>
</div>

<div class="container">

    {{$liste_factures->links()}}

</div>
<!--fin block liste de mes(receptionniste) facture-->

@endsection
