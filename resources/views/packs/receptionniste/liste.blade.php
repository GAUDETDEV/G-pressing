@extends('layouts/auth')
@section('title',"liste Packs")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<div class="d-flex">


<div class="row row-cols-1 row-cols-md-3 g-4 mt-4">

    @forelse ( $packs as $pack)
        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h4 class="card-title" style="color:rgb(6, 76, 125); font-weight: bold; border-left: solid 20px rgb(6, 76, 125);">{{$pack->nom_pack}}</h4>

                    <div class="card-text mt-3">

                        <div style="background-color:rgb(6, 76, 125); color:white; font-weight: bold; border-radius: 5px; padding:7px;">

                            @if ($pack->nbr_vet)
                                <h5 class="text-center fs-3">{{$pack->nbr_vet}} vêtement(s) </h5>
                            @endif

                            @if ($pack->poids_vet)
                                <h5 class="text-center fs-3">{{$pack->poids_vet}} Kilo(s) </h5>
                            @endif

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

                        <div style="background-color: rgb(166, 212, 245); color:rgb(66, 16, 250); border-radius: 10px; padding: 5px;">

                            <h5 style="color:rgb(5, 5, 101); border-bottom: solid 3px rgb(5, 5, 101);">Type de vêtements</h5>
                            @forelse ($vetement_packs as $vetement_pack)
                                <small style="color:rgb(7, 7, 24); font-style: italic;">{{ $vetement_pack->nom_vet }}, </small>
                            @empty
                                <small style="color:rgb(2, 117, 83); font-style: italic;"> Non définie </small>
                            @endforelse

                            <h5 style="color:rgb(5, 5, 101); border-bottom: solid 3px rgb(5, 5, 101);">Catégorie de vêtements</h5>
                            @forelse ($cat_vet_packs as $cat_vet_pack)
                                <small style="color:rgb(7, 7, 24); font-style: italic;">{{ $cat_vet_pack->nom_cat_vet }}, </small>
                            @empty
                                <small style="color:rgb(2, 117, 83); font-style: italic;"> Non définie </small>
                            @endforelse

                            <h5 style="color:rgb(5, 5, 101); border-bottom: solid 3px rgb(5, 5, 101);">Qualité de vêtements</h5>
                            @forelse ($quality_vet_packs as $quality_vet_pack)
                                <small style="color:rgb(7, 7, 24); font-style: italic;">{{ $quality_vet_pack->nom }}, </small>
                            @empty
                                <small style="color:rgb(2, 117, 83); font-style: italic;"> Non définie </small>
                            @endforelse

                        </div>


                        <p class="mt-5">

                            <strong> Livraison </strong> :
                            @if ($pack->delivery == "oui") <span style="background-color: white; color:rgb(66, 16, 250); border-radius: 10px; padding: 5px;">{{ $pack->delivery }}</span>
                            @elseif ($pack->delivery == "non") <span style="background-color: white; color:rgb(200, 35, 35); border-radius: 10px; padding: 5px;">{{ $pack->delivery }}</span>
                            @else <span style="background-color: white; color:rgb(27, 148, 65); border-radius: 10px; padding: 5px;"> X </span>  @endif

                            <strong> récup </strong> :
                            @if ($pack->recovery == "oui") <span style="background-color: white; color:rgb(66, 16, 250); border-radius: 10px; padding: 5px;">{{ $pack->recovery }}</span>
                            @elseif ($pack->recovery == "non")  <span style="background-color: white; color:rgb(200, 35, 35); border-radius: 10px; padding: 5px;">{{ $pack->recovery }}</span>
                            @else<span style="background-color: white; color:rgb(27, 148, 65); border-radius: 10px; padding: 5px;"> X </span>  @endif

                        </p>

                        </div>
                    </div>

                </div>
                <div class="card-footer text-center" >

                    <a href="{{route('receptionistListePackClient')}}" type="button" class="btn mt-5" title="Liste de clients" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(2, 2, 22);"><i class="fa-solid fa-list"></i> Souscrivants</a>

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
