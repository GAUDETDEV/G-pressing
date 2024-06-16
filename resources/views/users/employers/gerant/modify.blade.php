@extends('layouts/auth')
@section('title',"formulaire modification")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut formulaire de modification employers-->

<div class="container">

    <form action="{{route('putEmployer',['employer' => $employer->id])}}" method="POST" enctype="multipart/form-data" class="container shadow rounded-3" style="width: 100%; margin-top:5%; padding: 2em; background-color: rgb(255, 255, 255);">
        <h1 class="modal-title fs-5" id="modalAjoutGerantLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">MISE A JOUR D'EMPLOYERS</h1>
        @method('put')
        @csrf

        <div class="row">

            <div class="col">

                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Nom</label>
                <input type="text" class="form-control" name="name" value="{{$employer->name}}">
                @if ($errors)
                @error('name')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Email</label>
                <input type="email" class="form-control" name="email" value="{{$employer->email}}">
                @if ($errors)
                @error('email')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Téléphone</label>
                <input type="tel" class="form-control" name="telephone" value="{{$employer->telephone}}" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}">
                @if ($errors)
                @error('telephone')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Habitation</label>
                <input type="text" class="form-control" name="lieu_habitation" value="{{$employer->lieu_habitation}}">
                @if ($errors)
                @error('lieu_habitation')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

            </div>

            <div class="col">

                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Adresse</label>
                <input type="text" class="form-control" name="adresse" value="{{$employer->adresse}}">
                @if ($errors)
                @error('adresse')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Entreprise</label>
                <input type="text" class="form-control" name="entreprise" value="{{$employer->entreprise}}">
                @if ($errors)
                @error('entreprise')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Prise de fonction</label>
                <input type="date" class="form-control" name="debut_poste" value="{{$employer->debut_poste}}">
                @if ($errors)
                @error('debut_poste')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color:rgb(68, 3, 147); font-weight: bold;">Arrêt de fonction</label>
                <input type="date" class="form-control" name="fin_poste" value="{{$employer->fin_poste}}">
                @if ($errors)
                @error('fin_poste')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

            </div>

            <div class="col text-center mt-3">


                @if ($employer->photo)

                <img src="{{ asset('storage/'.$employer->photo) }}" alt="Photo de profil" style="width: 15rem; height: 15rem; text-align: center; border-radius: 10px;">

                @else

                <img src="{{ asset('https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg')}}" alt="" style="width: 15rem; height: 15rem; text-align: center; border-radius: 10px;">

                @endif

                <p class="text-primary">Photo actuelle de profile</p>

                <input type="file" class="form-control" name="photo" value="{{$employer->fin_poste}}">
                @if ($errors)
                @error('photo')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif


            </div>




        </div>

        <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Mettre à jour</button>
        <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

    </form>

</div>

<!--fin formulaire de modification employers-->

@endsection
