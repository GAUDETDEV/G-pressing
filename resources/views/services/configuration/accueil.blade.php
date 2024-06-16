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

    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAddVet" style="background-color:rgb(66, 16, 250); color: white;">
        <i class="fa-solid fa-plus"></i> Ajouter
    </button>

</div>

<!--debut Modal add services-->

<div class="container mt-5">

<div class="modal fade" id="exampleModalAddVet" tabindex="-1" aria-labelledby="exampleModalAddVetLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddVetLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE VÊTEMENTS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postVetService',['service' => $service->id])}}" method="POST">

                @method('post')
                @csrf

                <label class="form-label mt-3" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Le type de vêtements</label>
                <input type="text" class="form-control mt-3" name="nom_vet">
                @if ($errors)
                @error('nom_vet')
                <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label class="form-label mt-3" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Catégorie(s)</label>
                <select class="form-select" name="id_cat_vet" id="">
                    @foreach ($liste_cat_vets as $liste_cat_vet)
                    <option value="{{$liste_cat_vet->id}}">{{$liste_cat_vet->nom_cat_vet}}</option>
                    @endforeach
                </select>

                <label class="form-label mt-3" for="" style="color:rgb(58, 32, 60); font-weight: bold;">Prix</label>
                <input type="number" id="" class="form-control" name="prix_vet" placeholder="En francs CFA">
                @if ($errors)
                @error('prix_vet')
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

</div>

<!--fin Modal add services-->



<!--debut tableau d'afficahge de vêtements-->
<div class="container">

    <table class="table table-striped" >
        <thead>
            <tr>
                <th>Type de vêtements</th>
                <th>Prix</th>
                <th>Ajouter le</th>
                <th>Mis à jour le</th>
                <th>Action(s)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($liste_vets as $liste_vet)

            <tr>
                <td>{{ $liste_vet->nom_vet }}</td>
                <td>{{ $liste_vet->prix_vet }} Francs</td>
                <td>{{ $liste_vet->created_at }}</td>
                <td>{{ $liste_vet->updated_at }}</td>
                <td>
                    <a href="{{route('modifyVetService',['vetement' => $liste_vet->id])}}" type="btn" style="color:rgb(0, 63, 119);" title="modifier"><i class="fa-solid fa-pen-nib"></i></a>
                    <a href="{{route('deleteVetService',['vetement' => $liste_vet->id])}}" type="btn" style="color:rgb(230, 2, 2);" title="supprimer"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>

            @empty
                <tr>
                    <td colspan="5" class="text-center" style="color:rgb(230, 2, 2); font-weight: bold;">
                        Oups! la liste des vêtements est vide.
                    </td>
                </tr>
            @endforelse
            <tr>

            </tr>

        </tbody>
        <tfoot>


        </tfoot>
    </table>
</div>

<!--fin tableau d'afficahge de vêtements-->


@endsection














