@extends('layouts/auth')
@section('title',"formulaire modification")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut formulaire de modification poids-->

<div class="container">

    <form action="{{route('putPoids',['depot_poids'=>$depot_poids->id])}}" method="POST" class="container shadow rounded-3" style="width:50%; margin-top:5%; padding: 5em; background-color: rgb(255, 255, 255);">
        <h1 class="modal-title fs-5" id="modalAjoutGerantLabel" style="color:rgb(0, 0, 0); font-weight: bold; border-bottom: solid 5px rgb(57, 58, 58); ">MISE A JOUR DU TYPE DE DEPOTS</h1>
        @method('put')
        @csrf

            <label for="" style="color:rgb(78, 77, 81); font-weight: bold;">Poids en Kilo(s)</label>
            <input type="number" class="form-control mt-3" name="poids_vet" value="{{$depot_poids->poids_vet}}">
            @if ($errors)
            @error('poids_vet')
                <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
            @enderror
            @endif

            <label for="" style="color:rgb(78, 77, 81); font-weight: bold;">Le prix</label>
            <input type="number" class="form-control mt-3" name="prix_depot" value="{{$depot_poids->prix_depot}}">
            @if ($errors)
            @error('prix_depot')
                <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
            @enderror
            @endif

        <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Mettre à jour</button>
        <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(40, 80, 62);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

    </form>

</div>

<!--fin formulaire de modification poids-->

@endsection
