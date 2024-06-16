@extends('layouts/auth')
@section('title',"detail")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut affichage d'informations categories user-->

<div class="container mt-3">

    <div class="text-center rounded-2 shadow" style="color:rgb(246, 246, 246); background-color:rgb(9, 9, 75); padding: 5px;">
        <h2 style="color:rgb(255, 255, 255);">INFORMATIONS GENERALES LA CATEGORIE</h2>
    </div>

    <div class="row">

        <div class="col">
            <div class="card shadow mt-4">

                <div class="card-body">

                    <div class="row row-cols-1 row-cols-md-2 g-4 mt-5">

                        <div class="col">
                            <div class="card shadow" style="background-color: rgb(58, 11, 85); font-size: 2em;">
                                <h3 class="card-header text-center" style="color:rgb(255, 255, 255);"> Nombre de: </h3>
                                <div class="card-body text-center" style="border-top: solid 5px rgb(255, 255, 255);">
                                    <p><strong style="color: rgb(5, 171, 231);">{{ $cat_vet->nom_cat_vet }}</strong></p>
                                    <p><strong style=" background-color: rgb(249, 249, 249); color: rgb(2, 76, 103); font-style: italic; font-size: 40px; border-radius: 20px; padding: 5px;">{{ $nbr_vets }}</strong></p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

</div>


<!--fin affichage d'informations catégorie user-->

@endsection
