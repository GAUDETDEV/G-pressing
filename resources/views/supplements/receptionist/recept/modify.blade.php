@extends('layouts/auth')
@section('title',"formulaire de modification")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<form action="{{route('receptionistPutVetReceptSupplement',["vetement_supplement" => $vetement_supplement->id])}}" method="POST" class="container shadow rounded-3 mt-4" style="width:60%; margin-top:5%; padding: 2em; background-color: rgb(255, 255, 255);">

    <h1 class="modal-title fs-5 mt-2" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">MODIFICATION DE VÊTEMENTS DE LA FACTURE N° {{$vetement_supplement->id_facture}}</h1>

        @method('put')
        @csrf

        <label for="" class="form-label mt-3" style="color:rgb(81, 9, 119); font-weight: bold;">Nom du vêtement</label>
        <select class="form-select mt-3" name="nom_vet" id="">
            <option value="{{$vetement_supplement->nom_vet}}">{{$vetement_supplement->nom_vet}}</option>
            @forelse ($other_vetements as $other_vetement)
            <option value="{{$other_vetement->nom_vet}}">{{$other_vetement->nom_vet}}</option>
            @empty
            <p class="text-center"><strong class="text-danger"> La liste des vêtements est vite! <strong></p>
            @endforelse
        </select>

        <label for="" class="form-label mt-3" style="color:rgb(81, 9, 119); font-weight: bold;">Spécification</label>
        <select class="form-select mt-3" name="caract_vet" id="">
            <option value="{{$vetement_supplement->caract_vet}}">{{$vetement_supplement->caract_vet}}</option>
            @forelse ($other_specificats as $other_specificat)
            <option value="{{$other_specificat->nom_specification_vet}}">{{$other_specificat->nom_specification_vet}}</option>
            @empty
            <p class="text-center"><strong class="text-danger"> La liste des spécifications est vite! <strong></p>
            @endforelse
        </select>

        <label for="" class="form-label mt-3" style="color:rgb(81, 9, 119); font-weight: bold;">Qualité du textile</label>
        <select class="form-select mt-3" name="quality_vet" id="">
            <option value="{{$vetement_supplement->quality_vet}}">{{$vetement_supplement->quality_vet}}</option>
            @forelse ($other_qualities as $other_quality)
            <option value="{{$other_quality->nom}}">{{$other_quality->nom}}</option>
            @empty
            <p class="text-center"><strong class="text-danger"> La liste des qualités est vite! <strong></p>
            @endforelse
        </select>

        <label for="" class="form-label mt-3" style="color:rgb(81, 9, 119); font-weight: bold;">La couleur</label>
        <select class="form-select mt-3" name="color_vet" id="">
            <option value="{{$vetement_supplement->color_vet}}">{{$vetement_supplement->color_vet}}</option>
            @forelse ($other_colors as $other_color)
            <option value="{{$other_color->nom_couleur_vet}}">{{$other_color->nom_couleur_vet}}</option>
            @empty
            <p class="text-center"><strong class="text-danger"> La liste des couleurs est vite! <strong></p>
            @endforelse
        </select>

        <label for="" class="form-label mt-3" style="color:rgb(81, 9, 119); font-weight: bold;">La quantité</label>
        <input type="number" class="form-control mt-3" name="qte_vet" value="{{ $vetement_supplement->qte_vet }}">
        @if ($errors)
        @error('qte_vet')
            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
        @enderror
        @endif

        <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Mettre à jour</button>
        <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

</form>

@endsection
