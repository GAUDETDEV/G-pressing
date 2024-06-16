@extends('layouts/auth')
@section('title',"formulaire de modification")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut formulaire d'ajout clients-->

<div class="container">

    <form action="{{route('receptionistPutClient',['client' => $client->id])}}" method="POST" enctype="multipart/form-data" class="container shadow rounded-3" style="width:100%; margin-top:5%; padding: 3em; background-color: rgb(255, 255, 255);">
        <h1 class="modal-title fs-5" id="modalAjoutGerantLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">MISE A JOUR DE CLIENTS</h1>
        @method('put')
        @csrf

        <div class="row mt-3">

            <div class="col">

                <label class="form-label mt-3" for="" style="color:rgb(4, 96, 216); font-weight: bold;">Nom</label>
                <input type="text" class="form-control" name="name" value ="{{$client->name}}">
                @if ($errors)
                @error('name')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label class="form-label mt-3" for="" style="color:rgb(4, 96, 216); font-weight: bold;">Adresse email</label>
                <input type="email" class="form-control" name="email" value ="{{$client->email}}">
                @if ($errors)
                @error('email')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label class="form-label mt-3" for="" style="color:rgb(4, 96, 216); font-weight: bold;">Téléphone</label>
                <input type="tel" class="form-control" name="telephone" value ="{{$client->telephone}}" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}">
                @if ($errors)
                @error('telephone')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label class="form-label mt-3" for="" style="color:rgb(4, 96, 216); font-weight: bold;">Habitation</label>
                <input type="text" class="form-control" name="lieu_habitation" value ="{{$client->lieu_habitation}}">
                @if ($errors)
                @error('lieu_habitation')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif


            </div>
            <div class="col">

                <label class="form-label mt-3" for="" style="color:rgb(4, 96, 216); font-weight: bold;">Adresse</label>
                <input type="text" class="form-control" name="adresse" value ="{{$client->adresse}}">
                @if ($errors)
                @error('adresse')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <div class="row mt-3">

                    <div class="col">
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

                        @if ($client->photo)

                        <img src="{{ asset('storage/'.$client->photo) }}" alt="Photo de profil" style="width: 12rem; height: 12rem; text-align: center; border-radius: 10px;">

                        @else

                        <img src="{{ asset('https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg')}}" alt="" style="width: 12rem; height: 12rem; text-align: center; border-radius: 10px;">

                        @endif

                        <strong style="color:rgb(4, 96, 216); font-weight: bold;" >Actuelle photo de profile</strong>

                    </div>

                </div>


                <label for="" class="form-label mt-3"><strong style="color:rgb(4, 96, 216); font-weight: bold;">Photo de profil</strong></label>
                <input type="file" class="form-control" name="photo">
                @if ($errors)
                @error('photo')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <div class="mt-5">
                    <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Mettre à jour </button>
                </div>

            </div>


        </div>


    </form>

</div>


<!--fin formulaire d'ajout clients-->

@endsection
