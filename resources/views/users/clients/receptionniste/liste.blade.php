@extends('layouts/auth')
@section('title',"liste clients")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<div class="d-flex">

    <a href="{{route("receptionistAjoutClient")}}" type="button" class="btn" style='background-color:rgb(66, 16, 250); color: white;'>
        <i class="fa-solid fa-plus"></i> Ajouter
    </a>

</div>


<!-- debut barre de recherche -->

<div class="container mt-3">
    <form action="" method="get" action="{{route('receptionistListeClient')}}" style="display: flex;">

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
                <a href="{{route('receptionistDetailClient',["client" => $client->id])}}" title="details" style='color: rgb(14, 8, 4);'><i class="fa-solid fa-eye"></i></a><!--boutton details-->
                <a href="{{route('receptionistModifyClient',["client" => $client->id])}}" title="modifier" style='color: rgb(38, 11, 214);'><i class="fa-solid fa-pen"></i></a><!--boutton modifier-->
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
