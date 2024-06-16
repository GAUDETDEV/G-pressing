@extends('layouts/auth')
@section('title',"accueil planning")

@section('content')

<div class="row mt-5">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card shadow mt-4" style="background-color:rgb(16, 38, 53);">
            <div class="card-body">
            <h5 class="card-title" style="color:rgb(25, 145, 231); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">RECEPTION</h5>
            <p class="card-text fs-5 text-center" style="color:rgb(173, 213, 241);"><i class="fa-solid fa-layer-group fa-5x text-white"></i></p>
            <a href="{{route('planningRecep')}}" class="btn btn-primary"><i class="fa-solid fa-chart-simple"></i> Plannifier </a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card shadow mt-4" style="background-color:rgb(16, 38, 53);">
            <div class="card-body">
            <h5 class="card-title" style="color:rgb(25, 145, 231); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">LAVAGE</h5>
            <p class="card-text fs-5 text-center" style="color:rgb(173, 213, 241);"><i class="fa-solid fa-jug-detergent fa-5x text-white"></i></p>
            <a href="{{route('listeFactureLavage')}}" class="btn btn-primary"><i class="fa-solid fa-chart-simple"></i> Plannifier </a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card shadow mt-4" style="background-color:rgb(16, 38, 53);">
            <div class="card-body">
            <h5 class="card-title" style="color:rgb(25, 145, 231); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">REPASSAGE</h5>
            <p class="card-text fs-5 text-center" style="color:rgb(173, 213, 241);"><i class="fa-brands fa-cloudflare fa-5x text-white"></i></p>
            <a href="{{route('listeFactureRepassage')}}" class="btn btn-primary"><i class="fa-solid fa-chart-simple"></i> Plannifier </a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card shadow mt-4" style="background-color:rgb(16, 38, 53);">
            <div class="card-body">
            <h5 class="card-title" style="color:rgb(25, 145, 231); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">LIVRAISON</h5>
            <p class="card-text fs-5 text-center" style="color:rgb(173, 213, 241);"><i class="fa-solid fa-truck fa-5x text-white"></i></p>
            <a href="{{route('listeFactureLivraison')}}" class="btn btn-primary"><i class="fa-solid fa-chart-simple"></i> Plannifier </a>
            </div>
        </div>
    </div>
</div>

@endsection
