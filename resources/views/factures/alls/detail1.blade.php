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
         @if($facture->statut_facture == "Régler") <span style="color:aliceblue; background-color:rgb(13, 175, 43); padding: 5px; border-radius: 3px;"> Régler  </span> @endif
         @if($facture->statut_facture == "Non régler") <span style="color:aliceblue; background-color:rgb(209, 65, 9); padding: 5px; border-radius: 3px;"> Non régler  </span> @endif
         @if($facture->statut_facture == "") <span style="color:aliceblue; background-color:rgb(3, 0, 8); padding: 5px; border-radius: 3px;"> En attente de validation  </span> @endif
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
                        <p><strong>Destinataire : </strong> Mr/Mlle {{ $info_livraisons->nom_destinataire }}</p>
                        <p><strong>Téléphone : </strong>{{ $facture->tel_titulaire }}</p>
                        <p><strong>Commune : </strong>{{ $commune_livraison->nom_commune }}</p>
                        <p><strong>Quartier : </strong>{{ $quartier_livraison->nom_quartier }}</p>
                    </div>
                    <div class="col">
                        <p><strong>Adresse : </strong>{{ $adresse_livraison->nom_adresse }}</p>
                        <p><strong>Frais de livraison : </strong> <span style="color: red; font-weight: bold;">{{ $prix_livraison->valeur_prix }} Frs</span> </p>
                        <p><strong>Date : </strong>{{ $info_livraisons->date_livraison }}</p>
                        <p><strong>Heure : </strong>{{ $info_livraisons->heure_livraison }}</p>
                    </div>
                </div>

            @else

                <h3 style="color:white; background-color:rgba(191, 0, 3, 0.805); padding: 10px; border-radius: 4px; border: none; text-align: center;" > Aucune information disponible  </h3>

            @endif

        </div>
    </div>

    <div class="card shadow mt-4">
        <h3 class="card-header" style="color:rgb(14, 14, 170);">Processus de traitement</h3>
        <div class="card-body">

            @if ($total_vets !== 0)

            <div class="row">
                <div class="col">
                    <p style="color: rgb(67, 2, 47); font-weight: bold; font-size: 20px;">Dépôt</p>

                    @if($facture->etat_traitement !== "")

                        <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(10, 190, 31); padding: 5px; border-radius: 3px;">Terminée <i class="fa-solid fa-check"></i></span></p>

                    @else

                        <span style="color:aliceblue; background-color:rgb(108, 108, 108); padding: 5px; border-radius: 3px;">Non planifier <i class="fa-solid fa-ban"></i></span>

                    @endif

                </div>
                <div class="col">
                    <p style="color: rgb(67, 2, 47); font-weight: bold; font-size: 20px;">Lavage</p>

                    @if ($etat_tache_lavage)

                    @if ($today < $etat_tache_lavage->fin_tache and $etat_tache_lavage->etat_tache == "En attente")
                    <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(4, 96, 216); padding: 5px; border-radius: 3px;">{{$etat_tache_lavage->etat_tache}} ... </span></p>
                    @endif
                    @if ($today < $etat_tache_lavage->fin_tache and $etat_tache_lavage->etat_tache == "Terminée")
                    <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(10, 190, 31); padding: 5px; border-radius: 3px;">Terminée <i class="fa-solid fa-check"></i></span></p>
                    @endif
                    @if ($today >= $etat_tache_lavage->fin_tache and $etat_tache_lavage->etat_tache == "En attente")
                    <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(185, 16, 25); padding: 5px; border-radius: 3px;">Non éffectuée <i class="fa-solid fa-xmark"></i></span></p>
                    @endif
                    @if ($today >= $etat_tache_lavage->fin_tache and $etat_tache_lavage->etat_tache == "Terminée")
                    <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(10, 190, 31); padding: 5px; border-radius: 3px;">Terminée <i class="fa-solid fa-check"></i></span></p>
                    @endif

                    <p><strong>début : </strong>{{ $etat_tache_lavage->debut_tache }}</p>
                    <p><strong>Fin : </strong>{{ $etat_tache_lavage->fin_tache }}</p>

                    @else

                    <span style="color:aliceblue; background-color:rgb(108, 108, 108); padding: 5px; border-radius: 3px;">Non planifier <i class="fa-solid fa-ban"></i></span>

                    @endif

                </div>
                <div class="col">
                    <p style="color: rgb(67, 2, 47); font-weight: bold; font-size: 20px;">Repassage</p>

                    @if ($etat_tache_repassage)

                    @if ($today < $etat_tache_repassage->fin_tache and $etat_tache_repassage->etat_tache == "En attente")
                    <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(4, 96, 216); padding: 5px; border-radius: 3px;">{{$etat_tache_repassage->etat_tache}} ... </span></p>
                    @endif
                    @if ($today < $etat_tache_repassage->fin_tache and $etat_tache_repassage->etat_tache == "Terminée")
                    <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(10, 190, 31); padding: 5px; border-radius: 3px;">Terminée <i class="fa-solid fa-check"></i></span></p>
                    @endif
                    @if ($today >= $etat_tache_repassage->fin_tache and $etat_tache_repassage->etat_tache == "En attente")
                    <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(185, 16, 25); padding: 5px; border-radius: 3px;">Non éffectuée <i class="fa-solid fa-xmark"></i></span></p>
                    @endif
                    @if ($today >= $etat_tache_repassage->fin_tache and $etat_tache_repassage->etat_tache == "Terminée")
                    <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(10, 190, 31); padding: 5px; border-radius: 3px;">Terminée <i class="fa-solid fa-check"></i></span></p>
                    @endif

                    <p><strong>début : </strong>{{ $etat_tache_repassage->debut_tache }}</p>
                    <p><strong>Fin : </strong>{{ $etat_tache_repassage->fin_tache }}</p>

                    @else

                    <span style="color:aliceblue; background-color:rgb(108, 108, 108); padding: 5px; border-radius: 3px;">Non planifier <i class="fa-solid fa-ban"></i></span>

                    @endif


                </div>
                <div class="col">
                    <p style="color: rgb(67, 2, 47); font-weight: bold; font-size: 20px;">Livraion</p>

                    @if ($etat_tache_livraison)

                    @if ($today < $etat_tache_livraison->fin_tache and $etat_tache_livraison->etat_tache == "En attente")
                    <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(4, 96, 216); padding: 5px; border-radius: 3px;">{{$etat_tache_livraison->etat_tache}} ... </span></p>
                    @endif
                    @if ($today < $etat_tache_livraison->fin_tache and $etat_tache_livraison->etat_tache == "Terminée")
                    <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(10, 190, 31); padding: 5px; border-radius: 3px;">Terminée <i class="fa-solid fa-check"></i></span></p>
                    @endif
                    @if ($today >= $etat_tache_livraison->fin_tache and $etat_tache_livraison->etat_tache == "En attente")
                    <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(185, 16, 25); padding: 5px; border-radius: 3px;">Non éffectuée <i class="fa-solid fa-xmark"></i></span></p>
                    @endif
                    @if ($today >= $etat_tache_livraison->fin_tache and $etat_tache_livraison->etat_tache == "Terminée")
                    <p><strong>Etat : </strong><span style="color:aliceblue; background-color:rgb(10, 190, 31); padding: 5px; border-radius: 3px;">Terminée <i class="fa-solid fa-check"></i></span></p>
                    @endif

                    <p><strong>début : </strong>{{ $etat_tache_livraison->debut_tache }}</p>
                    <p><strong>Fin : </strong>{{ $etat_tache_livraison->fin_tache }}</p>

                    @else

                    <span style="color:aliceblue; background-color:rgb(108, 108, 108); padding: 5px; border-radius: 3px;">Non planifier <i class="fa-solid fa-ban"></i></span>

                    @endif

                </div>

            </div>

            @else

                <p style="color: red; font-weight: bold;"> Aucun état disponible pour cette facture </p>

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
                            <td>{{$liste_vet_recept->qte_vet}}</td>
                            <td>{{$liste_vet_recept->prix_unitaire}}</td>
                            <td>{{$liste_vet_recept->prix}}</td>
                        </tr>
                        @empty
                            <strong class="text-center" style="color: rgb(209, 17, 17);">La liste des vêtements est vide</strong>
                        @endforelse
                        <tr>
                            <td colspan="4" style="color: blue; font-weight: bold; font-size: 20px;">Total</td>
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
