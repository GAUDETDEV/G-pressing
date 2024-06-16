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
    <form action="" method="get" action="{{route('listeAllRecu')}}" style="display: flex;">

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
                <th class="text-primary">#</th>
                <th class="text-primary">Titulaire(s)</th>
                <th class="text-primary">telephone(s)</th>
                <th class="text-primary">Montant</th>
                <th class="text-primary">Reste(s)</th>
                <th class="text-primary">Etat(s)</th>
                <th class="text-primary">date de délivrance</th>
                <th class="text-primary">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($all_recus as $all_recu)
            <tr>
                <td><strong>{{ $all_recu->id}}</strong></td>
                <td>{{ $all_recu->nom_titulaire}}</td>
                <td>{{ $all_recu->tel_titulaire}}</td>
                <td><strong style="color: red;">{{ $all_recu->montant}} Frs</strong></td>
                <td>{{ $all_recu->reste}} Frs</td>

                @if ($all_recu->statut_facture == "Régler")
                <td>
                    <button style="color:white; background-color:rgb(39, 198, 7); padding: 5px; border-radius: 10px; border: none;">{{ $all_recu->statut_facture }}</button>
                </td>
                @elseif ($all_recu->statut_facture == "Non régler")
                <td>
                    <button type="submit" style="color:white; background-color:rgb(244, 74, 12); padding: 5px; border-radius: 10px; border: none;">{{ $all_recu->statut_facture }}</button>
                </td>
                @else
                <td>
                    <button style="color:white; background-color:rgb(2, 101, 129); padding: 5px; border-radius: 10px; border: none;">Inconnu</button>
                </td>
                @endif

                <td>{{ $all_recu->created_at}}</td>
                <td>
                    <a href="{{route('AllDetails',['recu'=> $all_recu->id])}}" title="details" style='color: rgb(14, 8, 4);'><i class="fa-solid fa-eye"></i></a><!--boutton details-->
                    <a href="{{route('AllDelete',['recu'=> $all_recu->id])}}" title="supprimer" style='color: rgb(217, 6, 6);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="8">
                    <p class="text-center"><strong class="text-danger"> Aucun reçu n'a été délivrée! <strong></p>
                </td>
            </tr>
            @endforelse

        </tbody>
        <tfoot>
            <tr>
                <td><strong>{{$nbr_recus}}</strong></td>
                <td colspan="2" class="fs-5"><strong>Total</strong></td>
                <td class="fs-5 text-danger">{{$montant_total}} frs</td>
                <td class="fs-5">{{$reste_total}} frs</td>
            </tr>
        </tfoot>
    </table>
</div>

<div class="mt-3">

    {{$all_recus->links()}}

</div>


@endsection
