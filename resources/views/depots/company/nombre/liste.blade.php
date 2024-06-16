@extends('layouts/auth')
@section('title',"liste Packs")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<div class="d-flex">

<!--bouton d'ajout de packs-->

    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAddPoids" style="background-color:rgb(66, 16, 250); color: white;">
        <i class="fa-solid fa-plus"></i> Ajouter en fontion du nombre
    </button>

</div>

<!--debut card d'afficahge de packs-->

<div class="row row-cols-1 row-cols-md-3 g-4 mt-4">

    @forelse ( $depot_edit_company_nombres as $depot_edit_company_nombre)
        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body">

                    <div class="card-text rounded" style="background-color:rgb(6, 76, 125);">
                        <p style=" color:white; font-weight: bold; border-radius: 5px; padding:7px;"><strong> Nombre:</strong> <span style="font-size: 2em; color:rgb(166, 212, 245); font-weight: bold;">{{$depot_edit_company_nombre->nbr_vet}} Habit(s)</span></p>
                        <p style=" color:white; font-weight: bold; border-radius: 5px; padding:7px;"><strong> Prix :</strong> <span style="font-size: 2em; color:rgb(166, 212, 245); font-weight: bold;">{{$depot_edit_company_nombre->prix_depot}} Francs</span></p>
                    </div>

                </div>
                <div class="card-footer mt-5">

                <a href="{{route('modifyNombre',['depot_nombre' => $depot_edit_company_nombre->id])}}" type="button" class="btn mt-5" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(26, 12, 87);"><i class="fa-solid fa-pen"></i> Modifier</a>
                <a href="{{route('deleteNombre',['depot_nombre' => $depot_edit_company_nombre->id])}}" type="button" class="btn mt-5" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(168, 92, 0);"><i class="fa-solid fa-trash"></i> Supprimer</a>

                </div>
            </div>
        </div>
    @empty
        <p class="text-center" style="color:rgb(151, 37, 19); padding: 5px; background-color:rgb(218, 161, 147);">La liste des depots est vide!</p>
    @endforelse

<!--debut Modal add packs-->
    <div class="modal fade" id="exampleModalAddPoids" tabindex="-1" aria-labelledby="exampleModalAddPoidsLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalAddPoidsLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE DEPÔT</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{route('postNombre')}}" method="POST">

                    @method('post')
                    @csrf

                    <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">La quantité</label>
                    <input type="text" class="form-control mt-3" name="nbr_vet" >
                    @if ($errors)
                    @error('nbr_vet')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                    @enderror
                    @endif
                    <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Prix</label>
                    <input type="number" class="form-control mt-3" name="prix_depot">
                    @if ($errors)
                    @error('prix_depot')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                    @enderror
                    @endif

                    <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer </button>
                    <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal" style='background-color:rgb(62, 7, 51); color: white;'>Retour</button>
            </div>
        </div>
        </div>
    </div>

<!--fin Modal add packs-->

<div class="mt-5">

{{ $depot_edit_company_nombres -> links()}}

</div>

</div>

<!--fin card d'afficahge de packs-->


@endsection
