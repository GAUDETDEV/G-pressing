@extends('layouts/auth')
@section('title',"liste des livraisons")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>


<!-- debut barre de recherche -->

<div class="container mt-3">
    <form action="" method="get" action="{{route('ListeLivraison')}}" style="display: flex;">

        @csrf
        @method('get')
        <input class="form-control no-border-input" type="text" name="search" placeholder="Recherche...">
        <button type="submit" class="btn no-border-button" style="background-color:rgb(8, 134, 173); color: white;">Rechercher</button>

    </form>
</div>

<!-- fin barre de recherche -->


<div class="mt-5">
    <table class="table table-striped shadow">
        <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des livraisons</strong></caption>
        <thead>
            <tr>
                <th class="text-primary">Client(s)</th>
                <th class="text-primary">Téléphone(s)</th>
                <th class="text-primary">Date de livraison</th>
                <th class="text-primary">Heure de livraison</th>
                <th class="text-primary">Plannifié le</th>
                <th class="text-primary">Modifié le</th>
                <th class="text-primary">Action(s)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($liste_livraisons as $liste_livraison)
            <tr>
                <td>{{ $liste_livraison->nom_destinataire}}</td>
                <td>{{ $liste_livraison->tel_destinataire}}</td>
                <td>{{ $liste_livraison->date_livraison}}</td>
                <td>{{ $liste_livraison->heure_livraison}}</td>
                <td>{{ $liste_livraison->created_at}}</td>
                <td>{{ $liste_livraison->updated_at}}</td>
                <td>
                    <a type="button" class="btn" href="{{route('detailLivraison',['livraison' => $liste_livraison->id])}}" title="Détails" style='color: rgb(2, 120, 140);'><i class="fa-solid fa-eye"></i></a>
                    <a type="button" class="btn" href="{{route('deleteLivraison',['livraison' => $liste_livraison->id])}}" title="Supprimer" style='color: rgb(227, 0, 0);'><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <p class="text-center"><strong class="text-danger"> La liste des livraisons est vite! <strong></p>
                </td>
            </tr>
            @endforelse

        </tbody>
        <tfoot>
            <tr>
                <td colspan="8"><a type="button" class="btn" href="{{route('gerantDownloadListeLivraison')}}" title="Télécharger le pdf" style='color: rgb(255, 255, 255); background-color: rgb(5, 5, 5); margin: 5px;'><i class="fa-solid fa-download"></i> pdf</a></td>
            </tr>
        </tfoot>
    </table>
</div>

<div class="mt-3">

    {{$liste_livraisons->links()}}

</div>


@endsection
