@extends('layouts/auth')
@section('title',"réabonnement")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut formulaire de réabonnement gerants-->

<div class="container mt-5">

    <div class="row row-cols-1 row-cols-md-3 g-4">

        @forelse ($formules as $formule)
            <div class="col">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <h4 class="card-titles" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125);">{{$formule->nom_formule}}</h4>
                        <div class="card-text">
                            <p style="background-color:rgb(6, 76, 125); color:white; font-weight: bold; border-radius: 5px; padding:7px;"><strong>A seulement :</strong> <span style="font-size: 2em; color:rgb(166, 212, 245); font-weight: bold;">{{$formule->prix_formule}} Francs </span></p>
                            <p><strong>Avec un nombre d'utilisateurs :</strong> {{$formule->nbr_user}}</p>
                            <p><strong>Et un nombre d'essai :</strong> {{$formule->nbr_essai}}</p>
                            <p><strong>Pour une période de :</strong> {{$formule->periode}} jours d'utilisation.</p>
                            <p><strong>Proposant les fonctionnalités suivantes</strong></p>
                        </div>
                        <p class="card-text" style="color:white; background-color:rgb(6, 76, 125); border-radius: 5px; padding:7px; width: 100%; height:60%;">{!! nl2br(e($formule->fonctionnalite)) !!}</p>
                    </div>
                    <div class="card-footer mt-5">

                    <a href="{{route('reabonnerRecapGerant',['formule' => $formule->id])}}" type="button" class="btn btn-primary mt-5">
                        Se réabonner?
                    </a>

                    <p class="text-body-secondary"><small> Last updated 3 mins ago </small></p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center" style="color:rgb(151, 37, 19); padding: 5px; background-color:rgb(218, 161, 147); font-weight: bold;">Aucune formule disponible pour le moment!</p>
        @endforelse


    </div>

</div>


<!--fin formulaire de réabonnement gerants-->

@endsection
