@extends('layouts/auth')
@section('title',"edit facture")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut formulaire d'ajout vet-->

<div class="container mt-3">

    @if ($vet_recept)
        <a href="{{route('receptFactureClassic',["facture"=>$facture->id])}}" type="button" class="btn" style="background-color:rgb(66, 16, 250); color: white;">
            <i class="fa-solid fa-list"></i> Liste des vêtements receptionnés pour la facture n°{{$facture->id}}
        </a>
    @endif


    <form action="{{route('postRecept',["facture"=>$facture->id])}}" method="POST" class="container shadow rounded-3" style="width:100%; margin-top:5%; padding: 5em; background-color: rgb(255, 255, 255);">

<!--debut boutons d'ajout d'options de reception-->

    <div class="container">
        <div class="container rounded-2 shadow" style="width:100%; padding: 1em; background-color: rgb(7, 40, 130);">
            <h1 class="modal-title fs-5" style="color:rgb(248, 248, 248); font-weight: bold; "><i class="fa-solid fa-gear"></i> OPTIONS DE RECEPTION</h1>
            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalAddVet" class="btn" href="" style='color: rgb(255, 255, 255); background-color: rgb(5, 97, 150); margin: 5px;'><i class="fa-solid fa-plus"></i> Types vêtements</a>
            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalAddColor" class="btn" href="" style='color: rgb(255, 255, 255); background-color: rgb(5, 97, 150); margin: 5px;'><i class="fa-solid fa-plus"></i> Couleurs</a>
            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalAddSp" class="btn" href="" style='color: rgb(255, 255, 255); background-color: rgb(5, 97, 150); margin: 5px;'><i class="fa-solid fa-plus"></i> Spécifications</a>
            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalAddCatVet" class="btn" href="" style='color: rgb(255, 255, 255); background-color: rgb(5, 97, 150); margin: 5px;'><i class="fa-solid fa-plus"></i> Catégories</a>
            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalAddQualityVet" class="btn" href="" style='color: rgb(255, 255, 255); background-color: rgb(5, 97, 150); margin: 5px;'><i class="fa-solid fa-plus"></i> Textile</a>
        </div>
    </div>

<!--fin boutons d'ajout d'options de reception-->

        <h1 class="modal-title fs-5 mt-5" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">RECEPTION DE VÊTEMENTS DE LA FACTURE N° {{$facture->id}}</h1>

        @method('post')
        @csrf

        <div class="row">

            <div class="col">

                <label for="" class="form-label mt-3" style="color:rgb(65, 5, 145); font-weight: bold;">Date de reception</label>
                <input type="date" class="form-control mt-3" name="created_at" value="{{$today}}">
                @if ($errors)
                @error('created_at')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif


                <label for="" class="form-label mt-3" style="color:rgb(65, 5, 145); font-weight: bold;">Nom du vêtement</label>
                <select class="form-select mt-3" name="nom_vet" id="">
                    @forelse ($vetements as $vetement)
                    <option value="{{$vetement->nom_vet}}">{{$vetement->nom_vet}}</option>
                    @empty
                    <p class="text-center"><strong class="text-danger"> La liste des vêtements est vite! <strong></p>
                    @endforelse
                </select>

            </div>

            <div class="col">

                <label for="" class="form-label mt-3" style="color:rgb(65, 5, 145); font-weight: bold;">La couleur</label>
                <select class="form-select mt-3" name="color_vet" id="">
                    @forelse ($couleurs as $couleur)
                    <option value="{{$couleur->nom_couleur_vet}}">{{$couleur->nom_couleur_vet}}</option>
                    @empty
                    <p class="text-center"><strong class="text-danger"> La liste des couleurs est vite! <strong></p>
                    @endforelse
                </select>
                @if ($errors)
                @error('color_vet')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color:rgb(65, 5, 145); font-weight: bold;">Spécification</label>
                <select class="form-select mt-3" name="caract_vet" id="">
                    @forelse ($caracts as $caract)
                    <option value="{{$caract->nom_specification_vet}}">{{$caract->nom_specification_vet}}</option>
                    @empty
                    <p class="text-center"><strong class="text-danger"> La liste des spécifications est vite! <strong></p>
                    @endforelse
                </select>
                @if ($errors)
                @error('caract_vet')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif


            </div>

            <div class="col">

                <label for="" class="form-label mt-3" style="color:rgb(65, 5, 145); font-weight: bold;">Textile</label>
                <select class="form-select mt-3" name="quality_vet" id="">
                    @forelse ($quality_vets as $quality_vet)
                    <option value="{{$quality_vet->nom}}">{{$quality_vet->nom}}</option>
                    @empty
                    <p class="text-center"><strong class="text-danger"> La liste des textiles est vite! <strong></p>
                    @endforelse
                </select>


                <input type="number" class="form-control mt-5" name="qte_vet" placeholder="La quantité">
                @if ($errors)
                @error('qte_vet')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

            </div>

        </div>

        <div class="row">

            <div class="col">

                <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer</button>
                <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

            </div>

        </div>


    </form>

