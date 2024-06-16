@extends('layouts/auth')
@section('title',"detail")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut affichage du details tache-->

<div class="container mt-3">

    <div class="text-center rounded-2 shadow" style="color:rgb(246, 246, 246); background-color:rgb(9, 9, 75); padding: 5px;">
        <h2 style="color:rgb(255, 255, 255);">LES DETAILS SUR LA TÂCHE</h2>
    </div>

    @if ($tache->type_tache == "reception")


    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations sur l'executant</h3>
        <div class="card-body">
            <p><strong>Nom : </strong>{{ $info_executant->name }}</p>
            <p><strong>Email : </strong>{{ $info_executant->email }}</p>
            <p><strong>Téléphone : </strong>{{ $info_executant->telephone }}</p>
            <p><strong>Entreprise : </strong>{{ $info_executant->entreprise }}</p>
            <p><strong>Poste : </strong>{{ $info_poste->titre_poste }}</p>
        </div>
    </div>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations sur la tâche</h3>
        <div class="card-body">

            @if ($today < $tache->fin_tache and $tache->etat_tache == "En attente")
            <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(4, 96, 216); padding: 5px; border-radius: 3px;">{{$tache->etat_tache}} ... </span></p>
            @endif
            @if ($today < $tache->fin_tache and $tache->etat_tache == "Terminée")
            <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(10, 190, 31); padding: 5px; border-radius: 3px;">Terminée <i class="fa-solid fa-check"></i></span></p>
            @endif
            @if ($today >= $tache->fin_tache and $tache->etat_tache == "En attente")
            <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(185, 16, 25); padding: 5px; border-radius: 3px;">Non éffectuée <i class="fa-solid fa-xmark"></i></span></p>
            @endif
            @if ($today >= $tache->fin_tache and $tache->etat_tache == "Terminée")
            <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(10, 190, 31); padding: 5px; border-radius: 3px;">Terminée <i class="fa-solid fa-check"></i></span></p>
            @endif

            <p><strong>début : </strong>{{ $tache->debut_tache }}</p>
            <p><strong>Fin : </strong>{{ $tache->fin_tache }}</p>


            @if ($today < $tache->fin_tache and $tache->etat_tache == "En attente")

            <form action="{{route('marquerAllTache',['tache' => $tache->id])}}" method="POST">

                @method('put')
                @csrf

                <div class="container">

                    <div class="container">
                        <input style="display: none;" type="text" class="form-control mt-3" name="etat_tache" value="Terminée">
                    </div>

                    <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> J'execute ma tâche </button>

                </div>

            </form>

            @endif

        </div>

    </div>

    @endif



    @if ($tache->type_tache == "lavage")

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations sur la facture</h3>
        <div class="card-body">
            <div class="row" style="background-color:rgb(87, 87, 242); border-left: 20px solid rgb(37, 7, 159);">
                <div class="col">
                    <p><strong style="color: rgb(212, 191, 232);">Facture N° </strong><span style="color: white;">{{ $infos_facture->id }}</span></p>
                    <p><strong style="color: rgb(212, 191, 232);">Non du client : Mr/mme </strong><span style="color: white;">{{ $infos_facture->nom_titulaire }}</span></p>
                    <p><strong style="color: rgb(212, 191, 232);">Téléphone : </strong><span style="color: white;">{{ $infos_facture->tel_titulaire }}</span></p>
                </div>
                <div class="col">
                    <p><strong style="color: rgb(212, 191, 232);">Date de retrait : </strong><span style="color: white;">{{ $infos_facture->date_retrait }}</span></p>
                    <p><strong style="color: rgb(212, 191, 232);">Rédigé par : Mr/mme </strong><span style="color: white;">{{ $infos_receptionist->name }}</span></p>
                    <p><strong style="color: rgb(212, 191, 232);">A la date du: </strong><span style="color: white;">{{ $infos_facture->created_at }}</span></p>
                </div>
            </div>

            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Type(s) de vêtement(s)</th>
                            <th>Couleur(s)</th>
                            <th>Spécificité(s)</th>
                            <th>Catégorie(s)</th>
                            <th>Qte(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($info_vet_recepts as $info_vet_recept)
                        <tr>
                            <td>{{$info_vet_recept->nom_vet}}</td>
                            <td>{{$info_vet_recept->color_vet}}</td>
                            <td>{{$info_vet_recept->caract_vet}}</td>
                            <td>{{$info_vet_recept->cat_vet}}</td>
                            <td>{{$info_vet_recept->qte_vet}}</td>
                        </tr>
                        @empty
                            <strong class="text-center" style="color: rgb(209, 17, 17);">La liste des vêtements est vide</strong>
                        @endforelse
                        <tr>
                            <td colspan="4" style="color: blue; font-weight: bold; font-size: 20px;">Total de vêtements</td>
                            <td colspan="1" style="color: rgb(248, 248, 248); font-size: 30px; background-color:rgb(1, 42, 95); font-weight: bold;">{{$total_vets}}</td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    @endif

</div>

<!--fin affichage du details tache-->

@endsection
