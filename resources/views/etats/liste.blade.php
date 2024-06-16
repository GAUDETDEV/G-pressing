@extends('layouts/auth')
@section('title',"liste des états")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>


<!--debut bloc d'ajout de etat user-->

<div class="container">

        <div class="d-flex">

<!--debut bouton d'ajout d'etat user-->

            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAddUser" style="background-color:rgb(66, 16, 250); color: white;">
                <i class="fa-solid fa-plus"></i> Ajouter
            </button>

<!--debut modal add etat users -->
            <div class="modal fade" id="exampleModalAddUser" tabindex="-1" aria-labelledby="exampleModalAddUserLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT D'ETATS UTILISTAEURS</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{route('postEtatUser')}}" method="POST">

                            @method('post')
                            @csrf

                            <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Nom de l'état</label>
                            <select class="form-control mt-3" name="nom_etat_user" id="">
                                <option value="ACTIF">ACTIF</option>
                                <option value="INACTIF">INACTIF</option>
                            </select>

                            @if ($errors)
                                @error('nom_etat_user')
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

<!--fin bouton d'ajout de formule-->

<!--debut tableau d'afficahge d'etat user-->

        <table class="table mt-3 shadow rounded-5 caption-top">
            <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des états d'utilisateurs</strong></caption>
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
                @forelse ($etat_users as $etat_user)
                <tr>
                    <td>{{ $etat_user->id }}</td>
                    <td>{{ $etat_user->nom_etat_user }}</td>
                    <td>{{ $etat_user->created_at }}</td>
                    <td>{{ $etat_user->updated_at }}</td>
                    <td>
                        <a href="{{route('detailEtatUser',["etat_user"=>$etat_user->id])}}" title="details" style='color: rgb(14, 8, 4);'><i class="fa-solid fa-eye"></i></a><!--boutton details-->
                        <a href="{{route('deleteEtatUser',['etat_user'=>$etat_user->id])}}" type="button" title="supprimer" style='color: rgb(217, 6, 6);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
                    </td>
                </tr>

            </tbody>
            <tfoot>

            </tfoot>

            @empty

                <p class="text-center"><strong class="text-danger"> La liste des états utilisateurs est vite! <strong></p>

            @endforelse

        </table>

<!--fin tableau d'afficahge d'etat user-->

</div>

<!--fin bloc d'ajout de etat user-->



<!--debut bloc d'ajout de etat formule-->

<div class="container">

    <div class="d-flex">

<!--debut bouton d'ajout d'etat formule-->

            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAddEtatFormule" style="background-color:rgb(66, 16, 250); color: white;">
                <i class="fa-solid fa-plus"></i> Ajouter
            </button>

        </div>

<!--fin bouton d'ajout de formule-->

<!--debut modal add etat users -->
        <div class="modal fade" id="exampleModalAddEtatFormule" tabindex="-1" aria-labelledby="exampleModalAddEtatFormuleLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalAddEtatFormuleLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT D'ETATS FORMULES</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{route('postEtatFormule')}}" method="POST">

                        @method('post')
                        @csrf

                        <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Nom de l'état</label>
                        <select class="form-control mt-3" name="nom_etat_formule" id="">
                            <option value="DISPONIBLE">DISPONIBLE</option>
                            <option value="INDISPONIBLE">INDISPONIBLE</option>
                            <option value="ENCOURS">EN COURS...</option>
                        </select>

                        @if ($errors)
                            @error('nom_etat_formule')
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

<!--debut tableau d'afficahge d'etat formule-->

        <table class="table mt-3 shadow rounded-5 caption-top">
            <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des états de formules</strong></caption>
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
                @forelse ($etat_formules as $etat_formule)
                <tr>
                    <td>{{ $etat_formule->id }}</td>
                    <td>{{ $etat_formule->nom_etat_formule }}</td>
                    <td>{{ $etat_formule->created_at }}</td>
                    <td>{{ $etat_formule->updated_at }}</td>
                    <td>
                        <a href="{{route('detailEtatFormule',["etat_formule"=>$etat_formule->id])}}" title="details" style='color: rgb(14, 8, 4);'><i class="fa-solid fa-eye"></i></a><!--boutton details-->
                        <a href="{{route('deleteEtatFormule',['etat_formule'=>$etat_formule->id])}}" type="button" title="supprimer" style='color: rgb(217, 6, 6);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
                    </td>
                </tr>

            </tbody>
            <tfoot>

            </tfoot>

            @empty

                <p class="text-center"><strong class="text-danger"> La liste des états des formules est vite! <strong></p>

            @endforelse

        </table>

<!--fin tableau d'afficahge d'etat formule-->

</div>

<!--fin bloc d'ajout de etat formule-->


@endsection
