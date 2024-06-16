@extends('layouts/auth')
@section('title',"type recepts")

@section('content')


<div class="container">

    <div class="container">

        <div class="row">

            <div class="col">
                <div class="card shadow mt-4" style="background-color:rgb(16, 38, 53);">
                    <div class="card-body">
                    <h5 class="card-title" style="color:rgb(25, 145, 231); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">RECEPTION CLASSIQUE</h5>

                    <div class="row">
                        <div class="col">
                            <p class="card-text fs-5" style="color:rgb(173, 213, 241);">Les vêtements receptionnés selon leur type ...</p>
                        </div>
                        <div class="col">
                            <p class="card-text fs-5 text-center" style="color:rgb(173, 213, 241);"><i class="fa-solid fa-layer-group fa-5x text-white"></i></p>
                        </div>
                    </div>

                    <a href="{{route('listeTypeRecept')}}" class="btn btn-primary">Consulter la liste</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card shadow mt-4" style="background-color:rgb(16, 38, 53);">
                    <div class="card-body">
                    <h5 class="card-title" style="color:rgb(25, 145, 231); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AUTRES TYPE DE RECEPTION</h5>

                    <div class="row">
                        <div class="col">
                            <p class="card-text fs-5" style="color:rgb(173, 213, 241);">Les vêtements receptionnés autrement ...</p>
                        </div>
                        <div class="col">
                            <p class="card-text fs-5 text-center" style="color:rgb(255, 255, 255);"><i class="fa-solid fa-5x fa-tent-arrow-left-right"></i></p>
                        </div>
                    </div>

                    <a href="{{route('listeSupplementRecept')}}" class="btn btn-primary">Consulter la liste</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col">
                <div class="card shadow mt-4" style="background-color:rgb(16, 38, 53);">
                    <div class="card-body">
                    <h5 class="card-title" style="color:rgb(25, 145, 231); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">RECEPTION SELON LE POIDS ET SELON LE NOMBRE</h5>

                    <div class="row">
                        <div class="col">
                            <p class="card-text fs-5" style="color:rgb(173, 213, 241);">Les vêtements receptionnés selon leur poids et selon leur nombre ...</p>
                        </div>
                        <div class="col">
                            <p class="card-text fs-5 text-center" style="color:rgb(255, 255, 255);"><i class="fa-solid fa-5x fa-weight-hanging"></i></p>
                        </div>
                    </div>

                    <a href="{{route('listeNombrePoidsRecept')}}" class="btn btn-primary">Consulter la liste</a>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection
