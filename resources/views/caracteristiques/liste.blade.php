@extends('layouts/auth')
@section('title',"liste catégories")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>


<!--debut bloc d'ajout de caractéristiques-->

<div class="container">

        <div class="d-flex">

<!--debut bouton d'ajout color-->

            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAddColor" style="background-color:rgb(66, 16, 250); color: white;">
                <i class="fa-solid fa-plus"></i> Ajouter
            </button>

<!--fin bouton d'ajout color-->

<!--debut modal add de color -->
            <div class="modal fade" id="exampleModalAddColor" tabindex="-1" aria-labelledby="exampleModalAddColorLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalAddColorLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE COULEURS DE VÊTEMENTS</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{route('postColor')}}" method="POST">

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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                    </div>

                </div>
                </div>
            </div>
<!--debut modal add etat users -->

        </div>

<!--debut tableau d'afficahge de couleur de vêtements-->

        <table class="table mt-3 shadow rounded-5 caption-top">
            <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des couleurs de vêtements</strong></caption>
            <thead>
                <tr>
                    <th>identifiants</th>
                    <th>Nom</th>
                    <th>Créer le</th>
                    <th>Modifier le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($color_vets as $color_vet)
                <tr>
                    <td>{{ $color_vet->id }}</td>
                    <td>{{ $color_vet->nom_couleur_vet }}</td>
                    <td>{{ $color_vet->created_at }}</td>
                    <td>{{ $color_vet->updated_at }}</td>
                    <td>
                        <a href="{{route('detailColor',["color_vet"=>$color_vet->id])}}" title="details" style='color: rgb(14, 8, 4);'><i class="fa-solid fa-eye"></i></a><!--boutton details-->
                        <a href="{{route('deleteColor',["color_vet"=>$color_vet->id])}}" type="button" title="supprimer" style='color: rgb(217, 6, 6);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
                    </td>
                </tr>

            </tbody>
            <tfoot>

            </tfoot>

            @empty

                <p class="text-center"><strong class="text-danger"> La liste des couleurs de vêtements est vite! <strong></p>

            @endforelse

        </table>

{{$color_vets->links()}}

<!--fin tableau d'afficahge de categories user-->

<!--fin bloc d'ajout de la categorie user-->


<!--debut bouton d'ajout specification vêtements-->

<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAddSpVet" style="background-color:rgb(66, 16, 250); color: white;">
    <i class="fa-solid fa-plus"></i> Ajouter
</button>

<!--fin bouton d'ajout de cat vet-->

<!--debut modal add cat vet -->
<div class="modal fade" id="exampleModalAddSpVet" tabindex="-1" aria-labelledby="exampleModalAddSpVetLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalSpVetLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE SPECIFICATIONS VÊTEMENTS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postSpVet')}}" method="POST">

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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
        </div>

    </div>
    </div>
</div>
<!--fin add modal add cat vet -->

<!--debut tableau d'afficahge de la categorie user-->

<table class="table mt-3 shadow rounded-5 caption-top">
    <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste de spécification de vêtements</strong></caption>
    <thead>
        <tr>
            <th>identifiants</th>
            <th>Nom</th>
            <th>Créer le</th>
            <th>Modifier le</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

        @forelse ($sp_vets as $sp_vet)
        <tr>
            <td>{{ $sp_vet->id }}</td>
            <td>{{ $sp_vet->nom_specification_vet }}</td>
            <td>{{ $sp_vet->created_at }}</td>
            <td>{{ $sp_vet->updated_at }}</td>
            <td>
                <a href="{{route('detailSp',["sp_vet"=>$sp_vet->id])}}" title="details" style='color: rgb(14, 8, 4);'><i class="fa-solid fa-eye"></i></a><!--boutton details-->
                <a href="{{route('deleteSp',["sp_vet"=>$sp_vet->id])}}" type="button" title="supprimer" style='color: rgb(217, 6, 6);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
            </td>
        </tr>

        @empty

            <p class="text-center"><strong class="text-danger"> La liste de specifications vêtements est vite! <strong></p>

        @endforelse

    </tbody>
    <tfoot>

    </tfoot>



    </table>

{{$sp_vets->links()}}

    <!--fin tableau d'afficahge de categories vêtements-->


<!--debut bouton d'ajout qualité vêtements-->

<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAddQualityVet" style="background-color:rgb(66, 16, 250); color: white;">
    <i class="fa-solid fa-plus"></i> Ajouter
</button>

<!--fin bouton d'ajout de qualité vet-->

<!--debut modal add qualité vet -->
<div class="modal fade" id="exampleModalAddQualityVet" tabindex="-1" aria-labelledby="exampleModalAddQualityVetLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalQualityVetLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE QUALITES</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postQualityVet')}}" method="POST">

                @method('post')
                @csrf

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Désignation</label>
                <input type="text" class="form-control mt-3" name="nom" placeholder="Ecrivez ici ...">
                @if ($errors)
                    @error('nom')
                        <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                    @enderror
                @endif

                <label class="form-label mt-3" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Description</label>
                <textarea class="form-control" name="description_quality" id="" cols="10" rows="5" placeholder="Ecrivez ici ..."></textarea>
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
        </div>

    </div>
    </div>
</div>
<!--fin add modal add qualité vet -->

<!--debut tableau d'afficahge de la qualité user-->

<table class="table mt-3 shadow rounded-5 caption-top">
    <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des qualités</strong></caption>
    <thead>
        <tr>
            <th>identifiants</th>
            <th>Désignation</th>
            <th>Créer le</th>
            <th>Modifier le</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

        @forelse ($quality_vets as $quality_vet)
        <tr>
            <td>{{ $quality_vet->id }}</td>
            <td>{{ $quality_vet->nom }}</td>
            <td>{{ $quality_vet->created_at }}</td>
            <td>{{ $quality_vet->updated_at }}</td>
            <td>
                <a href="" title="details" style='color: rgb(14, 8, 4);'><i class="fa-solid fa-eye"></i></a><!--boutton details-->
                <a href="" type="button" title="supprimer" style='color: rgb(217, 6, 6);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
            </td>
        </tr>

        @empty

            <p class="text-center"><strong class="text-danger"> La liste des qualités de vêtements est vite! <strong></p>

        @endforelse

    </tbody>
    <tfoot>

    </tfoot>



    </table>

{{$quality_vets->links()}}

<!--fin tableau d'afficahge de qualité vêtements-->


</div>

</div>

</div>

<!--fin bloc d'ajout de la categorie vêtements-->

<!--fin bloc d'ajout de catégories-->

@endsection
