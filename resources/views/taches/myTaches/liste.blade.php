@extends('layouts/auth')
@section('title',"Mes taches")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!-- debut barre de recherche -->

<div class="container mt-3">
    <form action="" method="get" action="{{route('indexMyTache')}}" style="display: flex;">

        @csrf
        @method('get')
        <input class="form-control no-border-input" type="text" name="search" placeholder="Recherche...">
        <button type="submit" class="btn no-border-button" style="background-color:rgb(8, 134, 173); color: white;">Rechercher</button>

    </form>
</div>

<!-- fin barre de recherche -->

<div class="mt-5">

    <table class="table table-striped shadow">
        <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste de toutes mes tâches</strong></caption>
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
            @forelse ($my_taches as $my_tache)
            <tr>
                <td>{{ $my_tache->type_tache}}</td>
                <td>{{ $my_tache->debut_tache}}</td>
                <td>{{ $my_tache->fin_tache}}</td>

                @if ($today < $my_tache->fin_tache and $my_tache->etat_tache == "En attente")
                    <td><span style="color:aliceblue; background-color:rgb(4, 96, 216); padding: 5px; border-radius: 3px;">{{$my_tache->etat_tache}} ... </span></td>
                @endif

                @if ($today >= $my_tache->fin_tache and $my_tache->etat_tache == "En attente")
                <td><span style="color:aliceblue; background-color:rgb(185, 16, 25); padding: 5px; border-radius: 3px;">Non éffectuée <i class="fa-solid fa-xmark"></i></span></td>
                @endif

                @if ($today < $my_tache->fin_tache and $my_tache->etat_tache == "Terminée")
                <td><span style="color:aliceblue; background-color:rgb(10, 190, 31); padding: 5px; border-radius: 3px;">Terminée <i class="fa-solid fa-check"></i></span></td>
                @endif

                @if ($today >= $my_tache->fin_tache and $my_tache->etat_tache == "Terminée")
                <td><span style="color:aliceblue; background-color:rgb(10, 190, 31); padding: 5px; border-radius: 3px;">Terminée <i class="fa-solid fa-check"></i></span></td>
                @endif

                <td>{{ $my_tache->created_at}}</td>
                <td>{{ $my_tache->updated_at}}</td>
                <td>

                    <a href="{{route('detailMyTache',['tache' => $my_tache->id])}}" type="button" class="btn" title="Détails" style='color: rgb(255, 255, 255); background-color:rgb(28, 8, 79);'><i class="fa-solid fa-eye"></i></a><!--boutton détails-->

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

    <tr>
        <a type="button" class="btn" href="{{route('downloadMyTaches')}}" style='color: rgb(255, 255, 255); background-color: rgb(5, 5, 5); margin: 5px;'><i class="fa-solid fa-download"></i> Télécharger</a>
    </tr>

</div>

{{$my_taches->links()}}

@endsection
