@extends('layouts/auth')
@section('title',"liste Packs")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<div class="container">

    <div class="container">
        <div class="row">
            <div class="col">

            </div>
            <div class="col text-center">
            <a href="{{route('listePacksNombre')}}" style="text-decoration: none;">
                <div class="card shadow" style="width: 18rem; background-color: black;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: rgb(255, 255, 255);">Selon</h5>
                        <h6 class="card-subtitle mb-2" style="font-size: 30px; color: rgb(43, 115, 174);">Le nombre</h6>
                        <p class="card-text" style="font-size: 200px; color: rgb(255, 255, 255)"><i class="fa-solid fa-arrow-up-9-1"></i></p>
                    </div>
                </div>
            </a>
            </div>
            <div class="col text-center">
                <a href="{{route('listePacksPoids')}}" style="text-decoration: none;">
                    <div class="card shadow" style="width: 18rem; background-color: rgb(4, 73, 116);">
                        <div class="card-body">
                            <h5 class="card-title" style="color: rgb(255, 255, 255);">Selon</h5>
                            <h6 class="card-subtitle mb-2" style="font-size: 30px; color: rgb(54, 54, 54);">Le poids</h6>
                            <p class="card-text" style="font-size: 200px; color: rgb(255, 255, 255);"><i class="fa-solid fa-weight-hanging"></i></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">

            </div>
        </div>
    </div>

</div>




@endsection
