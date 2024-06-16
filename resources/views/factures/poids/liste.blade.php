@extends('layouts/auth')
@section('title',"depot poids")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut card d'afficahge de packs-->

<h4 class="card-title mt-5" style="border-left: 20px solid rgb(200, 196, 199); color: rgb(251, 251, 251); background-color: rgb(0, 0, 0); padding: 7px;">Liste de depôts selon le poids de vêtements</h4>

<!--debut boutons d'ajout d'options de reception-->

<div class="container mt-3">
    <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalAddDepotPoids" class="btn" href="" style='color: rgb(255, 255, 255); background-color: rgb(82, 82, 82); margin: 5px;'><i class="fa-solid fa-plus"></i> Dépot</a>
</div>

<!--fin boutons d'ajout d'options de reception-->

<div class="row row-cols-1 row-cols-md-3 g-4 mt-4">

    @forelse ( $depot_poids as $depot_poid)
        <div class="col">
            <div class="card h-100 shadow" style="background-color:rgb(176, 167, 173);">
                <div class="card-body">

                    <div class="card-text rounded" style="background-color:rgb(0, 0, 0);">
                        <p style=" color:white; font-weight: bold; border-radius: 5px; padding:7px; text-align: center;"><span style="font-size: 2em; color:rgb(102, 110, 115); font-weight: bold;">{{$depot_poid->poids_vet}} Kilo(s)</span></p>
                        <p style=" color:white; font-weight: bold; border-radius: 5px; padding:7px; text-align: center;"><span style="font-size: 5em; color:rgb(252, 252, 252); font-weight: bold;">{{$depot_poid->prix_depot}}</span> <span>Francs</span></p>
                    </div>

                </div>
                <div class="card-footer mt-5">

                <a href="{{route('listeFacturePoids',['depot_poid' => $depot_poid->id])}}" type="button" class="btn mt-5" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(96, 95, 99);"><i class="fa-solid fa-eye"></i> Voir la liste de facture </a>
                <a href="{{route('modifyPoids',['depot_poids' => $depot_poid->id])}}" type="button" class="btn mt-5" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(0, 59, 32);"><i class="fa-solid fa-pen"></i> Modifier</a>

                </div>
            </div>
        </div>
    @empty
        <p class="text-center" style="color:rgb(151, 37, 19); padding: 5px; background-color:rgb(218, 161, 147);">La liste des depots est vide!</p>
    @endforelse

    {{ $depot_poids->links() }}

</div>

<!--fin card d'afficahge de packs-->


<!--debut Modal add vets-->
<div class="modal fade" id="exampleModalAddDepotPoids" tabindex="-1" aria-labelledby="exampleModalAddDepotPoidsLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddDepotPoidsLabel" style="color:rgb(88, 90, 92); font-weight: bold; border-bottom: solid 5px rgb(0, 0, 0); ">AJOUT DEPOT</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postDepotPoidsRecept')}}" method="POST" >

                @method('post')
                @csrf

                <input type="number" class="form-control mt-3" name="poids_vet" placeholder="Poids du vêtements">
                @if ($errors)
                @error('poids_vet')
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
