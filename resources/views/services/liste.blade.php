@extends('layouts/auth')
@section('title',"liste services")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<div class="d-flex">

<!--bouton d'ajout de services-->

    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAddPoste" style="background-color:rgb(66, 16, 250); color: white;">
        <i class="fa-solid fa-plus"></i> Ajouter
    </button>

</div>

<!--debut card d'afficahge de services-->

<div class="row row-cols-1 row-cols-md-3 g-4 mt-4">

    @forelse ( $liste_services as $liste_service)
        <div class="col">
            <div class="card h-100 shadow" style="background-color:rgb(1, 0, 1);">
                <div class="card-body">

                    <div class="card-text rounded mb-3" style="background-color:rgb(6, 76, 125); padding: 2px;">
                        <p style=" color:white; font-weight: bold; border-radius: 5px; padding:7px;"><strong> Type de service:</strong> <span style="font-size: 2em; color:rgb(166, 212, 245); font-weight: bold;">{{$liste_service->type_service}}</span></p>
                    </div>

                    <p style=" color:rgb(135, 198, 243); font-weight: bold; border-radius: 5px; padding:7px;"><strong> Description :</strong> </p>
                    <div class="card-text rounded mt-2" style="background-color:rgb(6, 76, 125); padding: 5px; height: 30%;">
                        @if ($liste_service->description == "")
                        <p style="font-size: 15px; color:rgb(230, 202, 24); font-weight: bold; border-radius: 3px; font-style: italic;"><span> Non définie </span></p>
                        @else
                        <p style="font-size: 15px; color:rgb(166, 212, 245); font-weight: bold; border-radius: 3px;"><span>{!! nl2br(e($liste_service->description)) !!}</span></p>
                        @endif
                    </div>

                </div>
                <div class="card-footer mt-5">

                <a href="{{route("modifyService",['service' => $liste_service->id])}}" type="button" class="btn" style="color:rgb(255, 255, 255); padding: 3px; background-color:rgb(26, 12, 87);"><i class="fa-solid fa-pen"></i> Modifier  </a>
                <a href="{{route("accueilConfigService",['service' => $liste_service->id])}}" type="button" class="btn" style="color: rgb(255, 255, 255); padding: 3px; background-color:rgb(99, 99, 99);" ><i class="fa-solid fa-gears"></i> Configurer </a>
                <a href="{{route("deleteService",['service' => $liste_service->id])}}" type="button" class="btn" style="color: rgb(255, 255, 255); padding: 3px; background-color:rgb(217, 17, 17);" ><i class="fa-solid fa-trash"></i> Supprimer </a>

                </div>
            </div>
        </div>
    @empty
        <p class="text-center" style="color:rgb(151, 37, 19); padding: 5px; background-color:rgb(218, 161, 147);">La liste des services complémentaires est vide!</p>
    @endforelse

<!--debut Modal add services-->

    <div class="modal fade" id="exampleModalAddPoste" tabindex="-1" aria-labelledby="exampleModalAddPosteLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalAddPosteLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT D'AUTRES SERVICES</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{route('postService')}}" method="POST">

                    @method('post')
                    @csrf

                    <label class="form-label mt-3" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Le type de service</label>
                    <input type="text" class="form-control mt-3" name="type_service">
                    @if ($errors)
                    @error('type_service')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                    @enderror
                    @endif

                    <label class="form-label mt-3" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Description</label>
                    <textarea class="form-control" name="description" id="" cols="30" rows="5" placeholder="Ajouter une description ..."></textarea>
                    @if ($errors)
                    @error('description')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                    @enderror
                    @endif

                    <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer </button>
                    <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal" style='background-color:rgb(62, 7, 51); color: white;'>Retour</button>
            </div>
        </div>
        </div>
    </div>

<!--fin Modal add services-->

</div>

<div class="mt-5">
    {{ $liste_services -> links()}}
</div>


<!--fin card d'afficahge de services-->


@endsection
