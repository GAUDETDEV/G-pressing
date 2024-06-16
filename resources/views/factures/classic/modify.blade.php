@extends('layouts/auth')
@section('title',"factures classiques")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<div class="container">

    <form action="{{route('putFactureClassic',["facture" => $facture->id])}}" class="container shadow rounded-3" style="width:50%; margin-top:5%; padding: 5em; background-color: rgb(255, 255, 255);" method="POST">
        <h1 class="modal-title fs-5" id="modalAjoutGerantLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">MISE A JOUR DE FACTURE</h1>
        @method('put')
        @csrf

        <label for="" class="mt-3" style="color:rgb(58, 32, 60); font-weight: bold;">Titulaire</label>
        <input type="text" class="form-control mt-3" name="nom_titulaire" value="{{ $facture->nom_titulaire }}">
        @if ($errors)
        @error('nom_titulaire')
            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
        @enderror
        @endif

        <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Téléphone</label>
        <input type="text" class="form-control mt-3" name="tel_titulaire" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" value="{{ $facture->tel_titulaire }}">
        @if ($errors)
        @error('tel_titulaire')
            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
        @enderror
        @endif

        <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Mettre à jour </button>
        <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

    </form>
</div>

@endsection

