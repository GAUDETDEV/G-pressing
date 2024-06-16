@extends('layouts/auth')
@section('title',"liste formules")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<div class="d-flex">

<!--bouton d'ajout de formule-->

    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color:rgb(66, 16, 250); color: white;">
        <i class="fa-solid fa-plus"></i> Ajouter
    </button>

</div>

<!--debut card d'afficahge de formules-->

<div class="row row-cols-1 row-cols-md-3 g-4 mt-4">

    @forelse ( $formules as $formule)
        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h4 class="card-titles" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125);">{{$formule->nom_formule}}</h4>
                    <div class="card-text">
                        <p style="background-color:rgb(6, 76, 125); color:white; font-weight: bold; border-radius: 5px; padding:7px;"><strong>A seulement :</strong> <span style="font-size: 2em; color:rgb(166, 212, 245); font-weight: bold;">{{$formule->prix_formule}} Francs </span></p>
                        <p><strong>Avec un nombre d'utilisateurs :</strong> {{$formule->nbr_user}}</p>
                        <p><strong>Et un nombre d'essai :</strong> {{$formule->nbr_essai}}</p>
                        <p><strong>Pour une période de :</strong> {{$formule->periode}} jours d'utilisation.</p>
                        <p><strong>Proposant les fonctionnalités suivantes :</strong></p>
                    </div>
                    <p class="card-text" style="color:white; background-color:rgb(6, 76, 125); border-radius: 5px; padding:7px; width: 100%; height:50%;">{!! nl2br(e($formule->fonctionnalite)) !!}</p>
                </div>
                <div class="card-footer">

                <a href="{{route('modifyFormule',['formule' => $formule->id,])}}" type="button" class="btn mt-5" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(26, 12, 87);"><i class="fa-solid fa-pen"></i> Modifier</a>
                <a href="{{route('detailFormule',['formule' => $formule->id,])}}" type="button" class="btn mt-5" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(20, 58, 33);"><i class="fa-solid fa-eye"></i> Voir plus</a>
                <a href="{{route('deleteFormule',['formule'=>$formule->id])}}" type="button" class="btn mt-5" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(168, 92, 0);"><i class="fa-solid fa-trash"></i> Supprimer</a>

                </div>
            </div>
        </div>
    @empty
        <p class="text-center" style="color:rgb(151, 37, 19); padding: 5px; background-color:rgb(218, 161, 147);">La liste des formules est vide!</p>
    @endforelse

<!--debut Modal add formule-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE FORMULES</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{route('postFormule')}}" method="POST">

                    @method('post')
                    @csrf
                    <div class="row">
                        <div class="col">

                            <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Nom de la formule</label>
                            <input type="text" class="form-control mt-3" name="nom_formule">
                            @if ($errors)
                            @error('nom_formule')
                                <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                            @enderror
                            @endif
                            <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Prix / Mois</label>
                            <input type="number" class="form-control mt-3" name="prix_formule">
                            @if ($errors)
                            @error('prix_formule')
                                <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                            @enderror
                            @endif
                            <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Nombre d'utilisateurs</label>
                            <input type="text" class="form-control mt-3" name="nbr_user">
                            @if ($errors)
                            @error('nbr_user')
                                <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                            @enderror
                            @endif

                            <label class="form-label mt-3" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Nombre d'essais</label>
                            <select class="form-select" name="nbr_essai" id="">
                                <option value="1">1 seule fois</option>
                                <option value="illimité">Illimité</option>
                            </select>

                        </div>
                        <div class="col">

                            <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">La durée (nombre de jours)</label>
                            <input type="number" class="form-control mt-3" name="periode">
                            @if ($errors)
                            @error('periode')
                                <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                            @enderror
                            @endif
                            <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Les fonctionnalités</label>
                            <textarea name="fonctionnalite" id="" cols="30" rows="10" class="form-control mt-3"></textarea>
                            @if ($errors)
                            @error('fonctionnalite')
                                <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                            @enderror
                            @endif

                        </div>
                    </div>

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
<!--fin Modal add formule-->

</div>

<!--fin card d'afficahge de formules-->

@endsection
