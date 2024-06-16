@extends('layouts/auth')
@section('title',"liste postes")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<div class="d-flex">

<!--bouton d'ajout de packs-->

    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAddPoste" style="background-color:rgb(66, 16, 250); color: white;">
        <i class="fa-solid fa-plus"></i> Ajouter
    </button>

<!-- Button trigger modal -->
    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style='background-color:rgb(240, 0, 0); color: rgb(244, 244, 244); margin-left: 3px;'>
        <i class="fa-solid fa-broom"></i> Nettoyage complet
    </button>

</div>


<!-- Debut Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel" style='color:rgb(240, 0, 0);'>Attention <i class="fa-solid fa-2x fa-circle-info" style='color:rgb(240, 0, 0);'></i></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-5 text-danger">
                Tous les postes seront supprimés!
            </div>
            <div class="modal-footer">
            <a class="btn btn-primary" href="{{route('geantTruncatePoste')}}"><i class="fa-solid fa-check"></i> Je confirme</a>
            <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-rotate-left"></i> Annuler</button>
            </div>
        </div>
    </div>
  </div>
<!-- Fin Modal -->



<!--debut card d'afficahge de packs-->

<div class="row row-cols-1 row-cols-md-3 g-4 mt-4">

    @forelse ( $postes as $poste)
        <div class="col">
            <div class="card h-100 shadow" style="background-color:rgb(1, 0, 1);">
                <div class="card-body">

                    <div class="card-text rounded mb-3" style="background-color:rgb(6, 76, 125); padding: 2px;">
                        <p style=" color:white; font-weight: bold; border-radius: 5px; padding:7px;"><strong> Titre:</strong> <span style="font-size: 2em; color:rgb(166, 212, 245); font-weight: bold;">{{$poste->titre_poste}}</span></p>
                        <p style=" color:white; font-weight: bold; border-radius: 5px; padding:7px;"><strong> Salaire :</strong> <span style="font-size: 2em; color:rgb(166, 212, 245); font-weight: bold;">{{$poste->salaire_poste}} Francs</span></p>
                    </div>

                    <p style=" color:rgb(6, 76, 125); font-weight: bold; border-radius: 5px; padding:7px;"><strong> Description :</strong> </p>
                    <div class="card-text rounded mt-2" style="background-color:rgb(6, 76, 125); padding: 5px; height: 30%;">
                        <p style="font-size: 15px; color:rgb(166, 212, 245); font-weight: bold; border-radius: 3px;"><span>{!! nl2br(e($poste->desc_poste)) !!}</span></p>
                    </div>

                </div>
                <div class="card-footer mt-5">

                <a href="{{route('modifyPoste',['poste' => $poste->id])}}" type="button" class="btn mt-5" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(26, 12, 87);"><i class="fa-solid fa-pen"></i> Modifier</a>

                </div>
            </div>
        </div>
    @empty
        <p class="text-center" style="color:rgb(151, 37, 19); padding: 5px; background-color:rgb(218, 161, 147);">La liste des postes est vide!</p>
    @endforelse

<!--debut Modal add packs-->
    <div class="modal fade" id="exampleModalAddPoste" tabindex="-1" aria-labelledby="exampleModalAddPosteLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalAddPosteLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE POSTES</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{route('postPoste')}}" method="POST">

                    @method('post')
                    @csrf

                    <label class="form-label mt-3" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Le titre</label>
                    <select class="form-select" name="titre_poste" id="">
                        <option value="receptionniste">Réceptionniste</option>
                        <option value="laveur">Laveur</option>
                        <option value="repasseur">Répasseur</option>
                        <option value="livreur">Livreur</option>
                    </select>

                    <label class="form-label mt-3" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Description</label>
                    <textarea class="form-control" name="desc_poste" id="" cols="30" rows="5" placeholder="Description du poste ..."></textarea>
                    @if ($errors)
                    @error('desc_poste')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                    @enderror
                    @endif

                    <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Salaire</label>
                    <input type="number" class="form-control mt-3" name="salaire_poste">
                    @if ($errors)
                    @error('salaire_poste')
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

<!--fin Modal add packs-->

</div>

<div class="mt-5">
    {{ $postes -> links()}}
</div>


<!--fin card d'afficahge de packs-->


@endsection
