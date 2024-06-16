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
    <form action="" method="get" action="{{route('listeTypeRecept')}}" style="display: flex;">

        @csrf
        @method('get')
        <input class="form-control no-border-input" type="text" name="search" placeholder="Recherche...">
        <button type="submit" class="btn no-border-button" style="background-color:rgb(8, 134, 173); color: white;">Rechercher</button>

    </form>
</div>

<!-- fin barre de recherche -->


<div class="d-flex mt-3">

    <!-- Button trigger modal -->
    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style='background-color:rgb(240, 0, 0); color: rgb(244, 244, 244); margin-left: 3px;'>
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
                Tous les vêtements receptionnés seront supprimés!
            </div>
            <div class="modal-footer">
            <a class="btn btn-primary" href="{{route('deleteTypeAllRecept')}}"><i class="fa-solid fa-check"></i> Je confirme</a>
            <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-rotate-left"></i> Annuler</button>
            </div>
        </div>
    </div>
  </div>
<!-- Fin Modal -->



<div class="mt-5">
    <table class="table table-striped shadow">
        <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des vêtements réceptionnés</strong></caption>
        <thead>
            <tr>
                <th class="text-primary">Type(s)</th>
                <th class="text-primary">Couleur(s)</th>
                <th class="text-primary">Specification(s)</th>
                <th class="text-primary">Catg</th>
                <th class="text-primary">Qte(s)</th>
                <th class="text-primary">Prix unit</th>
                <th class="text-primary">Prix total</th>
                <th class="text-primary">Date de reception</th>
                <th class="text-primary">Action(s)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($liste_recept_types as $liste_recept_type)
            <tr>
                <td>{{ $liste_recept_type->nom_vet}}</td>
                <td>{{ $liste_recept_type->color_vet}}</td>
                <td>{{ $liste_recept_type->caract_vet}}</td>
                <td>{{ $liste_recept_type->cat_vet}}</td>
                <td>{{ $liste_recept_type->qte_vet}}</td>
                <td>{{ $liste_recept_type->prix_unitaire}} frs</td>
                <td>{{ $liste_recept_type->prix}} frs</td>
                <td>{{ $liste_recept_type->created_at}}</td>
                <td>
                    <a href="{{route('deleteTypeRecept',["vetement" => $liste_recept_type->id])}}" type="button" title="supprimer" style='color: rgb(217, 6, 6);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
                </td>
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
                <td><strong class="text-danger">{{$total_prix_unit}} frs</strong></td>
                <td><strong class="text-danger">{{$total_prix}} frs</strong></td>
                <td colspan="2"></td>
            </tr>

        </tbody>
        <tfoot>
            @if ($nbr_recept_types != 0)
            <tr>
                <td>
                    <a type="button" class="btn" href="{{route("gerantDownloadVetementClassic")}}" style='color: rgb(255, 255, 255); background-color: rgb(0, 0, 0); margin: 5px;'><i class="fa-solid fa-download"></i>Télécharger</a>
                </td>
            </tr>
            @endif
        </tfoot>
    </table>
</div>

<div class="mt-3">

    {{$liste_recept_types -> links()}}

</div>


@endsection
