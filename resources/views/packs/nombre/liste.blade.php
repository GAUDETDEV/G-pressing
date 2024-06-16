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

    <a href="{{route("formNombrePacks")}}" type="button" class="btn" style="background-color:rgb(66, 16, 250); color: white;">
        <i class="fa-solid fa-plus"></i> Ajouter
    </a>

</div>

<!--debut card d'afficahge de packs-->

<div class="row row-cols-1 row-cols-md-3 g-4 mt-4">

    @forelse ( $packs as $pack)
        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h4 class="card-titles" style="color:rgb(6, 76, 125); font-weight: bold; border-left: solid 20px rgb(6, 76, 125);">{{$pack->nom_pack}}</h4>

                    <div class="card-text mt-3">

                        <div style="background-color:rgb(6, 76, 125); color:white; font-weight: bold; border-radius: 5px; padding:7px;">

                            <h5 class="text-center fs-3">{{$pack->nbr_vet}} vêtement(s)</h5>

                            <strong class="text-center">A :
                            @if ($pack->duration_pack == 7)
                            <span style="font-size: 2em; color:rgb(166, 212, 245); font-weight: bold;">{{$pack->prix_pack}} francs pendant une semaine</span>

                            @elseif ($pack->duration_pack == 14)
                            <span style="font-size: 2em; color:rgb(166, 212, 245); font-weight: bold;">{{$pack->prix_pack}} francs pendant deux semaines</span>

                            @elseif ($pack->duration_pack == 21)
                            <span style="font-size: 2em; color:rgb(166, 212, 245); font-weight: bold;">{{$pack->prix_pack}} francs pendant trois semaines</span>

                            @elseif ($pack->duration_pack == 30 or $pack->duration_pack == 31)
                            <span style="font-size: 2em; color:rgb(166, 212, 245); font-weight: bold;">{{$pack->prix_pack}} francs pendant un mois</span>

                            @else
                            <span style="font-size: 2em; color:rgb(166, 212, 245); font-weight: bold;">{{$pack->prix_pack}} francs pendant {{$pack->duration_pack}} Jour(s)</span>

                            @endif

                        </strong>
                        <p class="mt-5">

                            <strong> Livraison </strong> :

                                @if ($pack->delivery == "oui") <span style="background-color: white; color:rgb(66, 16, 250); border-radius: 10px; padding: 5px;">{{ $pack->delivery }}</span>
                                @elseif ($pack->delivery == "non") <span style="background-color: white; color:rgb(200, 35, 35); border-radius: 10px; padding: 5px;">{{ $pack->delivery }}</span>
                                @else <span style="background-color: white; color:rgb(27, 148, 65); border-radius: 10px; padding: 5px;"> X </span>  @endif


                            <strong> Récupération </strong> :

                                @if ($pack->recovery == "oui") <span style="background-color: white; color:rgb(66, 16, 250); border-radius: 10px; padding: 5px;">{{ $pack->recovery }}</span>
                                @elseif ($pack->recovery == "non")  <span style="background-color: white; color:rgb(200, 35, 35); border-radius: 10px; padding: 5px;">{{ $pack->recovery }}</span>
                                @else<span style="background-color: white; color:rgb(27, 148, 65); border-radius: 10px; padding: 5px;"> X </span>  @endif
                        </p>

                        </div>
                    </div>

                </div>
                <div class="card-footer mt-5 text-center" >

                    <a href="{{route('modifyPackNombre',['pack' => $pack->id])}}" type="button" class="btn mt-5" title="Modifier" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(26, 12, 87);"><i class="fa-solid fa-pen"></i></a>
                    <a href="{{route('detailPackNombre',['pack' => $pack->id])}}" type="button" class="btn mt-5" title="Détails" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(20, 58, 33);"><i class="fa-solid fa-eye"></i></a>

                    @if ($pack->nom_pack)
                    <a href="{{route('configPackNombre',['pack' => $pack->id])}}" type="button" class="btn mt-5" title="Configuration" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(19, 19, 19);"><i class="fa-solid fa-gears"></i></a>
                    @endif

                    <a href="{{route('deletePackNombre',['pack' => $pack->id])}}" type="button" class="btn mt-5" title="Supprimer" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(168, 92, 0);"><i class="fa-solid fa-trash"></i></a>

                </div>
            </div>

        </div>

    @empty
        <p class="text-center" style="color:rgb(151, 37, 19); padding: 5px; background-color:rgb(218, 161, 147);">La liste des packs est vide!</p>
    @endforelse


</div>

<div class="mt-3">
    {{$packs->links()}}
</div>

<!--fin card d'afficahge de packs-->


@endsection
