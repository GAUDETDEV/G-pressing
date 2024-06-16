@extends('layouts/auth')
@section('title',"liste gérants")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<div class="d-flex">

    <a href="{{route('ajouterGerants')}}" type="button" class="btn" style='background-color:rgb(66, 16, 250); color: white;'>
        <i class="fa-solid fa-plus"></i> Ajouter
    </a>

</div>

<!-- debut barre de recherche -->

<div class="container mt-3">
    <form action="" method="get" action="{{route('listeGerant')}}" style="display: flex;">

        @csrf
        @method('get')
        <input class="form-control no-border-input" type="text" name="search" placeholder="Recherche...">
        <button type="submit" class="btn no-border-button" style="background-color:rgb(8, 134, 173); color: white;">Rechercher</button>

    </form>
</div>

<!-- fin barre de recherche -->

<table class="table table-striped mt-3 shadow rounded-5">
    <thead>
        <tr>
            <th>#</th>
            <th>Photo</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Entreprise</th>
            <th>fin souscription</th>
            <th>Souscrire le</th>
            <th>Modifier le</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($gerants as $gerant)
        <tr>
            <td>{{ $gerant->id }}</td>
            <td>

                @if ($gerant->photo)

                <img src="{{ asset('storage/'.$gerant->photo) }}" alt="Photo de profil" style="width: 3rem; height: 3rem; text-align: center; border-radius: 10px;">

                @else

                <img src="{{ asset('https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg')}}" alt="" style="width: 3rem; height: 3rem; text-align: center; border-radius: 10px;">

                @endif

            </td>
            <td>{{ $gerant->name }}</td>
            <td>{{ $gerant->email }}</td>
            <td>{{ $gerant->telephone }}</td>
            <td>{{ $gerant->entreprise }}</td>
            <td>{{ $gerant->fin_souscription }}</td>
            <td>{{ $gerant->created_at }}</td>
            <td>{{ $gerant->updated_at }}</td>
            <td>
                <a href="{{route('detailGerant',["gerant"=>$gerant->id])}}" title="details" style='color: rgb(14, 8, 4);'><i class="fa-solid fa-eye"></i></a><!--boutton details-->
                <a data-bs-toggle="modal" data-bs-target="#modalDeleteGerant" href="" type="button" title="supprimer" style='color: rgb(217, 6, 6);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
                <a href="{{route('modifyGerant',["gerant"=>$gerant->id])}}" title="modifier" style='color: rgb(38, 11, 214);'><i class="fa-solid fa-pen"></i></a><!--boutton modifier-->
            </td>
<!--debut Modal suppression gerant-->
            <div class="modal fade" id="modalDeleteGerant" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalDeleteGerantLabel">Alerte <i class="fa-solid fa-triangle-exclamation text-danger"></i></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5 style='color: rgb(212, 29, 29);'>Voulez vous vraiment supprimer l'élément?</h5>
                        <h5 style='color: rgb(212, 29, 29);'>Car, cette action est irréversible.</h5>
                    </div>
                    <div class="modal-footer">
                        <a href="{{route('deleteGerant',['gerant'=>$gerant->id])}}" type="button" class="btn" style='background-color:rgb(66, 16, 250); color: white;'>Je confirme</a>
                        <button type="button" class="btn" data-bs-dismiss="modal" style='background-color:rgb(9, 130, 72); color: white;'>Annuler</button>
                    </div>
                </div>
                </div>
            </div>
<!--fin Modal suppression gerant-->
        </tr>

    </tbody>
    <tfoot>

    </tfoot>

    @empty

        <p class="text-center"><strong class="text-danger"> La liste des gérants est vite! <strong></p>

    @endforelse

</table>

{{ $gerants->links() }}

@endsection
