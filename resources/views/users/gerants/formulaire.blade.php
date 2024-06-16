@extends('layouts/auth')
@section('title',"formulaire d'ajout")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut formulaire d'ajout gerants-->

<div class="container">

    <form action="{{route('postGerant',['formule'=>$formule->id])}}" method="POST" enctype="multipart/form-data" class="container shadow rounded-3" style="width:90%; margin-top:5%; padding: 5em; background-color: rgb(255, 255, 255);">
        <h1 class="modal-title fs-5" id="modalAjoutGerantLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE GERANTS</h1>
        @method('post')
        @csrf

        <div class="row">

            <div class="col">

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

            <div class="col">

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

                <div class="mt-5">

                    <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer</button>
                    <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

                </div>

            </div>

        </div>


    </form>

</div>


<!--fin formulaire d'ajout gerants-->

@endsection
