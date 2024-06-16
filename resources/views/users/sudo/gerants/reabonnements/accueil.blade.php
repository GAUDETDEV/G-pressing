@extends('layouts/auth')
@section('title',"liste formules")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut card d'afficahge de formules-->

<div class="row row-cols-1 row-cols-md-3 g-4 mt-4">

    @forelse ( $liste_formules as $liste_formule)
        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h4 class="card-titles" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125);">{{$liste_formule->nom_formule}}</h4>
                    <div class="card-text">
                        <p style="background-color:rgb(6, 76, 125); color:white; font-weight: bold; border-radius: 5px; padding:7px;"><strong>A seulement :</strong> <span style="font-size: 2em; color:rgb(166, 212, 245); font-weight: bold;">{{$liste_formule->prix_formule}} Francs </span></p>
                        <p><strong>Avec un nombre d'utilisateurs :</strong> {{$liste_formule->nbr_user}}</p>
                        <p><strong>Et un nombre d'essai :</strong> {{$liste_formule->nbr_essai}}</p>
                        <p><strong>Pour une période de :</strong> {{$liste_formule->periode}} jours d'utilisation.</p>
                        <p><strong>Proposant les fonctionnalités suivantes :</strong></p>
                    </div>
                    <p class="card-text" style="color:white; background-color:rgb(6, 76, 125); border-radius: 5px; padding:7px; width: 100%; height:55%;">{!! nl2br(e($liste_formule->fonctionnalite)) !!}</p>
                </div>
                <div class="card-footer mt-5">

                <a href="{{route('formReinsertGerants',['formule' => $liste_formule->id,])}}" type="button" class="btn mt-5" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(26, 12, 87);"><i class="fa-solid fa-arrows-down-to-line"></i> Réabonner </a>

                </div>
            </div>
        </div>
    @empty
        <p class="text-center" style="color:rgb(151, 37, 19); padding: 5px; background-color:rgb(218, 161, 147);">La liste des formules est vide!</p>
    @endforelse

</div>

<!--fin card d'afficahge de formules-->

@endsection
