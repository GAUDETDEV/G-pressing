@extends('layouts/auth')
@section('title',"reçus vélivrées")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!-- debut barre de recherche -->

<div class="container mt-3">
    <form action="" method="get" action="{{route('listeMyRecu')}}" style="display: flex;">

        @csrf
        @method('get')
        <input class="form-control no-border-input" type="text" name="search" placeholder="Recherche...">
        <button type="submit" class="btn no-border-button" style="background-color:rgb(8, 134, 173); color: white;">Rechercher</button>

    </form>
</div>

<!-- fin barre de recherche -->

<div class="mt-5">
    <table class="table table-striped shadow">
        <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des reçus délivrées</strong></caption>
        <thead>
            <tr>
                <th class="text-primary">Nom du client</th>
                <th class="text-primary">Téléphone(s)</th>
                <th class="text-primary">Date de délivrance</th>
                <th class="text-primary">Dernière modification</th>
                <th class="text-primary">Action(s)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($my_recus as $my_recu)
            <tr>
                <td>{{ $my_recu->nom_titulaire}}</td>
                <td>{{ $my_recu->tel_titulaire}}</td>
                <td>{{ $my_recu->created_at}}</td>
                <td>{{ $my_recu->updated_at}}</td>
                <td>
                    <a type="button" class="btn" href="{{route('downloadRecuMy',["recu" => $my_recu->id])}}" title="Télécharger" style='color: rgb(27, 26, 26);'><i class="fa-solid fa-download"></i> </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <p class="text-center"><strong class="text-danger"> Vous n'avez délivré aucun reçu ! <strong></p>
                </td>
            </tr>
            @endforelse

        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>

{{ $my_recus -> links()}}


@endsection
