@extends('layouts/auth')
@section('title',"Dashboard")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:10px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(10, 255, 214);">{{ session('message') }}</strong>
    @endif
</div>


@auth



@if (Auth::user()->role == "sudo")
<!--debut block sudo -->

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
            <div class="card shadow" style="background-color:rgb(0, 0, 2);">
                <div class="card-body">
                <h5 class="card-title" style="color:rgb(178, 178, 178); font-size: 30px; font-weight: bold;">Utilisateur(s)</h5>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-users"></i> {{$nbr_users}}</p>
                <a href="" class="btn btn-primary"><i class="fa-solid fa-eye"></i>Voir</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
            <div class="card shadow" style="background-color:rgb(25, 6, 91);">
                <div class="card-body">
                <h5 class="card-title" style="color:rgb(118, 80, 255); font-size: 30px; font-weight: bold;">Gerant(s)</h5>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-user-secret"></i> {{$nbr_gerants}}</p>
                <a href="{{route('listeGerant')}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i>Voir</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
            <div class="card shadow" style="background-color:rgb(145, 4, 46);">
                <div class="card-body">
                <h5 class="card-title" style="color:rgb(255, 80, 217); font-size: 30px; font-weight: bold;">Formule(s)</h5>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-cube"></i> {{$nbr_formules}}</p>
                <a href="{{route('listeFormules')}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i> Voir </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- debut table des cinq derniers gerants inscris -->

<table class="table table-striped mt-5">

    <thead>
        <tr>

            <caption style="color:rgb(0, 119, 143); font-size: 20px; font-style: italic; font-weight: bold;">Liste des cinq derniers gerants inscrits</caption>

            <td>#</td>
            <th>Photo(s)</th>
            <th>Civilité(s)</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone(s)</th>
            <th>Entreprise(s)</th>
            <th>Habitation(s)</th>
            <th>Inscrit le</th>
            <th>Modifié le</th>

        </tr>
    </thead>
    <tbody>
        @forelse ($gerants_news as $gerants_new)
        <tr>

            <td>{{ $gerants_new->id }}</td>
            <td>

                @if ($gerants_new->photo)

                <img src="{{ asset('storage/'.$gerants_new->photo) }}" alt="Photo de profil" style="width: 3rem; height: 3rem; text-align: center; border-radius: 10px;">

                @else

                <img src="{{ asset('https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg')}}" alt="" style="width: 3rem; height: 3rem; text-align: center; border-radius: 10px;">

                @endif

            </td>
            <td>{{ $gerants_new->civilite }}</td>
            <td>{{ $gerants_new->name }}</td>
            <td>{{ $gerants_new->email }}</td>
            <td>{{ $gerants_new->telephone }}</td>
            <td>{{ $gerants_new->entreprise }}</td>
            <td>{{ $gerants_new->lieu_habitation }}</td>
            <td>{{ $gerants_new->created_at }}</td>
            <td>{{ $gerants_new->updated_at }}</td>

        </tr>

        @empty
        <tr class="text-center">
            <td colspan="10">La liste est vite.</td>
        </tr>
        @endforelse

    </tbody>
    <tfoot>

    </tfoot>


</table>










<!-- fin table des cinq derniers gerants inscris -->

<!--fin block sudo -->
@endif



@if (Auth::user()->role == "receptionniste")
<!--debut block receptionist -->

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6">
            <div class="card shadow" style="background-color:rgb(0, 0, 2);">
                <div class="card-body">
                <h5 class="card-title" style="color:rgb(178, 178, 178); font-size: 30px; font-weight: bold;">Tache(s)</h5>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-hand-spock"></i> {{$nbr_tache_receptionist}}</p>
                <a href="{{route('indexMyTache')}}" class="btn btn-primary">En attente de réalisation <span style="color:rgb(4, 16, 109); font-size: 20px; font-weight: bold; font-style: italic; border-radius: 50em; background-color: white; padding: 5px;">{{ $nbr_tache_receptionist_attente }}</span></a>
                </div>
            </div>
            </div>
            <div class="col-sm-6">
            <div class="card shadow" style="background-color:rgb(25, 6, 91);">
                <div class="card-body">
                <h5 class="card-title" style="color:rgb(118, 80, 255); font-size: 30px; font-weight: bold;">Facture(s)</h5>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-file-invoice"></i> {{$nbr_facture_receptionist}}</p>
                <a href="{{route('listeMyFacture')}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i>Voir</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-sm-6">
            <div class="card shadow" style="background-color:rgb(145, 4, 46);">
                <div class="card-body">
                <h5 class="card-title" style="color:rgb(255, 80, 217); font-size: 30px; font-weight: bold;">Réçu(s)</h5>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-copy"></i> {{$nbr_recu_receptionist}}</p>
                <a href="{{route('listeMyRecu')}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i> Voir </a>
                </div>
            </div>
            </div>
            <div class="col-sm-6">
            <div class="card shadow" style="background-color:rgb(85, 6, 68);">
                <div class="card-body">
                <h5 class="card-title" style="color:rgb(250, 5, 136); font-size: 30px; font-weight: bold;">Vêtement(s)</h5>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-person-arrow-down-to-line"></i> {{$vetement_receptionists}}</p>
                <a href="{{route('indexMyRecept')}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i> Voir </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--fin block receptionist -->
