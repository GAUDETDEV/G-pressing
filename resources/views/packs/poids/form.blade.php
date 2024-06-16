@extends('layouts/auth')
@section('title',"ajout Packs")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut card d'afficahge de packs-->

<div class="container mt-5">

    <div class="container shadow" style="background-color: white; padding: 10px; border-radius: 5px;">

        <h2 style="background-color: rgb(11, 101, 107); color: white; padding: 10px; border-radius: 5px;">Formulaire d'ajout de packs</h2>

        <form action="{{route('postPackPoids')}}" method="POST">

            @method('post')
            @csrf
            <div class="row">
                <div class="col">

                    <label class="form-label" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Nom du paquetage</label>
                    <select class="form-select" name="nom_pack" id="">
                        @foreach ($liste_services as $liste_service)
                        <option value="{{$liste_service->type_service}}">{{$liste_service->type_service}}</option>
                        @endforeach
                    </select>

                    <label class="form-label" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Poids des vêtements</label>
                    <input type="number" class="form-control" name="poids_vet" placeholder="En kilogramme (Kg)">
                    @if ($errors)
                    @error('poids_vet')
                        <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                    @enderror
                    @endif

                    <label class="form-label" for="" style="color:rgb(58, 32, 60); font-weight: bold;">La durée</label>
                    <input type="number" class="form-control" name="duration_pack" placeholder="En nombre de jour(s)">
                    @if ($errors)
                    @error('duration_pack')
                        <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                    @enderror
                    @endif

                </div>

                <div class="col">

                    <label class="form-label" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Avec livraison?</label>
                    <select class="form-select" name="delivery" id="">
                        <option value="oui">Oui</option>
                        <option value="non">Non</option>
                    </select>

                    <label class="form-label" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Avec Récupération?</label>
                    <select class="form-select" name="recovery" id="">
                        <option value="oui">Oui</option>
                        <option value="non">Non</option>
                    </select>

                    <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Prix</label>
                    <input type="number" class="form-control mt-2" name="prix_pack" placeholder="En francs CFA">
                    @if ($errors)
                    @error('prix_pack')
                        <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                    @enderror
                    @endif


                </div>

            </div>

            <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer </button>
            <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

        </form>

    </div>

</div>


<!--fin card d'afficahge de packs-->


@endsection
