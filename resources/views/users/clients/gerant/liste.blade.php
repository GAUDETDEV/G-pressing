@extends('layouts/auth')
@section('title',"liste clients")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<div class="d-flex">

    <a href="{{route("gerantAjoutClient")}}" type="button" class="btn" style='background-color:rgb(66, 16, 250); color: white;'>
        <i class="fa-solid fa-plus"></i> Ajouter
    </a>

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
                Tous les clients seront supprimés!
            </div>
            <div class="modal-footer">
            <a class="btn btn-primary" href="{{route('geantDeleteAllClient')}}"><i class="fa-solid fa-check"></i> Je confirme</a>
            <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-rotate-left"></i> Annuler</button>
            </div>
        </div>
    </div>
  </div>
<!-- Fin Modal -->


<!-- debut barre de recherche -->

<div class="container mt-3">
    <form action="" method="get" action="{{route('gerantListeClient')}}" style="display: flex;">

        @csrf
        @method('get')
        <input class="form-control no-border-input" type="text" name="search" placeholder="Recherche...">
        <button type="submit" class="btn no-border-button" style="background-color:rgb(8, 134, 173); color: white;">Rechercher</button>

    </form>
</div>

<!-- fin barre de recherche -->

<table class="table table-light table-hover mt-3 shadow rounded-5">
    <caption class="fs-5" style="color:rgb(15, 109, 177);"><strong>Liste des clients</strong></caption>
    <thead class="table-primary">
        <tr>
            <th>Photo(s)</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone(s)</th>
            <th>Adresse</th>
            <th>Inscrit le</th>
            <th>Modifier le</th>
            <th>Action(s)</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($clients as $client)
        <tr>
            <td>

                @if ($client->photo)

                <img src="{{ asset('storage/'.$client->photo) }}" alt="Photo de profil" style="width: 3rem; height: 3rem; text-align: center; border-radius: 10px;">

                @else

                <img src="{{ asset('https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg')}}" alt="" style="width: 3rem; height: 3rem; text-align: center; border-radius: 10px;">

                @endif

            </td>
            <td>{{ $client->name }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->telephone }}</td>
            <td>{{ $client->adresse }}</td>
            <td>{{ $client->created_at }}</td>
            <td>{{ $client->updated_at }}</td>
            <td>
                <a href="{{route('gerantDetailClient',["client" => $client->id])}}" title="details" style='color: rgb(14, 8, 4);'><i class="fa-solid fa-eye"></i></a><!--boutton details-->
                <a href="{{route('gerantModifyClient',["client" => $client->id])}}" title="modifier" style='color: rgb(38, 11, 214);'><i class="fa-solid fa-pen"></i></a><!--boutton modifier-->
                <a href="{{route('geantDeleteClient',["client" => $client->id])}}" type="button" title="supprimer" style='color: rgb(217, 6, 6);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
            </td>
        </tr>
        @empty

        <tr>
            <td colspan="7" class="text-center"><strong style="color:red;">La liste des clients est vite!</strong></td>
        </tr>

        @endforelse

    </tbody>
    <tfoot class="table-primary">

    </tfoot>



</table>

{{ $clients->links() }}

@endsection
