@extends('layouts/auth')
@section('title',"formulaire de modification")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut formulaire d'ajout vet-->

<div class="container">

    <form action="{{route('putVet',['vetement' => $vetement->id])}}" method="POST" class="container shadow rounded-3" style="width:50%; margin-top:5%; padding: 5em; background-color: rgb(255, 255, 255);">
        <h1 class="modal-title fs-5" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">MISE A JOUR DE VÊTEMENTS</h1>
        @method('put')
        @csrf
        <input type="text" class="form-control mt-3" name="nom_vet" value="{{ $vetement->nom_vet }}">
        @if ($errors)
        @error('nom_vet')
            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
        @enderror
        @endif
        <input type="number" class="form-control mt-3" name="prix_vet" value="{{ $vetement->prix_vet }}">
        @if ($errors)
        @error('prix_vet')
            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
        @enderror
        @endif

        <label for="" class="form-label mt-3">Catégorie</label>
        <select class="form-select" name="id_cat_vet" id="">
            <option value="{{ $cat_vet->id }}">{{ $cat_vet->nom_cat_vet}}</option>
            @forelse ($other_cat_vets as $other_cat_vet)
            <option value="{{ $other_cat_vet->id }}">{{ $other_cat_vet->nom_cat_vet}}</option>
            @empty
            <p class="text-center"><strong class="text-danger"> La liste des catégories de vêtements est vite! <strong></p>
            @endforelse
        </select>
        @if ($errors)
        @error('id_cat_vet')
            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
        @enderror
        @endif

        <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer</button>
        <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>
    </form>

</div>


<!--fin formulaire d'ajout vet-->

@endsection