</div>

<!--fin formulaire d'ajout vet-->


<!--debut liste des modal d'ajout d'options reception-->

<!--debut Modal add vets-->
<div class="modal fade" id="exampleModalAddVet" tabindex="-1" aria-labelledby="exampleModalAddVetLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddVetLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE VÊTEMENTS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postOptionVetClassic')}}" method="POST" >

                @method('post')
                @csrf

                <input type="text" class="form-control mt-3" name="nom_vet" placeholder="Le nom du vêtement">
                @if ($errors)
                @error('nom_vet')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <input type="number" class="form-control mt-3" name="prix_vet" placeholder="Prix du vêtement">
                @if ($errors)
                @error('prix_vet')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3">Catégorie</label>
                <select class="form-select" name="id_cat_vet" id="">
                    @forelse ($cat_vets as $cat_vet)
                    <option value="{{ $cat_vet->id }}">{{ $cat_vet->nom_cat_vet}}</option>
                    @empty
                    <p class="text-center"><strong class="text-danger"> La liste des catégories de vêtements est vite! <strong></p>
                    @endforelse
                </select>
                @if ($errors)
                @error('id_cat_vet')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer</button>
                <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>
            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal" style='background-color:rgb(62, 7, 51); color: white;'>Retour</button>
        </div>
    </div>
    </div>
</div>
<!--fin Modal add vets-->


<!--debut Modal add color-->
<div class="modal fade" id="exampleModalAddColor" tabindex="-1" aria-labelledby="exampleModalAddColorLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddColorLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE COULEURS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postOptionColorClassic')}}" method="POST">

                @method('post')
                @csrf

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Nom de la couleur</label>
                <input type="text" class="form-control mt-3" name="nom_couleur_vet">

                @if ($errors)
                    @error('nom_couleur_vet')
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
<!--fin Modal add color-->


<!--debut Modal add spcefic-->
<div class="modal fade" id="exampleModalAddSp" tabindex="-1" aria-labelledby="exampleModalAddSpLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddSpLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE SPECIFICATIONS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postOptionSpVetClassic')}}" method="POST">

                @method('post')
                @csrf

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Nom de la spécification</label>
                <input type="text" class="form-control mt-3" name="nom_specification_vet">

                @if ($errors)
                    @error('nom_specification_vet')
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
<!--fin Modal add spcefic-->

<!--debut Modal add cat vet-->
<div class="modal fade" id="exampleModalAddCatVet" tabindex="-1" aria-labelledby="exampleModalAddCatVetLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddCatVetLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE CATEGORIES DE VÊTEMENTS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postOptionCatVetClassic')}}" method="POST">

                @method('post')
                @csrf

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Nom de la catégorie</label>
                <input type="text" class="form-control mt-3" name="nom_cat_vet">

                @if ($errors)
                    @error('nom_cat_vet')
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
<!--fin Modal add cat vet-->


<!--debut Modal add textile vet-->

<div class="modal fade" id="exampleModalAddQualityVet" tabindex="-1" aria-labelledby="exampleModalAddQualityVetLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddQualityVetLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT LE TYPE DE TEXTILE DE VÊTEMENTS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postOptionQualityVetClassic')}}" method="POST">

                @method('post')
                @csrf

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Type</label>
                <input type="text" class="form-control mt-3" name="nom">
                @if ($errors)
                    @error('nom')
                        <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                    @enderror
                @endif

                <label class="form-label" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Description</label>
                <textarea class="form-control" name="description_quality" id="" cols="10" rows="5" placeholder="Donnez une description ici ..."></textarea>
                @if ($errors)
                    @error('description_quality')
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
<!--fin Modal add textile vet-->


<!--fin liste des modal d'ajout d'options de reception-->


@endsection
