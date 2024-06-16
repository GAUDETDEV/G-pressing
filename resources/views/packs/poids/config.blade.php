
@extends('layouts/auth')
@section('title',"configuration Packs")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut card d'afficahge de packs-->

<div class="container mt-5">

    <div class="container shadow" style="background-color: white; padding: 10px; border-radius: 5px;">

        <h2 style="background-color: rgb(11, 101, 107); color: white; padding: 10px; border-radius: 5px;">Configuration de packs</h2>

        <div class="row" style="padding: 15px;">

            <div class="col shadow rounded border" style="margin: 5px;">

                <form action="{{route('postVetPackPoids',['pack' => $pack->id])}}" method="POST" style="margin: 10px;">

                    @method('post')
                    @csrf

                    <label class="form-label" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Type</label>
                    <select class="form-select" name="nom_vet" id="">
                        @foreach ($vetements as $vetement)
                        <option value="{{ $vetement->nom_vet }}">{{ $vetement->nom_vet }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer </button>
                    <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

                </form>

            </div>

            <div class="col shadow rounded border" style="margin: 5px;">

                <form action="{{route('postCatVetPackPoids',['pack' => $pack->id])}}" method="POST" style="margin: 10px;">

                    @method('post')
                    @csrf

                    <label class="form-label" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Catégories</label>
                    <select class="form-select" name="nom_cat_vet" id="">
                        @foreach ($cat_vets as $cat_vet)
                        <option value="{{ $cat_vet->nom_cat_vet }}">{{ $cat_vet->nom_cat_vet }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i>Enregistrer</button>
                    <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

                </form>

            </div>

            <div class="col shadow rounded border" style="margin: 5px;">

                <form action="{{route('postQualityVetPackPoids',['pack' => $pack->id])}}" method="POST" style="margin: 10px;">

                    @method('post')
                    @csrf

                    <label class="form-label" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Qualité</label>
                    <select class="form-select" name="nom" id="">
                        @foreach ($quality_vets as $quality_vet)
                        <option value="{{ $quality_vet->nom }}">{{ $quality_vet->nom }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer </button>
                    <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

                </form>

            </div>

        </div>

    </div>

</div>


<!--fin card d'afficahge de packs-->


@endsection
