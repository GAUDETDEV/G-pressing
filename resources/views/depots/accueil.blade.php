@extends('layouts/auth')
@section('title',"type depots")

@section('content')

<div class="row mt-5">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card shadow" style="background-color:rgb(16, 38, 53);">
            <div class="card-body">
            <h5 class="card-title" style="color:rgb(25, 145, 231); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">TYPE DE DEPÔT</h5>
            <p class="card-text fs-5" style="color:rgb(173, 213, 241);">Dépot en fonction du poids des vêtements</p>
            <a href="{{route('listePoids')}}" class="btn btn-primary">Effectuer le Dépot</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card shadow" style="background-color:rgb(16, 38, 53);">
            <div class="card-body">
            <h5 class="card-title" style="color:rgb(25, 145, 231); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">TYPE DE DEPÔT</h5>
            <p class="card-text fs-5" style="color:rgb(173, 213, 241);">Dépot en fonction du nombre de vêtements</p>
            <a href="{{route('listeNombre')}}" class="btn btn-primary">Effectuer le Dépot</a>
            </div>
        </div>
    </div>
</div>

@endsection
