@extends('layouts/index')
@section('title',"formulaire suscription")

@section('content')

<div class="text-center mt-5">
    @if (session('message'))
    <strong  style="padding: 15px; border-radius: 6px; color: rgb(210, 237, 246); background-color:rgb(7, 61, 169);">{{ session('message') }}</strong>
    @endif
</div>

<style>

/* definition du style du titre du frormulaire */

    @keyframes typing {
    from {
        width: 0;
    }
    to {
        width: 80%;
    }
    }

    .typing-text {
    color: rgb(0, 105, 143);
    text-decoration: underline;
    overflow: hidden;
    white-space: nowrap;
    border-right: 3px solid;
    width: 0;
    animation: typing 4s steps(30, end) forwards;
    }


</style>


<!--debut formulaire d'ajout gerants-->

<div class="container mt-5">

    <form action="{{route('postSuscribe',['formule'=>$formule->id])}}" method="POST" enctype="multipart/form-data" class="container shadow rounded-3" style="width:70%; padding: 2em; background-color: rgb(255, 255, 255);">

        <h1 class="typing-text" >FORMULAIRE DE SOUSCRIPTION</h1>

        @method('post')
        @csrf

        <div class="row mt-5">

            <legend style="color:rgb(119, 0, 63);" >Informations personnelles</legend>

            <div class="col-lg-6 col-md-6 col-sm-12">

                <input type="text" class="form-control mt-3" name="name" placeholder="Nom">
                @if ($errors)
                @error('name')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <input type="tel" class="form-control mt-3" name="telephone" placeholder="Téléphone" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}">
                @if ($errors)
                @error('telephone')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <input type="text" class="form-control mt-3" name="lieu_habitation" placeholder="Lieu d'habitation">
                @if ($errors)
                @error('lieu_habitation')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <input type="text" class="form-control mt-3" name="adresse" placeholder="Indiquez une adresse">
                @if ($errors)
                @error('adresse')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <div class="mt-3">
                    <strong style="color:rgb(4, 96, 216);">Civilité</strong><br>
                    <input type="radio" checked = "checked" id="Mr" name="civilite" value="Mr">
                    <label class="form-label" for="Mr">Monsieur</label><br>
                    <input type="radio" id="Mme" name="civilite" value="Mme">
                    <label class="form-label" for="Mme">Madamme</label><br>
                    <input type="radio" id="Mlle" name="civilite" value="Mlle">
                    <label class="form-label" for="Mlle">Mademoiselle</label>
                </div>
                @if ($errors)
                @error('civilite')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">

                <input type="email" class="form-control mt-3" name="email" placeholder="Email">
                @if ($errors)
                @error('email')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <input type="text" class="form-control mt-3" name="entreprise" placeholder="Entreprise">
                @if ($errors)
                @error('entreprise')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <input type="password" class="form-control mt-3" name="password" placeholder="Mot de passe">
                @if ($errors)
                @error('password')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <p class="text-primary mt-4">Choissez une photo de profil</p>

                <input type="file" class="form-control" name="photo">
                @if ($errors)
                @error('photo')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

            </div>

        </div>


        <div class="row mt-5">

            <legend style="color:rgb(119, 0, 63);">Informations sur l'abonnement</legend>

            <fieldset disabled>

                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label" style="color:rgb(21, 1, 1); font-weight: bold;">Type d'abonnement</label>
                    <input type="text" id="disabledTextInput" class="form-control" value="{{$formule->nom_formule}}">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label" style="color:rgb(21, 1, 1); font-weight: bold;">La durée de l'abonnement</label>
                    <input type="text" id="disabledTextInput" class="form-control" value="{{$formule->periode}} Jours">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label" style="color:rgb(21, 1, 1); font-weight: bold;">Nombre d'utilisateurs</label>
                    <input type="text" id="disabledTextInput" class="form-control" value="{{$formule->nbr_user}} Utilisateurs">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label" style="color:rgb(21, 1, 1); font-weight: bold;">Nombre d'éssais</label>
                    <input type="text" id="disabledTextInput" class="form-control" value="{{$formule->nbr_essai}}">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label" style="color:rgb(21, 1, 1); font-weight: bold;">Le prix</label>
                    <input type="text" id="disabledTextInput" class="form-control" value="{{$formule->prix_formule}} Francs">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label" style="color:rgb(21, 1, 1); font-weight: bold;">Les fonctionnalités disponibles</label>
                    <textarea id="disabledTextInput" cols="30" rows="10" class="form-control">{{$formule->fonctionnalite}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label" style="color:rgb(21, 1, 1); font-weight: bold;">Fin de l'abonnement</label>
                    @if ($formule->nom_formule === "Free")
                    <input type="text" id="disabledTextInput" class="form-control" value="{{ date("Y/m/d",strtotime('+14 days'))}}">
                    @else
                    <input type="text" id="disabledTextInput" class="form-control" value="{{ date("Y/m/d",strtotime('+1 month'))}}">
                    @endif
                </div>

            </fieldset>

            <div class="mt-5">

                <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-check fa-bounce"></i> Je valide</button>
                <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

            </div>


        </div>


    </form>

</div>


<!--fin formulaire d'ajout gerants-->

@endsection
