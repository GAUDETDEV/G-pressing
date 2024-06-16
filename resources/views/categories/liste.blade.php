@extends('layouts/auth')
@section('title',"liste catégories")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>


<!--debut bloc d'ajout de catégories-->

<div class="container">

@if ( Auth::user()->role == "sudo" )

        <div class="d-flex">

<!--debut bouton d'ajout d'etat user-->

            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAddCatUser" style="background-color:rgb(66, 16, 250); color: white;">
                <i class="fa-solid fa-plus"></i> Ajouter
            </button>

<!--fin bouton d'ajout de formule-->

<!--debut modal add etat users -->
            <div class="modal fade" id="exampleModalAddCatUser" tabindex="-1" aria-labelledby="exampleModalAddCatUserLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalAffCatUserLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE CATEGORIES UTILISTAEURS</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{route('postCatUser')}}" method="POST">

                            @method('post')
                            @csrf

                            <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Nom de la catégorie</label>
                            <select class="form-control mt-3" name="nom_cat_user" id="">
                                <option value="ADMIN">ADMIN</option>
                                <option value="GERANT">GERANT</option>
                                <option value="EMPLOYER">EMPLOYER</option>
                                <option value="CLIENT">CLIENT</option>
                            </select>

                            @if ($errors)
                                @error('nom_cat_user')
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

<!--debut tableau d'afficahge dela categorie user-->

        <table class="table mt-3 shadow rounded-5 caption-top">
            <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des catégories d'utilisateurs</strong></caption>
            <thead>
                <tr>
                    <th>identifiant(s)</th>
                    <th>Nom</th>
                    <th>Créer le</th>
                    <th>Modifier le</th>
                    <th>Action(s)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cat_users as $cat_user)
                <tr>
                    <td>{{ $cat_user->id }}</td>
                    <td>{{ $cat_user->nom_cat_user }}</td>
                    <td>{{ $cat_user->created_at }}</td>
                    <td>{{ $cat_user->updated_at }}</td>
                    <td>
                        <a href="{{route('detailCatUser',["cat_user"=>$cat_user->id])}}" title="details" style='color: rgb(14, 8, 4);'><i class="fa-solid fa-eye"></i></a><!--boutton details-->
                        <a href="" type="button" title="supprimer" style='color: rgb(217, 6, 6);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
                    </td>
                </tr>

            </tbody>
            <tfoot>

            </tfoot>

            @empty

                <p class="text-center"><strong class="text-danger"> La liste des catégories d'utilisateurs est vite! <strong></p>

            @endforelse

        </table>

@endif

<!--fin tableau d'afficahge de categories user-->

<!--fin bloc d'ajout de la categorie user-->


@if (Auth::user()->role == "gerant")



<!--debut bouton d'ajout d'etat vêtements-->

<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAddCatVet" style="background-color:rgb(66, 16, 250); color: white;">
    <i class="fa-solid fa-plus"></i> Ajouter
</button>

<!--fin bouton d'ajout de cat vet-->





<!--debut modal add cat vet -->
<div class="modal fade" id="exampleModalAddCatVet" tabindex="-1" aria-labelledby="exampleModalAddCatVetLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAffCatVetLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE CATEGORIES VÊTEMENTS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postCatVet')}}" method="POST">

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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
        </div>

    </div>
    </div>
</div>
<!--fin add modal add cat vet -->

<!--debut tableau d'afficahge de la categorie user-->

<table class="table mt-3 shadow rounded-5 caption-top">
    <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des catégories de vêtements</strong></caption>
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

        @forelse ($cat_vets as $cat_vet)
        <tr>
            <td>{{ $cat_vet->id }}</td>
            <td>{{ $cat_vet->nom_cat_vet }}</td>
            <td>{{ $cat_vet->created_at }}</td>
            <td>{{ $cat_vet->updated_at }}</td>
            <td>
                <a href="{{route('modifyCatVet',["cat_vet"=>$cat_vet->id])}}" type="button" title="modifier" style='color: rgb(6, 96, 57);'><i class="fa-solid fa-pen-nib"></i></a><!--boutton modifier-->
                <a href="{{route('detailCatVet',["cat_vet"=>$cat_vet->id])}}" title="details" style='color: rgb(14, 8, 4);'><i class="fa-solid fa-eye"></i></a><!--boutton details-->
                <a href="{{route('deleteCatVet',["cat_vet"=>$cat_vet->id])}}" type="button" title="supprimer" style='color: rgb(217, 6, 6);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
            </td>
        </tr>

    </tbody>
    <tfoot>

    </tfoot>

    @empty

        <p class="text-center"><strong class="text-danger"> La liste des catégories de vêtements est vite! <strong></p>

    @endforelse

    </table>

{{ $cat_vets->links() }}

    <!--fin tableau d'afficahge de categories vêtements-->

</div>

</div>












@endif






</div>

<!--fin bloc d'ajout de la categorie vêtements-->

<!--fin bloc d'ajout de catégories-->

@endsection