@endif


@if (Auth::user()->role == "laveur")
<!--debut block laveur -->

<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card shadow m-2" style="background-color:rgb(0, 0, 2);">
            <div class="card-body">
            <h5 class="card-title" style="color:rgb(178, 178, 178); font-size: 30px; font-weight: bold;">Tache(s) en attente(s)</h5>
            <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-hand-spock"></i> {{$nbr_tache_laveur_attente}}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12" >
        <div class="card shadow m-2" style="background-color:rgb(25, 6, 91);">
            <div class="card-body">
            <h5 class="card-title" style="color:rgb(118, 80, 255); font-size: 30px; font-weight: bold;">Tache(s) effectuée(s)</h5>
            <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-file-invoice"></i> {{$nbr_tache_laveur_effectuer}}</p>
            </div>
        </div>
    </div>

</div>

<!--fin block laveur -->
@endif



@if (Auth::user()->role == "repasseur")
<!--debut block repasseur -->

<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card shadow m-2" style="background-color:rgb(0, 0, 2);">
            <div class="card-body">
            <h5 class="card-title" style="color:rgb(178, 178, 178); font-size: 30px; font-weight: bold;">Tache(s) en attente(s)</h5>
            <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-hand-spock"></i> {{$nbr_tache_repasseur_attente}}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12" >
        <div class="card shadow m-2" style="background-color:rgb(25, 6, 91);">
            <div class="card-body">
            <h5 class="card-title" style="color:rgb(118, 80, 255); font-size: 30px; font-weight: bold;">Tache(s) effectuée(s)</h5>
            <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-file-invoice"></i> {{$nbr_tache_repasseur_effectuer}}</p>
            </div>
        </div>
    </div>

</div>

<!--fin block repasseur -->
@endif




@if (Auth::user()->role == "livreur")
<!--debut block livreur -->

<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card shadow m-2" style="background-color:rgb(0, 0, 2);">
            <div class="card-body">
            <h5 class="card-title" style="color:rgb(178, 178, 178); font-size: 30px; font-weight: bold;">Tache(s) en attente(s)</h5>
            <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-hand-spock"></i> {{$nbr_tache_livreur_attente}}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12" >
        <div class="card shadow m-2" style="background-color:rgb(25, 6, 91);">
            <div class="card-body">
            <h5 class="card-title" style="color:rgb(118, 80, 255); font-size: 30px; font-weight: bold;">Tache(s) effectuée(s)</h5>
            <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-file-invoice"></i> {{$nbr_tache_livreur_effectuer}}</p>
            </div>
        </div>
    </div>

</div>

<!--fin block livreur -->
@endif



@if (Auth::user()->role == "gerant")
<!--debut block gerant -->

