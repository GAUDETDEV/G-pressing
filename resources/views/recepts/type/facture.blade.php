@extends('layouts/auth')
@section('title',"vêtements receptionnés")

@section('content')

<div class="mt-5">

    @if ($facture->statut_facture and $facture->etat_livraison == "Non")
        <a type="button" class="btn" href="{{route('s',['facture' => $facture])}}" style='color: rgb(255, 255, 255); background-color: rgb(5, 5, 5); margin: 5px;'>Reçu en PDF</a>
    @elseif ($facture->statut_facture and $infos_livraison)
        <a type="button" class="btn" href="{{route('generatePdf',['facture' => $facture])}}" style='color: rgb(255, 255, 255); background-color: rgb(5, 5, 5); margin: 5px;'>Reçu en PDF</a>
    @endif

    @if ($facture->etat_livraison == "Oui")
    <a type="button" class="btn" href="{{route('listeLivraisonClassic',["facture" => $facture->id])}}" style='color: rgb(255, 255, 255); background-color: rgb(15, 109, 177); margin: 5px;'>Renseigner les informations de livraison</a>
    @endif

    <ul class="list-group mt-2">
        <li class="list-group-item">
            <h5 style="color:rgb(254, 254, 254); border-left: solid 25px rgb(16, 106, 233); background-color:rgb(6, 52, 105); padding: 5px;">Autres informations sur la facture</h5>

            <div class="text-center mt-3">
                @if (session('message'))
                <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
                @endif
            </div>

            <form action="{{route('editDetailsRecept',["facture" => $facture->id])}}" method="POST">

                @method("put")
                @csrf

                <div class="row">

                    <div class="col">

                        <label for="" class="form-label mt-3" style="color:rgb(15, 109, 177); font-weight: bold;">Faire une avance ?</label>
                        <select class="form-control mt-3" name="avance" id="">
                            <option value="0">Non</option>
                            <option value="1">Avancer le quart du montant à payer</option>
                            <option value="2">Avancer le tiers du montant à payer</option>
                            <option value="3">Avancer la moitié du montant à payer</option>
                            <option value="4">Avancer le trois quart du montant à payer</option>
                            <option value="5">Avancer la totalité du montant à payer</option>
                        </select>
                        @if ($errors)
                        @error('avance')
                            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                        @enderror
                        @endif

                    </div>

                    <div class="col">

                        <label for="" class="form-label mt-3" style="color:rgb(15, 109, 177); font-weight: bold;">Se faire livrer ?</label>
                        <select class="form-control mt-3" name="etat_livraison" id="">
                            <option value="Oui">Oui</option>
                            <option value="Non">Non</option>
                        </select>
                        @if ($errors)
                        @error('etat_livraison')
                            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                        @enderror
                        @endif

                        <div class="text-center mt-3">
                            <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer</button>
                        </div>

                    </div>

                    <div class="col">

                        <p class="mt-3" style="color:rgb(15, 109, 177); font-weight: bold;">Le statut
                            @if($facture->statut_facture == "Non régler") <strong style="font-size: 25px; color: white; padding: 5px; background-color:rgb(211, 20, 29);"> {{$facture->statut_facture}} </strong> @endif
                            @if($facture->statut_facture == "Régler") <strong style="font-size: 25px; color: white; padding: 5px; background-color:rgb(33, 240, 54);"> {{$facture->statut_facture}} </strong> @endif
                            @if($facture->statut_facture == "") <strong style="font-size: 25px; color: white; padding: 5px; background-color:rgb(19, 4, 102);"> Inconnu </strong> @endif
                        </p>

                        <p class="mt-3" style="color:rgb(15, 109, 177); font-weight: bold;">Date de retrait

                            @if ($total_qte <= "3")

                            <input class="form-control mt-3" type="date" name="date_retrait" id="" value="{{$today}}">

                            @elseif ($total_qte == "10" )

                            <input class="form-control mt-3" type="date" name="date_retrait" id="" value="{{date("Y-m-d",strtotime("+2 days"))}}">

                            @else

                            <input class="form-control mt-3" type="date" name="date_retrait" id="" value="{{date("Y-m-d",strtotime("+3 days"))}}">

                            @endif

                        </p>

                    </div>

                </div>

            </form>

            <p class="mt-3" style="color:rgb(15, 109, 177); font-weight: bold;">Montant à payer <strong style="font-size: 25px; color: white; padding: 5px; background-color:rgb(7, 53, 67);">{{$total_prix}} frs CFA</strong></p>
            @if ($facture->avance)
            <p class="mt-3" style="color:rgb(15, 109, 177); font-weight: bold;">Montant avancé <strong style="font-size: 25px; color: white; padding: 5px; background-color:rgb(7, 53, 67);">{{$facture->montant - $facture->reste}} frs CFA</strong></p>
            @endif

            @if ($facture->avance)
            <p class="mt-3" style="color:rgb(15, 109, 177); font-weight: bold;">Montant restant <strong style="font-size: 25px; color: white; padding: 5px; background-color:rgb(7, 53, 67);">{{$facture->reste}} frs CFA</strong></p>
            @else
            <p class="mt-3" style="color:rgb(15, 109, 177); font-weight: bold;">Reste à payer <strong style="font-size: 25px; color: white; padding: 5px; background-color:rgb(205, 1, 22);">{{$total_prix}} frs CFA</strong></p>
            @endif


        </li>
    </ul>

    <ul class="list-group mt-2">
        <li class="list-group-item">
            <h5 style="color:rgb(254, 254, 254); border-left: solid 25px rgb(16, 106, 233); background-color:rgb(6, 52, 105); padding: 5px;">Informations sur le client</h5>
            <p><strong>Nom</strong> {{$facture->nom_titulaire}}</p>
            <p><strong>Téléphone:</strong> {{$facture->tel_titulaire}}</p>
        </li>
    </ul>

    <ul class="list-group mt-2">
        <li class="list-group-item">
            <h5 style="color:rgb(254, 254, 254); border-left: solid 25px rgb(16, 106, 233); background-color:rgb(6, 52, 105); padding: 5px;">Informations sur les vêtements receptionnés</h5>
            <p><strong>Type de dépot</strong> {{$type_depot}}</p>
            <p><strong>date de reception:</strong> {{$date_recept->created_at}}</p>
        </li>
    </ul>

    <table class="table table-striped shadow mt-2">
        <caption class="fs-5" style="color:rgb(15, 109, 177);"><strong>Liste des vêtements réceptionnés pour la facture n° {{ $facture->id }}</strong></caption>
        <thead>
            <tr>
                <th class="text-primary">Nom vet</th>
                <th class="text-primary">Couleur</th>
                <th class="text-primary">Specificat</th>
                <th class="text-primary">Catg</th>
                <th class="text-primary">Qualité(s)</th>
                <th class="text-primary">Qte</th>
                <th class="text-primary">Prix unit</th>
                <th class="text-primary">Prix total</th>
                <th class="text-primary">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($liste_recept_types as $liste_recept_type)
            <tr>
                <td>{{ $liste_recept_type->nom_vet}}</td>
                <td>{{ $liste_recept_type->color_vet}}</td>
                <td>{{ $liste_recept_type->caract_vet}}</td>
                <td>{{ $liste_recept_type->cat_vet}}</td>
                <td>{{ $liste_recept_type->quality_vet}}</td>
                <td>{{ $liste_recept_type->qte_vet}}</td>
                <td>{{ $liste_recept_type->prix_unitaire}} frs CFA</td>
                <td>{{ $liste_recept_type->prix}} frs CFA</td>
                <td>
                    <a href="{{route('modifyVetReceptClassic',['vetement_classic' => $liste_recept_type->id])}}" title="modifier" style='color: rgb(38, 11, 214);'><i class="fa-solid fa-pen"></i></a><!--boutton modifier-->
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <p class="text-center"><strong class="text-danger"> La liste des vêtements réceptionnés est vite! <strong></p>
                </td>
            </tr>
            @endforelse
            <tr>
                <td colspan="5"><strong class="text-danger">Total</strong></td>
                <td><strong class="text-danger">{{$total_qte}}</strong></td>
                <td><strong class="text-danger">{{$total_prix_unit}} frs CFA</strong></td>
                <td><strong class="text-danger">{{$total_prix}} frs CFA</strong></td>
            </tr>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>


@endsection
