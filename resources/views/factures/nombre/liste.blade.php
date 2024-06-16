@extends('layouts/auth')
@section('title',"depot nombre")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut card d'afficahge de packs-->

<h4 class="card-title  mt-5" style="border-left: 20px solid rgb(228, 141, 209); color: rgb(251, 251, 251); background-color: rgb(165, 9, 61); padding: 7px;">Liste de depôts selon le nombre de vêtements</h4>

<!--debut boutons d'ajout d'options de reception-->

<div class="container mt-3">
    <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalAddDepotNombre" class="btn" href="" style='color: rgb(255, 255, 255); background-color: rgb(98, 6, 118); margin: 5px;'><i class="fa-solid fa-plus"></i> Dépot</a>
</div>

<!--fin boutons d'ajout d'options de reception-->

<div class="row row-cols-1 row-cols-md-3 g-4 mt-4">

    @forelse ( $depot_nombres as $depot_nombre)
        <div class="col">
            <div class="card h-100 shadow" style="background-color:rgb(217, 143, 194);">
                <div class="card-body">

                    <div class="card-text rounded" style="background-color:rgb(85, 7, 60);">
                        <p style=" color:white; font-weight: bold; border-radius: 5px; padding:7px; text-align: center;"><span style="font-size: 2em; color:rgb(237, 52, 172); font-weight: bold;">{{$depot_nombre->nbr_vet}} Habit(s)</span></p>
                        <p style=" color:white; font-weight: bold; border-radius: 5px; padding:7px; text-align: center;" ><span style="font-size: 5em; color:rgb(255, 255, 255); font-weight: bold;">{{$depot_nombre->prix_depot}}</span> <span>Francs</span></p>
                    </div>

                </div>
                <div class="card-footer mt-5">

                <a href="{{route('listeFactureNombre',['depot_nombre' => $depot_nombre->id])}}" type="button" class="btn mt-5" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(112, 8, 72);"><i class="fa-solid fa-eye"></i> Voir la liste de facture </a>
                <a href="{{route('modifyNombre',['depot_nombre' => $depot_nombre->id])}}" type="button" class="btn mt-5" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(100, 7, 7);"><i class="fa-solid fa-pen"></i> Modifier</a>

                </div>
            </div>
        </div>
    @empty
        <p class="text-center" style="color:rgb(151, 37, 19); padding: 5px; background-color:rgb(218, 161, 147);">La liste des depots est vide!</p>
    @endforelse

    {{ $depot_nombres->links() }}

</div>

<!--fin card d'afficahge de packs-->


<!--debut Modal add vets-->
<div class="modal fade" id="exampleModalAddDepotNombre" tabindex="-1" aria-labelledby="exampleModalAddDepotNombreLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddDepotNombreLabel" style="color:rgb(0, 0, 0); font-weight: bold; border-bottom: solid 5px rgb(10, 3, 9); ">AJOUT DEPOT</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postDepotNombreRecept')}}" method="POST" >

                @method('post')
                @csrf

                <input type="number" class="form-control mt-3" name="nbr_vet" placeholder="Nombre de vêtements">
                @if ($errors)
                @error('nbr_vet')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <input type="number" class="form-control mt-3" name="prix_depot" placeholder="Prix du dépot">
                @if ($errors)
                @error('prix_depot')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer</button>
                <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>
            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal" style='background-color:rgb(62, 7, 51); color: white;'>Retour</button>
        </div>
    </div>
    </div>
</div>

<!--fin Modal add vets-->


@endsection