<div class="container text-center">

    <div class="row m-2">
        <div class="col">
            <div class="card shadow mt-2" style="background-color:rgb(236, 236, 236);">
                <div class="card-body">
                    <h6 class="card-title" style="color:rgb(36, 36, 36); font-size: 30px; font-weight: bold;">Profit du jour</h6>
                    <p class="card-text text-center" style="color:rgb(7, 208, 155); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-money-bill"></i> <span style="color:rgb(93, 93, 93); font-size: 80px; font-weight: bold;">{{$profit}}</span> <span style="color:rgb(93, 93, 93); font-size: 20px;"> Frs </span> </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-4 m-2">
        <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
            <div class="card shadow" style="background-color:rgb(0, 0, 2);  height: 100%;">
                <div class="card-body">
                <h6 class="card-title" style="color:rgb(178, 178, 178); font-size: 30px; font-weight: bold;">Tache(s) exécutée(s)</h6>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-hand-spock"></i> {{$nbr_tache_gerant_effectuees}}</p>
                <a href="{{route('indexAllTache')}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i> Voir </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
            <div class="card shadow" style="background-color:rgb(25, 6, 91); height: 100%;">
                <div class="card-body">
                <h6 class="card-title" style="color:rgb(118, 80, 255); font-size: 30px; font-weight: bold;">Tache(s) en attente(s)</h6>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-hand-spock"></i> {{$nbr_tache_gerant_attente}}</p>
                <a href="{{route('indexAllTache')}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i> Voir </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
            <div class="card shadow" style="background-color:rgb(145, 4, 46); height: 100%;">
                <div class="card-body">
                <h6 class="card-title" style="color:rgb(255, 80, 217); font-size: 30px; font-weight: bold;">Livraison(s)</h6>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-truck"></i> {{$nbr_livraison_gerant}}</p>
                <a href="{{route('ListeLivraison')}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i> Voir </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
            <div class="card shadow" style="background-color:rgb(85, 6, 68); height: 100%;">
                <div class="card-body">
                <h6 class="card-title" style="color:rgb(250, 5, 136); font-size: 30px; font-weight: bold;">Employer(s)</h6>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-users-gear"></i> {{$nbr_employers}}</p>
                <a href="{{route('listeEmployers')}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i> Voir </a>
                </div>
            </div>
        </div>

    </div>

    <div class="row row-cols-4 m-2">

        <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
            <div class="card shadow" style="background-color:rgb(25, 6, 91); height: 100%;">
                <div class="card-body">
                <h6 class="card-title" style="color:rgb(118, 80, 255); font-size: 30px; font-weight: bold;">Facture(s) reglée(s)</h6>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"> <i class="fa-solid fs-10 fa-file-invoice-dollar"></i> {{$nbr_facture_gerant_regler}}</p>
                <a href="{{route('listeAllFacture')}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i> Voir </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
            <div class="card shadow" style="background-color:rgb(145, 4, 46); height: 100%;">
                <div class="card-body">
                <h6 class="card-title" style="color:rgb(255, 80, 217); font-size: 30px; font-weight: bold;">Facture(s) non regler</h6>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-file-invoice"></i> {{$nbr_facture_gerant_non_regler}}</p>
                <a href="{{route('listeAllFacture')}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i> Voir </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
            <div class="card shadow" style="background-color:rgb(85, 6, 68); height: 100%;">
                <div class="card-body">
                <h6 class="card-title" style="color:rgb(250, 5, 136); font-size: 30px; font-weight: bold;">Vêtement(s) receptionné(s)</h6>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-shirt"></i> {{$nbr_vetement_gerant}}</p>
                <a href="{{route('indexAllRecept')}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i> Voir </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
            <div class="card shadow" style="background-color:rgb(0, 0, 0); height: 100%;">
                <div class="card-body">
                <h6 class="card-title" style="color:rgb(178, 178, 178); font-size: 30px; font-weight: bold;">Client(s)</h6>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-users-between-lines"></i> {{$nbr_client}}</p>
                <a href="{{route('gerantListeClient')}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i> Voir </a>
                </div>
            </div>
        </div>

    </div>

</div>

<!--fin block gerant -->
@endif




@if (Auth::user()->role == "client")
<!--debut block client -->

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
            <div class="card shadow" style="background-color:rgb(0, 119, 143);">
                <div class="card-body">
                <h5 class="card-title" style="color:rgb(152, 227, 255); font-size: 30px; font-weight: bold;">Facture(s)</h5>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"><i class="fa-solid fs-10 fa-file-invoice"></i> {{$nbr_factures}}</p>
                <a href="{{route('listeMyFacture')}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i>Voir</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
            <div class="card shadow" style="background-color:rgb(0, 0, 2);">
                <div class="card-body">
                <h5 class="card-title" style="color:rgb(178, 178, 178); font-size: 30px; font-weight: bold;">Vêtement(s)</h5>
                <p class="card-text text-center" style="color:rgb(255, 255, 255); font-size: 60px; font-weight: bold;"> <i class="fa-solid fs-10 fa-shirt"></i> {{$nbr_vetements}}</p>
                <a href="{{route('indexMyRecept')}}" class="btn btn-dark"><i class="fa-solid fa-eye"></i>Voir</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--fin block client -->
@endif




@endauth

@endsection
