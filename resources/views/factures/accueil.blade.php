@extends('layouts/auth')
@section('title',"accueil")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
        <div class="card h-100" style="background-color:rgb(16, 38, 53);">
            <div class="card-body">
                <h5 class="card-title" style="color:rgb(25, 145, 231); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">Classique</h5>
                <div class="row">
                    <div class="col">
                        <p class="card-text text-center" style="color:rgb(173, 213, 241);">Reception classique des vêtements selon leur type...</p>
                    </div>
                    <div class="col">
                        <p class="card-text fs-5 text-center" style="color:rgb(173, 213, 241);"><i class="fa-solid fa-layer-group fa-5x text-white"></i></p>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="border-bottom: solid 5px rgb(6, 76, 125); ">
                <a href="{{route('listeFactureClassic')}}" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Facturation </a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100" style="background-color:rgb(57, 4, 62);">
            <div class="card-body">
                <h5 class="card-title" style="color:rgb(251, 0, 138); font-weight: bold; border-bottom: solid 5px rgb(184, 3, 72); ">Selon le nombre</h5>
                <div class="row">
                    <div class="col">
                        <p class="card-text text-center" style="color:rgb(255, 147, 192);">Reception des vêtements selon leur quantité...</p>
                    </div>
                    <div class="col">
                        <p class="card-text fs-5 text-center" style="color:rgb(255, 255, 255);"><i class="fa-solid fa-5x fa-bars-progress"></i></p>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="border-bottom: solid 5px rgb(245, 1, 123); ">
                <a href="{{route('listeDepotNombre')}}" class="btn" style="background-color: rgb(245, 1, 123); color:white;"><i class="fa-regular fa-pen-to-square"></i> Facturation </a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100" style="background-color:rgb(0, 0, 0);">
            <div class="card-body">
                <h5 class="card-title" style="color:rgb(145, 145, 145); font-weight: bold; border-bottom: solid 5px rgb(49, 49, 49); ">Selon le poids</h5>
                <div class="row">
                    <div class="col">
                        <p class="card-text text-center" style="color:rgb(211, 211, 211);">Reception des vêtements selon leur poids...</p>
                    </div>
                    <div class="col">
                        <p class="card-text fs-5 text-center" style="color:rgb(255, 255, 255);"><i class="fa-solid fa-5x fa-weight-hanging"></i></p>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="border-bottom: solid 5px rgb(49, 49, 49); ">
                <a href="{{route('listeDepotPoids')}}" class="btn" style="background-color: rgb(101, 101, 101); color:white;"><i class="fa-regular fa-pen-to-square"></i> Facturation </a>
            </div>
        </div>
    </div>
  </div>

@endsection
