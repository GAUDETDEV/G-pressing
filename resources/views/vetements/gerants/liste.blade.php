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

    <form action="{{route('listeVetements')}}" method="get" action="" style="display: flex; background-color:rgb(3, 49, 70); padding: 5px; border-radius: 3px;">

        @csrf
        @method('get')

        <input class="form-control no-border-input m-2" type="text" name="search" placeholder="Recherchez ici ...">
        <button type="submit" class="btn no-border-button m-2" style="background-color:rgb(8, 134, 173); color: white;"><i class="fa-solid fa-magnifying-glass"></i></button>

    </form>
</div>

<!-- fin barre de recherche -->


<!--debut bouton add vetements-->

<div class="d-flex mt-3">

    <a href="{{route('ajouterVet')}}" type="button" class="btn" style='background-color:rgb(66, 16, 250); color: white;'>
        <i class="fa-solid fa-plus"></i> Ajouter
    </a>

</div>

<!--fin bouton add vetements-->

<table class="table mt-3 shadow rounded-5">
    <thead>
        <tr>
            <th>#</th>
            <th>type</th>
            <th>prix</th>
            <th>créer le:</th>
            <th>mis à jour le:</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($vetements as $vetement)
        <tr>
            <td>{{ $vetement->id }}</td>
            <td>{{ $vetement->nom_vet }}</td>
            <td>{{ $vetement->prix_vet }} Francs CFA</td>
            <td>{{ $vetement->created_at }}</td>
            <td>{{ $vetement->updated_at }}</td>
            <td>
                <a href="{{route('detailVet',["vetement" => $vetement->id])}}" title="details" style='color: rgb(14, 8, 4);'><i class="fa-solid fa-eye"></i></a><!--boutton details-->
                <a href="{{route('deleteVet',["vetement" => $vetement->id])}}" href="" type="button" title="supprimer" style='color: rgb(217, 6, 6);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
                <a href="{{route('modifyVet',["vetement" => $vetement->id])}}" title="modifier" style='color: rgb(38, 11, 214);'><i class="fa-solid fa-pen"></i></a><!--boutton modifier-->
            </td>

        </tr>

    </tbody>
    <tfoot>

    </tfoot>

    @empty

        <p class="text-center"><strong class="text-danger"> La liste des vêtements est vite! <strong></p>

    @endforelse

</table>


{{ $vetements->links() }}


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
            Tous les vêtements seront supprimés!
        </div>
        <div class="modal-footer">
        <a class="btn btn-primary" href="{{route('deleteAllVetement')}}"><i class="fa-solid fa-check"></i> Je confirme</a>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-rotate-left"></i> Annuler</button>
        </div>
    </div>
</div>
</div>
<!-- Fin Modal -->


@endsection
