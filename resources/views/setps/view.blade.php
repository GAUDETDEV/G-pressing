@extends('layouts/auth')
@section('title',"view setp")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>


<h2 class="text-center" style="color:rgb(52, 11, 103);">LES ETAPES DE TRAITEMENT DE LA FACTURE N° {{$liste_facture->id}}</h2>


@if($liste_facture->id_service == "")

    <div class="mt-5 shadow p-2" style="background-color:rgb(49, 7, 85); border-radius: 5px;">

        @if ($liste_facture->etat_traitement == "Stockage")
        <div class="container">
            <p class="container text-white text-center fs-5 p-3" style="background-color:rgb(5, 158, 102); border-radius: 10px;">Vos vêtements sont prêts</p>
        </div>
        @endif


        @if ($liste_facture->etat_traitement == "Depot")
        <div class="row shadow mt-5" >
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">DEPÔT</h3>
                <p><i class="fa-solid fa-circle-down fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">LAVAGE</h3>
                <p><i class="fa-solid fa-jug-detergent fa-5x text-white"></i></p>
                <strong class="text-light">En attente <i class="fa-solid fa-hourglass-start fa-spin-pulse text-light"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">REPASSAGE</h3>
                <p><i class="fa-brands fa-cloudflare fa-5x text-white"></i></p>
                <strong class="text-light">En attente <i class="fa-solid fa-hourglass-start fa-spin-pulse text-light"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">STOCKAGE</h3>
                <p><i class="fa-solid fa-layer-group fa-5x text-white"></i></p>
                <strong class="text-light">En attente <i class="fa-solid fa-hourglass-start fa-spin-pulse text-light"></i></strong>
            </div>
        </div>
        @endif

        @if ($liste_facture->etat_traitement == "Lavage")
        <div class="row shadow">
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">DEPÔT</h3>
                <p><i class="fa-solid fa-circle-down fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">LAVAGE</h3>
                <p><i class="fa-solid fa-jug-detergent fa-5x text-white"></i></p>
                <strong class="text-primary">En cours <i class="fa-solid fa-spinner fa-spin-pulse text-primary"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">REPASSAGE</h3>
                <p><i class="fa-brands fa-cloudflare fa-5x text-white"></i></p>
                <strong class="text-light">En attente <i class="fa-solid fa-hourglass-start fa-spin-pulse text-light"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">STOCKAGE</h3>
                <p><i class="fa-solid fa-layer-group fa-5x text-white"></i></p>
                <strong class="text-light">En attente <i class="fa-solid fa-hourglass-start fa-spin-pulse text-light"></i></strong>
            </div>
        </div>
        @endif

        @if ($liste_facture->etat_traitement == "Repassage" and $liste_facture->etat_livraison == "Oui")
        <div class="row shadow" >
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">DEPÔT</h3>
                <p><i class="fa-solid fa-circle-down fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">LAVAGE</h3>
                <p><i class="fa-solid fa-jug-detergent fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">REPASSAGE</h3>
                <p><i class="fa-brands fa-cloudflare fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">LIVRAISON</h3>
                <p><i class="fa-solid fa-truck fa-5x text-white"></i></p>
                <strong class="text-light">En attente <i class="fa-solid fa-hourglass-start fa-spin-pulse text-light"></i></strong>
            </div>
        </div>
        @endif



        @if ($liste_facture->etat_traitement == "Repassage" and $liste_facture->etat_livraison == "Non")
        <div class="row shadow" >
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">DEPÔT</h3>
                <p><i class="fa-solid fa-circle-down fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">LAVAGE</h3>
                <p><i class="fa-solid fa-jug-detergent fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">REPASSAGE</h3>
                <p><i class="fa-brands fa-cloudflare fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">STOCKAGE</h3>
                <p><i class="fa-solid fa-layer-group fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
        </div>
        @endif

        @if ($liste_facture->etat_traitement == "Fin")
        <div class="container p-5" style="background-color:rgb(5, 158, 102); border-radius: 10px;">
            <p class="container text-white text-center fs-5 p-3"><i class="fa-solid fa-5x fa-face-smile fa-bounce"></i></p>
            <p class="container text-white text-center fs-2 p-3">Fin du processus! Nous vous remerçions pour votre fidélité! </p>
        </div>
        @endif


    </div>

    @else




    <!--pour les autres type de services-->
    <div class="mt-5 shadow p-2" style="background-color:rgb(49, 7, 85); border-radius: 5px;">


        @if ($liste_facture->etat_traitement == "Depot")
        <div class="row shadow">
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">DEPÔT</h3>
                <p><i class="fa-solid fa-circle-down fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">TRAITEMENT</h3>
                <p><i class="fa-solid fa-gears fa-5x text-white"></i></p>
                <strong class="text-primary">En cours <i class="fa-solid fa-spinner fa-spin-pulse text-primary"></i></strong>
            </div>
        </div>
        @endif

        @if ($liste_facture->etat_traitement == "Repassage" and $liste_facture->etat_livraison == "Oui")
        <div class="row shadow">
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">DEPÔT</h3>
                <p><i class="fa-solid fa-circle-down fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">TRAITEMENT</h3>
                <p><i class="fa-solid fa-gears fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">LIVRAISON</h3>
                <p><i class="fa-solid fa-truck fa-5x text-white"></i></p>
                <strong class="text-light">En attente <i class="fa-solid fa-hourglass-start fa-spin-pulse text-light"></i></strong>
            </div>
        </div>
        @endif


        @if ($liste_facture->etat_traitement == "Repassage" and $liste_facture->etat_livraison == "Non")
        <div class="row shadow">
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">DEPÔT</h3>
                <p><i class="fa-solid fa-circle-down fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">TRAITEMENT</h3>
                <p><i class="fa-solid fa-gears fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">STOCKAGE</h3>
                <p><i class="fa-solid fa-layer-group fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
        </div>
        @endif

        @if ($liste_facture->etat_traitement == "Lavage" and $liste_facture->etat_livraison == "Oui")
        <div class="row shadow">
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">DEPÔT</h3>
                <p><i class="fa-solid fa-circle-down fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">TRAITEMENT</h3>
                <p><i class="fa-solid fa-gears fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">LIVRAISON</h3>
                <p><i class="fa-solid fa-truck fa-5x text-white"></i></p>
                <strong class="text-light">En attente <i class="fa-solid fa-hourglass-start fa-spin-pulse text-light"></i></strong>
            </div>
        </div>
        @endif


        @if ($liste_facture->etat_traitement == "Lavage" and $liste_facture->etat_livraison == "Non")
        <div class="row shadow">
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">DEPÔT</h3>
                <p><i class="fa-solid fa-circle-down fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">TRAITEMENT</h3>
                <p><i class="fa-solid fa-gears fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
            <div class="col text-center">
                <h3 style="color:rgb(19, 193, 215);">STOCKAGE</h3>
                <p><i class="fa-solid fa-layer-group fa-5x text-white"></i></p>
                <strong class="text-success">Terminer <i class="fa-solid fa-circle-check text-success"></i></strong>
            </div>
        </div>
        @endif


        @if ($liste_facture->etat_traitement == "Fin" and $liste_facture->etat_livraison == "Oui")
        <div class="row shadow">
            <div class="col text-center">
                <div class="container p-5" style="background-color:rgb(5, 158, 102); border-radius: 10px;">
                    <p class="container text-white text-center fs-5 p-3"><i class="fa-solid fa-5x fa-face-smile fa-bounce"></i></p>
                    <p class="container text-white text-center fs-2 p-3">Fin du processus! Nous vous remerçions pour votre fidélité! </p>
                </div>
            </div>
        </div>
        @endif

    </div>

@endif


@endsection
