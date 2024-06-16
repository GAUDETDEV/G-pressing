@extends('layouts/auth')
@section('title',"liste services")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut card d'afficahge de services-->

<div class="row row-cols-1 row-cols-md-3 g-4 mt-4">

    @forelse ( $liste_services as $liste_service)
        <div class="col">
            <div class="card h-100 shadow" style="background-color:rgb(1, 0, 1);">
                <div class="card-body">

                    <div class="card-text rounded mb-3" style="background-color:rgb(6, 76, 125); padding: 2px;">
                        <p style=" color:white; font-weight: bold; border-radius: 5px; padding:7px;"> <span style="font-size: 2em; color:rgb(166, 212, 245); font-weight: bold;">{{$liste_service->type_service}}</span></p>
                    </div>

                    <p style=" color:rgb(10, 101, 117); font-weight: bold; border-radius: 5px; padding:7px;"><strong> Description :</strong> </p>
                    <div class="card-text rounded mt-2" style="background-color:rgb(238, 238, 202); padding: 5px; height: 30%;">
                        @if ($liste_service->description == "")
                        <p style="font-size: 15px; color:rgb(200, 10, 10); font-weight: bold; font-style: italic; border-radius: 3px;"><span> Non définie ... </span></p>
                        @else
                        <p style="font-size: 15px; color:rgb(17, 21, 131); font-weight: bold; border-radius: 3px;"><span>{!! nl2br(e($liste_service->description)) !!}</span></p>
                        @endif
                    </div>

                </div>

                <div class="card-footer mt-5 text-center">

                <a href="{{route('receptionistEditFacture',['service' => $liste_service->id])}}" type="button" class="btn" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(26, 12, 87);"><i class="fa-solid fa-pen"></i> Rédiger une facture </a>

                </div>

            </div>
        </div>
    @empty
        <p class="text-center" style="color:rgb(151, 37, 19); padding: 5px; background-color:rgb(218, 161, 147);">La liste des services complémentaires est vide!</p>
    @endforelse

</div>

<div class="mt-5">
    {{ $liste_services -> links()}}
</div>


<!--fin card d'afficahge de services-->


@endsection
