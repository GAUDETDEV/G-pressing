@extends('layouts/auth')
@section('title',"formulaire modification")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut formulaire de modification poste-->

<div class="container">

    <form action="{{route('putPoste',['poste' => $poste->id])}}" method="POST" class="container shadow rounded-3" style="width:50%; margin-top:5%; padding: 5em; background-color: rgb(255, 255, 255);">
        <h1 class="modal-title fs-5" id="modalAjoutGerantLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">MISE A JOUR DE POSTES</h1>
        @method('put')
        @csrf

        <label class="form-label mt-3" for="" style="color:rgb(68, 3, 147); font-weight: bold;">Titre du poste</label>
        <select class="form-select" name="titre_poste" id="">
            <option value="{{$poste->titre_poste}}">{{ $poste->titre_poste }}</option>
            @forelse ($other_postes as $other_poste)
                <option value = "{{$other_poste->titre_poste}}">{{ $other_poste->titre_poste }}</option>
            @empty
            <p style="color:rgb(217, 17, 17);">Désoler! mais c'est le seul poste de la liste</p>
            @endforelse
        </select>

        <label class="form-label" for="" style="color:rgb(68, 3, 147); font-weight: bold;">Description</label>
        <textarea class="form-control" name="desc_poste" id="" cols="30" rows="5">{{$poste->desc_poste}}</textarea>
        @if ($errors)
        @error('desc_poste')
            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
        @enderror
        @endif

        <label for="" style="color:rgb(68, 3, 147); font-weight: bold;">Salaire</label>
        <input type="number" class="form-control mt-3" name="salaire_poste" value="{{$poste->salaire_poste}}">
        @if ($errors)
        @error('salaire_poste')
            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
        @enderror
        @endif

        <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Mettre à jour</button>
        <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

    </form>

</div>

<!--fin formulaire de modification poste-->

@endsection
