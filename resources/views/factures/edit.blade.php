@extends('layouts/auth')
@section('title',"edit facture")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut formulaire d'ajout vet-->

<div class="container">

    <a href="{{route('listeRecept')}}" type="button" class="btn" style="background-color:rgb(66, 16, 250); color: white;">
        <i class="fa-solid fa-list"></i> Liste des vêtements receptionnés
    </a>

    <form action="{{route('postRecept',["facture"=>$facture->id])}}" method="POST" class="container shadow rounded-3" style="width:100%; margin-top:5%; padding: 5em; background-color: rgb(255, 255, 255);">
        <h1 class="modal-title fs-5" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">RECEPTION DE VÊTEMENTS DE LA FACTURE N° {{$facture->id}}</h1>
        @method('post')
        @csrf

        <div class="row">

            <div class="col">

                <label for="" class="form-label mt-3">Date de reception</label>
                <input type="date" class="form-control mt-3" name="created_at" value="{{$today}}">
                @if ($errors)
                @error('created_at')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3">RDV</label>
                @if ($info_type_depot->nbr_vet == 1)

                <input type="time" class="form-control mt-3" name="date_retrait" value="{{$date_limit1}}">
                @if ($errors)
                @error('date_retrait')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                @elseif ($info_type_depot->nbr_vet == 3)

                <input type="time" class="form-control mt-3" name="date_retrait" value="{{$date_limit2}}">
                @if ($errors)
                @error('date_retrait')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                @elseif ($info_type_depot->nbr_vet == 5)

                <input type="date" class="form-control mt-3" name="date_retrait" value="{{$date_limit3}}">
                @if ($errors)
                @error('date_retrait')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                @elseif ($info_type_depot->nbr_vet == 9)

                <input type="date" class="form-control mt-3" name="date_retrait" value="{{$date_limit4}}">
                @if ($errors)
                @error('date_retrait')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                @elseif ($info_type_depot->nbr_vet >= 10)

                <input type="date" class="form-control mt-3" name="date_retrait" value="{{$date_limit5}}">
                @if ($errors)
                @error('date_retrait')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                @else

                <input type="date" class="form-control mt-3" name="date_retrait">
                @if ($errors)
                @error('date_retrait')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                @endif

            </div>

            <div class="col">

                <label for="" class="form-label mt-3">Nom du vêtement</label>
                <select class="form-select" name="nom_vet" id="">
                    @forelse ($vetements as $vetement)
                    <option value="{{$vetement->nom_vet}}">{{$vetement->nom_vet}}</option>
                    @empty
                    <p class="text-center"><strong class="text-danger"> La liste des vêtements est vite! <strong></p>
                    @endforelse
                </select>
                @if ($errors)
                @error('nom_vet')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

            </div>

            <div class="col">

                <label for="" class="form-label mt-3">La couleur</label>
                <select class="form-select" name="color_vet" id="">
                    @forelse ($couleurs as $couleur)
                    <option value="{{$couleur->nom_couleur_vet}}">{{$couleur->nom_couleur_vet}}</option>
                    @empty
                    <p class="text-center"><strong class="text-danger"> La liste des couleurs est vite! <strong></p>
                    @endforelse
                </select>
                @if ($errors)
                @error('color_vet')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3">Spécification</label>
                <select class="form-select" name="caract_vet" id="">
                    @forelse ($caracts as $caract)
                    <option value="{{$caract->nom_specification_vet}}">{{$caract->nom_specification_vet}}</option>
                    @empty
                    <p class="text-center"><strong class="text-danger"> La liste des spécifications est vite! <strong></p>
                    @endforelse
                </select>
                @if ($errors)
                @error('caract_vet')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <input type="number" class="form-control mt-3" name="qte_vet" placeholder="La quantité">
                @if ($errors)
                @error('qte_vet')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

            </div>

        </div>

        <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer</button>
        <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>
    </form>

</div>

<!--fin formulaire d'ajout vet-->

@endsection