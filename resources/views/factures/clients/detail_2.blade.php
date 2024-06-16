@extends('layouts/auth')
@section('title',"detail")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut affichage du details facture-->

<div class="container mt-3">

    <div class="text-center rounded-2 shadow" style="color:rgb(246, 246, 246); background-color:rgb(9, 9, 75); padding: 10px;">
        <h2 style="color:rgb(255, 255, 255);"> LES DETAILS DE LA FACTURE N° {{ $facture->id }} </h2>
    </div>


    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations sur la facture</h3>
        <div class="card-body">

            <div class="row text-center">

                <div class="col-xl-4 col-lg-4 col-md-12">
                    <p style="color: rgb(67, 2, 47); font-weight: bold; font-size: 20px;">Etat</p>

                        @if($facture->statut_facture == "Régler") <span style="color:aliceblue; background-color:rgb(13, 175, 43); padding: 5px; border-radius: 3px;"> Régler  </span> @endif
                        @if($facture->statut_facture == "Non régler") <span style="color:aliceblue; background-color:rgb(209, 65, 9); padding: 5px; border-radius: 3px;"> Non régler  </span> @endif
                        @if($facture->statut_facture == "") <span style="color:aliceblue; background-color:rgb(3, 0, 8); padding: 5px; border-radius: 3px;"> En attente de validation  </span> @endif

                </div>
                <div class="col-xl-4 col-lg-4 col-md-12">

                    <p style="color: rgb(0, 0, 0); font-weight: bold; font-size: 20px;">Montant</p>

                        @if ($facture->avance == 0)
                        <span style="color:rgb(255, 0, 0); background-color:rgb(249, 248, 186); padding: 5px; border-radius: 3px; font-size: 20px; font-weight: bold;">
                            {{$facture->montant}} frs
                        </span>
                        @else
                        <span style="color:rgb(255, 0, 0); background-color:rgb(249, 248, 186); padding: 5px; border-radius: 3px; font-size: 20px; font-weight: bold;">
                            {{$facture->montant - $avance}} frs
                        </span>
                        @endif

                </div>
                <div class="col-xl-4 col-lg-4 col-md-12">

                    <p style="color: rgb(67, 2, 47); font-weight: bold; font-size: 20px;">Avance</p>

                        <span style="color:aliceblue; background-color:rgb(20, 19, 19); padding: 5px; border-radius: 3px;">{{$facture->montant - $facture->reste}} frs</span>

                </div>

            </div>

            <div class="row text-center mt-5">

                <div class="col-xl-4 col-lg-4 col-md-12">

                    <p style="color: rgb(67, 2, 47); font-weight: bold; font-size: 20px;">Reste</p>

                        <span style="color:aliceblue; background-color:rgb(20, 19, 19); padding: 5px; border-radius: 3px;"> {{$facture->reste}} frs  </span>

                </div>
                <div class="col-xl-4 col-lg-4 col-md-12">

                    <p style="color: rgb(67, 2, 47); font-weight: bold; font-size: 20px;">Création</p>

                        <span style="color:aliceblue; background-color:rgb(20, 19, 19); padding: 5px; border-radius: 3px;"> {{$facture->created_at}} </span>

                </div>
                <div class="col-xl-4 col-lg-4 col-md-12">

                    <p style="color: rgb(67, 2, 47); font-weight: bold; font-size: 20px;">Retrait</p>

                        <span style="color:aliceblue; background-color:rgb(20, 19, 19); padding: 5px; border-radius: 3px;"> {{$facture->date_retrait}} </span>

                </div>

            </div>


        </div>


    </div>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations sur le client</h3>
        <div class="card-body">
            <p><strong>Nom : </strong>{{ $facture->nom_titulaire }}</p>
            <p><strong>Téléphone : </strong>{{ $facture->tel_titulaire }}</p>
        </div>
    </div>


    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations sur le receptionniste</h3>
        <div class="card-body">
            <p><strong>Nom : </strong>{{ $infos_receptionist->name }}</p>
            <p><strong>Email : </strong>{{ $infos_receptionist->email }}</p>
            <p><strong>Téléphone : </strong>{{ $infos_receptionist->telephone }}</p>
            <p><strong>Entreprise : </strong>{{ $infos_receptionist->entreprise }}</p>
            <p><strong>Poste : </strong>{{ $infos_receptionist->role }}</p>
        </div>
    </div>


    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations sur la livraison</h3>
        <div class="card-body">

            @if ($facture->etat_livraison == "Oui")


                <div class="row">
                    <div class="col">
                        <p><strong>Destinataire : </strong> Mr/Mlle {{ $info_livraison->nom_destinataire }}</p>
                        <p><strong>Téléphone : </strong>{{ $facture->tel_titulaire }}</p>
                        <p><strong>Commune : </strong>{{ $commune_livraison->nom_commune }}</p>
                        <p><strong>Quartier : </strong>{{ $quartier_livraison->nom_quartier }}</p>
                    </div>
                    <div class="col">
                        <p><strong>Adresse : </strong>{{ $adresse_livraison->nom_adresse }}</p>
                        <p><strong>Frais de livraison : </strong> <span style="color: red; font-weight: bold;">{{ $prix_livraison }} Frs</span> </p>
                        <p><strong>Date : </strong>{{ $info_livraison->date_livraison }}</p>
                        <p><strong>Heure : </strong>{{ $info_livraison->heure_livraison }}</p>
                    </div>
                </div>

                <form action="{{route("clientPutEtatLivraison",['facture' => $facture->id])}}" method="post">
                    @method('put')
                    @csrf
                    <input type="text" name="etat_livraison" value="Non" style="display: none">
                    <button type="submit" style="color:white; background-color:rgb(207, 1, 1); padding: 10px; border-radius: 4px; border: none;"><i class="fa-solid fa-xmark"></i> Annuler la livraison </button>
                </form>


            @else


                <h3 style="color:white; background-color:rgba(191, 0, 3, 0.805); padding: 10px; border-radius: 4px; border: none; text-align: center;" > Aucune information disponible  </h3>

                    <!-- Button trigger modal -->
                    <strong style="color: red;">Contactez le receptionniste afin de programmer une livraison de vos vêtements.</strong> <i class="fa-solid fa-2x fa-truck" style="color: rgb(7, 122, 118);"></i>


            @endif

        </div>
    </div>


    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Informations sur les vêtements</h3>
        <div class="card-body">
            <div class="row" style="background-color:rgb(87, 87, 242); border-left: 20px solid rgb(37, 7, 159);">
                <div class="col">
                    <p><strong style="color: rgb(212, 191, 232);">Date de retrait : </strong><span style="color: white;">{{ $facture->date_retrait }}</span></p>
                    <p><strong style="color: rgb(212, 191, 232);">Rédigé par : Mr/mme </strong><span style="color: white;">{{ $infos_receptionist->name }}</span></p>
                    <p><strong style="color: rgb(212, 191, 232);">A la date du: </strong><span style="color: white;">{{ $facture->created_at }}</span></p>
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
                            <th>Qualité(s)</th>
                            <th>Qte(s)</th>
                            <th>Prix unitaire</th>
                            <th>prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($liste_vet_recepts as $liste_vet_recept)
                        <tr>
                            <td>{{$liste_vet_recept->nom_vet}}</td>
                            <td>{{$liste_vet_recept->color_vet}}</td>
                            <td>{{$liste_vet_recept->caract_vet}}</td>
                            <td>{{$liste_vet_recept->cat_vet}}</td>
                            <td>{{$liste_vet_recept->quality_vet}}</td>
                            <td>{{$liste_vet_recept->qte_vet}}</td>
                            <td>{{$liste_vet_recept->prix_unitaire}}</td>
                            <td>{{$liste_vet_recept->prix}}</td>
                        </tr>
                        @empty
                            <strong class="text-center" style="color: rgb(209, 17, 17);">La liste des vêtements est vide</strong>
                        @endforelse
                        <tr>
                            <td colspan="5" style="color: blue; font-weight: bold; font-size: 20px;">Total</td>
                            <td colspan="1" style="color: rgb(248, 248, 248); font-size: 30px; background-color:rgb(225, 33, 8); font-weight: bold;">{{$total_vets}}</td>
                            <td colspan="1" style="color: rgb(248, 248, 248); font-size: 30px; background-color:rgb(225, 33, 8); font-weight: bold;">{{$total_prix_unit_vets}} Frs</td>
                            <td colspan="1" style="color: rgb(248, 248, 248); font-size: 30px; background-color:rgb(225, 33, 8); font-weight: bold;">{{$total_prix_vets}} Frs</td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>
    </div>


</div>

<!--fin affichage du details facture-->

@endsection
