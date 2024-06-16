@extends('layouts/auth')
@section('title',"Liste des factures")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut bouton d'ajout facture-->

<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAddFacture" style="background-color:rgb(66, 16, 250); color: white;">
    <i class="fa-solid fa-plus"></i> Ajouter
</button>

<!--fin bouton d'ajout facture-->

<!--debut modal add facture -->
<div class="modal fade" id="exampleModalAddFacture" tabindex="-1" aria-labelledby="exampleModalAddFactureLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddFactureLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE FACTURE</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postFacture')}}" method="POST">

                @method('post')
                @csrf

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Titulaire</label>
                <input type="text" class="form-control mt-3" name="nom_titulaire">
                @if ($errors)
                @error('nom_titulaire')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Téléphone</label>
                <input type="text" class="form-control mt-3" name="tel_titulaire">
                @if ($errors)
                @error('tel_titulaire')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Type de dépôt</label>
                <select class="form-control mt-3" name="id_type_depot" id="">
                    @forelse ($depots as $depot)
                    <option value="{{$depot->id}}">
                        @if ($depot->type_depot == "nombre")
                            Pour {{$depot->nbr_vet}} habits à {{$depot->prix_depot}} Francs CFA
                        @endif

                        @if ($depot->type_depot == "poids")
                            Pour {{$depot->poids_vet}} kilo(s) à {{$depot->prix_depot}} Francs CFA
                        @endif
                    </option>
                    @empty
                    <p class="text-center"><strong class="text-danger"> La liste des factures est vite! <strong></p>
                    @endforelse
                </select>
                @if ($errors)
                    @error('id_type_depot')
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
<!--fin modal add facture -->


<div class="mt-5">
    <table class="table table-striped shadow">
        <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des factures</strong></caption>
        <thead>
            <tr>
                <th class="text-primary">N°</th>
                <th class="text-primary">Titulaire</th>
                <th class="text-primary">Téléphone</th>
                <th class="text-primary">Créer le</th>
                <th class="text-primary">Mis à jour le</th>
                <th class="text-primary">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($factures as $facture)
            <tr>
                <td>{{ $facture->id}}</td>
                <td>{{ $facture->nom_titulaire}}</td>
                <td>{{ $facture->tel_titulaire}}</td>
                <td>{{ $facture->created_at}}</td>
                <td>{{ $facture->updated_at}}</td>
                <td>
                    <a href="{{route('editFacture',["facture" => $facture->id])}}" type="button" class="btn" title="Editer" style='color: rgb(255, 255, 255); background-color:rgb(4, 96, 216);'><i class="fa-solid fa-pen-to-square"></i></a><!--boutton éditer-->
                    <a href="" type="button" class="btn" title="Modifier" style='color: rgb(255, 255, 255); background-color:rgb(14, 103, 76);'><i class="fa-solid fa-pen-nib"></i></a><!--boutton modifier-->
                    <a href="" type="button" class="btn" title="Détails" style='color: rgb(255, 255, 255); background-color:rgb(28, 8, 79);'><i class="fa-solid fa-eye"></i></a><!--boutton détails-->
                    <a href="" type="button" class="btn" title="Supprimer" style='color: rgb(255, 255, 255); background-color:rgb(62, 4, 7);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <p class="text-center"><strong class="text-danger"> La liste des factures est vite! <strong></p>
                </td>
            </tr>
            @endforelse

        </tbody>
        <tfoot>

        </tfoot>
    </table>
    <tr>
        <a type="button" class="btn" href="" style='color: rgb(255, 255, 255); background-color: rgb(5, 5, 5); margin: 5px;'>Imprimer</a>
    </tr>
</div>


@endsection
