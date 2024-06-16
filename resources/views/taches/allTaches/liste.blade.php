@extends('layouts/auth')
@section('title',"toutes les taches")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<div class="d-flex">

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
                Toutes les tâches seront supprimées!
            </div>
            <div class="modal-footer">
            <a class="btn btn-primary" href="{{route('deleteAllTache')}}"><i class="fa-solid fa-check"></i> Je confirme</a>
            <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-rotate-left"></i> Annuler</button>
            </div>
        </div>
    </div>
  </div>
<!-- Fin Modal -->



<!-- debut barre de recherche -->

<div class="container mt-3">

    <form action="{{route('indexAllTache')}}" method="get" action="" style="display: flex; background-color:rgb(3, 49, 70); padding: 5px; border-radius: 3px;">

        @csrf
        @method('get')

        <input class="form-control no-border-input m-2" type="text" name="search" placeholder="Recherchez ici ...">
        <button type="submit" class="btn no-border-button m-2" style="background-color:rgb(8, 134, 173); color: white;"><i class="fa-solid fa-magnifying-glass"></i></button>

    </form>
</div>

<!-- fin barre de recherche -->

<div class="mt-5">
    <table class="table table-striped shadow">
        <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste de toutes les tâches</strong></caption>
        <thead>
            <tr>
                <th class="text-primary">Type de tâches</th>
                <th class="text-primary">Debut</th>
                <th class="text-primary">Fin</th>
                <th class="text-primary">Etats</th>
                <th class="text-primary">Créer le:</th>
                <th class="text-primary">Dernière mise à jour</th>
                <th class="text-primary">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($all_taches as $all_tache)
            <tr>
                <td>{{ $all_tache->type_tache}}</td>
                <td>{{ $all_tache->debut_tache}}</td>
                <td>{{ $all_tache->fin_tache}}</td>

                @if ($today < $all_tache->fin_tache and $all_tache->etat_tache == "En attente")
                    <td><span style="color:aliceblue; background-color:rgb(4, 96, 216); padding: 5px; border-radius: 3px;">{{$all_tache->etat_tache}} ... </span></td>
                @endif
                @if ($today >= $all_tache->fin_tache and $all_tache->etat_tache == "En attente")
                    <td><span style="color:aliceblue; background-color:rgb(185, 16, 25); padding: 5px; border-radius: 3px;">Non éffectuée <i class="fa-solid fa-xmark"></i></span></td>
                @endif
                @if ($today < $all_tache->fin_tache and $all_tache->etat_tache == "Terminée")
                <td><span style="color:aliceblue; background-color:rgb(10, 190, 31); padding: 5px; border-radius: 3px;">Terminée <i class="fa-solid fa-check"></i></span></td>
                @endif
                @if ($today >= $all_tache->fin_tache and $all_tache->etat_tache == "Terminée")
                    <td><span style="color:aliceblue; background-color:rgb(10, 190, 31); padding: 5px; border-radius: 3px;">Terminée <i class="fa-solid fa-check"></i></span></td>
                @endif

                <td>{{ $all_tache->created_at}}</td>
                <td>{{ $all_tache->updated_at}}</td>
                <td>
                    <a href="{{route('detailAllTache',['tache' => $all_tache->id])}}" type="button" class="btn" title="Détails" style='color: rgb(255, 255, 255); background-color:rgb(28, 8, 79);'><i class="fa-solid fa-eye"></i></a><!--boutton détails-->
                    <a href="{{route('modifyTache',['tache' => $all_tache->id])}}" type="button" class="btn" title="Modifier" style='color: rgb(255, 255, 255); background-color:rgb(14, 103, 76);'><i class="fa-solid fa-pen-nib"></i></a><!--boutton modifier-->
                    <a href="{{route('deleteTache',['tache'=>$all_tache->id])}}" type="button" class="btn" title="Supprimer" style='color: rgb(255, 255, 255); background-color:rgb(62, 4, 7);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
                </td>

            </tr>

            @empty
            <tr>
                <td colspan="8">
                    <p class="text-center"><strong class="text-danger"> La liste des tâches est vite! <strong></p>
                </td>
            </tr>
            @endforelse

        </tbody>
        <tfoot>

        </tfoot>
    </table>

</div>

{{$all_taches->links()}}

@endsection
