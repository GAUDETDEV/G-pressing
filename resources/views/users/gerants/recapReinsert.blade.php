@extends('layouts/auth')
@section('title',"recapAbonnement")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut formulaire de réabonnement gerants-->

<div class="container">

    <div class="container">

        <div class="card shadow">
            <div class="card-header" style="color:rgb(6, 76, 125); border-bottom: solid 5px rgb(6, 76, 125);"><h3>RECAPITULATIF DE L'ABONNEMENT</h3></div>
            <div class="card-body">

                <form action="{{route('reabonnerPutGerant',['gerant' => $user_auth->id])}}"  method="POST" >

                    @csrf
                    @method("put")

                        <div class="row">

                            <div class="col">
                                <div class="mb-3">
                                    <input type="text" class="d-none" name="id_formule" class="form-control" value="{{$formule->id}}">
                                    <input type="text" class="d-none" name="id_etat_user" class="form-control" value="2">
                                </div>
                                <fieldset disabled>
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label">Type d'abonnement</label>
                                    <input type="text" id="disabledTextInput" class="form-control" value="{{$formule->nom_formule}}">
                                </div>
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label">La durée de l'abonnement</label>
                                    <input type="text" id="disabledTextInput" class="form-control" value="{{$formule->periode}} Jours">
                                </div>
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label">Nombre d'utilisateurs</label>
                                    <input type="text" id="disabledTextInput" class="form-control" value="{{$formule->nbr_user}} Utilisateurs">
                                </div>
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label">Nombre d'éssais</label>
                                    <input type="text" id="disabledTextInput" class="form-control" value="{{$formule->nbr_essai}}">
                                </div>
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label">Le prix</label>
                                    <input type="text" id="disabledTextInput" class="form-control" value="{{$formule->prix_formule}} Francs / mois">
                                </div>
                            </fieldset>
                            </div>

                            <div class="col">

                                <fieldset disabled>
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label">Les fonctionnalités disponibles</label>
                                    <textarea id="disabledTextInput" cols="30" rows="10" class="form-control">{{$formule->fonctionnalite}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label">Fin de l'abonnement</label>
                                    <input type="text" id="disabledTextInput" class="form-control" value="{{ date("Y/m/d",strtotime('+1 month'))}}">
                                </div>
                                </fieldset>

                            </div>

                        </div>



                    <div class="mt-4">
                        <button type="submit" class="btn" style="color:white; background-color:rgb(6, 76, 125);"><i class="fa-solid fa-check fa-bounce"></i> Je valide</button>
                        <button type="reset" class="btn" style="color:white; background-color:rgb(6, 96, 57);"><i class="fa-solid fa-rotate-left"></i> J'annule</button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


<!--fin formulaire de réabonnement gerants-->

@endsection
