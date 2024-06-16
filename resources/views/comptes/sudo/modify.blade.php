@extends('layouts/auth')
@section('title',"modifier compte")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut formulaire de modification gerant-->

<div class="container">

    <form action="{{route('putCompteSudo',['sudo' => $sudo->id])}}" method="POST" enctype="multipart/form-data" class="container shadow rounded-3" style="width: 100%; margin-top:5%; padding: 2em; background-color: rgb(255, 255, 255);">
        <h1 class="modal-title fs-5" id="modalAjoutGerantLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">MISE A JOUR DE MES INFORMATIONS</h1>
        @method('put')
        @csrf

        <div class="row">

            <div class="col">

                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Nom</label>
                <input type="text" class="form-control" name="name" value="{{$sudo->name}}">
                @if ($errors)
                @error('name')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Email</label>
                <input type="email" class="form-control" name="email" value="{{$sudo->email}}">
                @if ($errors)
                @error('email')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Téléphone</label>
                <input type="tel" class="form-control" name="telephone" value="{{$sudo->telephone}}">
                @if ($errors)
                @error('telephone')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Habitation</label>
                <input type="text" class="form-control" name="lieu_habitation" value="{{$sudo->lieu_habitation}}">
                @if ($errors)
                @error('lieu_habitation')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Adresse</label>
                <input type="text" class="form-control" name="adresse" value="{{$sudo->adresse}}">
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

                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Entreprise</label>
                <input type="text" class="form-control" name="entreprise" value="{{$sudo->entreprise}}">
                @if ($errors)
                @error('entreprise')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Fin souscription</label>
                <input type="date" class="form-control" name="fin_souscription" value="{{$sudo->fin_souscription}}">
                @if ($errors)
                @error('fin_souscription')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif


                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Type de formule</label>
                <select class="form-select" name="id_formule" id="">

                    <option value="{{$formule->id}}">{{$formule->nom_formule}}</option>

                    @foreach ($other_formules as $other_formule)
                        <option value="{{$other_formule->id}}">{{$other_formule->nom_formule}}</option>
                    @endforeach

                </select>

                <div class="mt-3">

                    @if ($sudo->photo)

                    <img src="{{ asset('storage/'.$sudo->photo) }}" alt="Photo de profil" style="width: 15rem; height: 15rem; text-align: center; border-radius: 10px;">

                    @else

                    <img src="{{ asset('https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg')}}" alt="" style="width: 15rem; height: 15rem; text-align: center; border-radius: 10px;">

                    @endif

                    <p class="text-primary">Photo actuelle de profile</p>

                    <input type="file" class="form-control" name="photo" value="{{$sudo->photo}}">
                    @if ($errors)
                    @error('photo')
                        <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                    @enderror
                    @endif

                </div>


                <div class="mt-3">

                    <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Mettre à jour</button>
                    <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

                </div>


            </div>


        </div>

    </form>

</div>

<!--fin formulaire de modification gerant-->

@endsection
