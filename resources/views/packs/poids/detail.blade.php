@extends('layouts/auth')
@section('title',"liste Packs")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut card d'afficahge de packs-->

<div class="card">
    <h3 class="card-header" style="color: rgb(16, 174, 169); background-color: rgb(9, 59, 69); padding: 5px;">DETAILS</h3>
    <div class="card-body">

        <div class="row">
            <div class="col" style=" color: white; background-color: rgb(9, 59, 69); padding: 5px; margin: 5px; border-radius: 10px;">

                <h5 class="card-title" style="color: white; padding: 5px; border-left: 10px solid rgb(2, 163, 184);">Types de vêtements</h5>
                <ul>
                @forelse ($vetements as $vetement)
                    <li style="color: rgb(7, 175, 198); font-weight: bold;">{{ $vetement->nom_vet}} <a href="{{route('modifyVetPoids',["vetement" => $vetement->id])}}" title="modifier"> <i class="fa-solid fa-pen" style="color: rgb(59, 153, 93);"></i></a> <a href="{{route('deleteVetPoids',["vetement" => $vetement->id])}}" title="supprimer"><i class="fa-solid fa-trash" style="color: rgb(177, 48, 15);"></i></a></li>
                @empty
                    <li style="list-style: none; "><span style="color: rgb(254, 145, 12); font-size: 15px;"> Oops la liste de vêtements est vide! </span></li>
                @endforelse
                </ul>

            </div>
            <div class="col" style="color: white; background-color: rgb(9, 59, 69); padding: 5px; margin: 5px; border-radius: 10px;">

                <h5 class="card-title" style="color: white; padding: 5px; border-left: 10px solid rgb(2, 163, 184);">Catégories de vêtements</h5>
                <ul>
                    @forelse ($cat_vets as $cat_vet)
                    <li style="color: rgb(7, 175, 198); font-weight: bold;">{{ $cat_vet->nom_cat_vet}} <a href="{{route('modifyCatVetPoids',["cat_vet" => $cat_vet->id])}}" title="modifier"> <i class="fa-solid fa-pen" style="color: rgb(59, 153, 93);"></i></a> <a href="{{route('deleteCatVetPoids',["cat_vet" => $cat_vet->id])}}" title="supprimer"><i class="fa-solid fa-trash" style="color: rgb(177, 48, 15);"></i></a></li>
                @empty
                <li style="list-style: none; "><span style="color: rgb(254, 145, 12); font-size: 15px;"> Oops la liste des catégories est vide! </span></li>
                @endforelse
                </ul>

            </div>
            <div class="col" style="color: white; background-color: rgb(9, 59, 69); padding: 5px; margin: 5px; border-radius: 10px;">

                <h5 class="card-title" style="color: white; padding: 5px; border-left: 10px solid rgb(2, 163, 184);">Qualités de vêtements</h5>
                <ul>
                @forelse ($quality_vets as $quality_vet)
                    <li style="color: rgb(7, 175, 198); font-weight: bold;">{{ $quality_vet->nom}} <a href="{{route('modifyQualityVetPoids',["quality_vet" => $quality_vet->id])}}" title="modifier"> <i class="fa-solid fa-pen" style="color: rgb(59, 153, 93);"></i></a> <a href="{{route('deleteQualityVetPoids',["quality_vet" => $quality_vet->id])}}" title="supprimer"><i class="fa-solid fa-trash" style="color: rgb(177, 48, 15);"></i></a></li>
                @empty
                <li style="list-style: none; "><span style="color: rgb(254, 145, 12); font-size: 15px;"> Oops la liste ds qualités est vide! </span></li>
                @endforelse
                </ul>

            </div>
        </div>


    </div>
</div>

<!--fin card d'afficahge de packs-->


@endsection
