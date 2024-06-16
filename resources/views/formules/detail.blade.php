@extends('layouts/auth')
@section('title',"detail")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut affichage d'informations formule-->

<div class="container mt-3">

    <div class="text-center rounded-2 shadow" style="color:rgb(246, 246, 246); background-color:rgb(9, 9, 75); padding: 5px;">
        <h2 style="color:rgb(255, 255, 255);">INFORMATIONS GENERALES SUR LA FORMULE</h2>
    </div>

    <div class="row">

        <div class="col">
            <div class="card shadow mt-4">
                <h3 class="card-header" style="color:rgb(14, 14, 170);">{{ $formule->nom_formule }}</h3>
                <div class="card-body">

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12">


                            <p><strong>Nom de la formule : </strong>{{ $formule->nom_formule }}</p>
                            <p><strong>Le prix : </strong>{{ $formule->prix_formule }} Franc(s)</p>
                            <p><strong>Nombre d'utilisateurs possible: </strong>{{ $formule->nbr_user }} Maximum</p>
                            <p><strong>Nombre d'essais possible : </strong>{{ $formule->nbr_essai }} </p>
                            <p><strong>Fonctionnalités disponible : </strong></p>
                            <p class="card-text" style="color:rgb(240, 238, 245); background-color:rgb(9, 9, 75); border-radius: 5px; padding:7px; width: 100%;">{!! nl2br(e( $formule->fonctionnalite)) !!}</p>

        <!--debut option de modification de l'etat de la formule-->

                            <form class="justify-center" action="{{route('putEtatFormule',['formule'=>$formule->id])}}" method="POST">
                                @method('put')
                                @csrf
                                <label for=""><p><strong>Etat : </strong></p></label>
                                <select name="id_etat_formule" id="id_etat_formule">
                                    <option value="{{ $formule->id_etat_formule }}">{{ $info_etat_formule->nom_etat_formule }}</option>
                                    @forelse ($other_etat_formules as $other_etat_formule)
                                    <option value="{{ $other_etat_formule->id }}"> {{ $other_etat_formule->nom_etat_formule }} </option>
                                    @empty
                                        <p style="color:rgb(217, 17, 17);">Désoler! mais la liste des états est vide!</p>
                                    @endforelse
                                </select>
                                <button class="btn" type="submit2" style="color: white; background-color: rgb(8, 95, 121);">changer</button>
                            </form>

        <!--fin option de modification de l'etat de la formule-->


                        </div>


                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card shadow" style="background-color: rgb(0, 105, 143); font-size: 2em;">
                                <h3 class="card-header text-center" style="color:rgb(255, 255, 255);">Abonné(s)</h3>
                                <div class="card-body text-center" style="border-top: solid 5px rgb(255, 255, 255);">
                                    <strong style="color: rgb(255, 255, 255); font-size: 2em;" >{{ count($result_users) }}</strong>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!--fin affichage d'informations formule-->

@endsection
