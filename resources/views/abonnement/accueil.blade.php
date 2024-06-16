@extends('layouts/auth')
@section('title',"liste gérants")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<div class="text-center rounded-2 shadow mt-5" style="color:rgb(246, 246, 246); background-color:rgb(3, 3, 31); padding: 5px;">
    <h2 style="color:rgb(255, 255, 255);">INFORMATIONS SUR MON ABONNEMENT</h2>
    <a class="btn" href="{{route('reabonnerGerants')}}" style="color:rgb(245, 245, 245); background-color: rgb(63, 10, 141); padding: 10px;"> Renouvéler mon abonnement </a>
</div>

<div class="row mt-5">
    <div class="col-lg-6 col-md-6 col-sm-12" >
        <div class="card shadow mt-2" style="width: 100%; height: 100%;">
            <div class="card-body">
                <h2 style="background-color:rgb(9, 9, 75); border-left: 20px solid rgb(11, 137, 255); color: rgb(11, 137, 255); padding: 10px;" >{{ $infos_abonnement->nom_formule }}</h2>
                <p><strong>Le prix : </strong>{{ $infos_abonnement->prix_formule }} Francs CFA</p>
                <p><strong>Durée : </strong>{{ $infos_abonnement->periode }} Jours</p>
                <p><strong>Nombre d'utilisateur : </strong>{{ $infos_abonnement->nbr_user }} au maximum</p>
                <p><strong>Nombre d'éssai : </strong>{{ $infos_abonnement->nbr_essai }}</p>
                <p><strong>Fonctionnalités : </strong></p>
                <p class="card-text" style="color:white; background-color:rgb(1, 3, 4); border-radius: 5px; padding:7px; ">{!! nl2br(e($infos_abonnement->fonctionnalite)) !!}</p>
                <p><strong>Etat : </strong>
                    @if($etat_formule=="DISPONIBLE") <span style="color:rgb(247, 247, 247); background-color:rgb(53, 70, 224); border-radius: 5px; padding: 5px; font-weight: bold;"> {{ $etat_formule }} </span> @endif
                    @if($etat_formule=="INDISPONIBLE") <span style="color:rgb(247, 247, 247); background-color:rgb(101, 101, 101); border-radius: 5px; padding: 5px; font-weight: bold;"> {{ $etat_formule }} </span> @endif
                    @if($etat_formule=="EN COURS...") <span style="color:rgb(247, 247, 247); background-color:rgb(3, 164, 5); border-radius: 5px; padding: 5px; font-weight: bold;"> {{ $etat_formule }} </span> @endif
                </p>
                <p><strong>Fin de souscription : </strong> <span style="color: red; font-weight: bold;">{{ $infos_user->fin_souscription }}</span></p>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12" >
        <div class="card shadow mt-2" style="width: 100%; height: 100%;">
            <div class="card-body">
                <h2 style="background-color:rgb(9, 9, 75); color: rgb(11, 137, 255); text-align: center; padding: 10px;">Nombre de jours restants</h2>
                <div style="background-color: rgb(3, 85, 117); color: white; text-align: center;">
                    <p style="font-size: 150px; font-weight: bold; padding: 10px;">{{ $time_reste->format('%a') }}</p>
                    <p  style="font-size: 37px;">Jour(s)</p>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
