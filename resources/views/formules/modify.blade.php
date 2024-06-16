@extends('layouts/auth')
@section('title',"formulaire modification")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut formulaire de modification des formules-->

<div class="container">

    <form action="{{route('putFormule',['formule' => $formule->id])}}" method="POST" class="container shadow rounded-3" style="width:80%; margin-top:5%; padding: 5em; background-color: rgb(255, 255, 255);">
        <h1 class="modal-title fs-5" id="modalAjoutGerantLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">MISE A JOUR DE FORMULES</h1>
        @method('put')
        @csrf
        <div class="row">
            <div class="col">

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Nom de la formule</label>
                <input type="text" class="form-control mt-3" name="nom_formule" value="{{$formule->nom_formule}}">
                @if ($errors)
                @error('nom_formule')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif
                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Prix / Mois</label>
                <input type="number" class="form-control mt-3" name="prix_formule" value="{{$formule->prix_formule}}">
                @if ($errors)
                @error('prix_formule')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif
                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Nombre d'utilisateurs</label>
                <input type="text" class="form-control mt-3" name="nbr_user" value="{{$formule->nbr_user}}">
                @if ($errors)
                @error('nbr_user')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif
                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Nombre d'essais</label>
                <input type="text" class="form-control mt-3" name="nbr_essai" value="{{$formule->nbr_essai}}">
                @if ($errors)
                @error('nbr_essai')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

            </div>
            <div class="col">

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">La durée (nombre de jours)</label>
                <input type="number" class="form-control mt-3" name="periode" value="{{$formule->periode}}">
                @if ($errors)
                @error('periode')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif
                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Les fonctionnalités</label>
                <textarea name="fonctionnalite" id="" cols="30" rows="10" class="form-control mt-3">{{$formule->fonctionnalite}}</textarea>
                @if ($errors)
                @error('fonctionnalite')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

            </div>
        </div>

        <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Mettre à jour</button>
        <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

    </form>

</div>


<!--fin formulaire de modification des formules-->

@endsection
